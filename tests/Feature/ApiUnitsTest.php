<?php

namespace Tests\Feature;

use App\Models\ApiRequestLog;
use App\Models\Tower;
use App\Models\Unit;
use App\Models\UnitType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiUnitsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // El rate limiter usa el cache driver; sin esto, los intentos de un
        // test contaminan el conteo del siguiente (CACHE_DRIVER=array persiste
        // durante toda la corrida de PHPUnit).
        Cache::flush();
    }

    public function test_login_returns_token(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk()->assertJsonStructure(['token']);
    }

    public function test_units_require_auth(): void
    {
        $this->get('/api/units')->assertUnauthorized();
    }

    public function test_units_require_correct_ability(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['other:ability']);

        $this->getJson('/api/units')->assertForbidden();

        $this->assertDatabaseHas('api_request_logs', [
            'path' => 'api/units',
            'status_code' => 403,
        ]);
    }

    public function test_auth_blocks_are_logged(): void
    {
        $this->get('/api/units')->assertUnauthorized();

        $this->assertDatabaseHas('api_request_logs', [
            'path' => 'api/units',
            'status_code' => 401,
        ]);
    }

    public function test_rate_limit_exceeded_is_logged(): void
    {
        $credentials = ['email' => 'nobody@example.com', 'password' => 'wrong'];

        // El limitador 'api-login' permite 5 intentos por minuto por IP
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/login', $credentials);
        }

        $this->postJson('/api/login', $credentials)->assertStatus(429);

        $this->assertDatabaseHas('api_request_logs', [
            'path' => 'api/login',
            'status_code' => 429,
        ]);
    }

    public function test_units_index_returns_standard_schema(): void
    {
        // towers/unit_types/units viven fuera del sistema de migraciones de Laravel
        // (vienen del dump SQL del proyecto), así que no existen en la base de
        // test aislada (sqlite en memoria). Este test solo corre cuando esas
        // tablas están presentes (ej. corriendo contra una copia completa de la BD).
        if (! \Illuminate\Support\Facades\Schema::hasTable('towers')) {
            $this->markTestSkipped('Tablas towers/unit_types/units no disponibles en este entorno de test.');
        }

        Sanctum::actingAs(User::factory()->create(), ['units:read']);

        $tower = new Tower();
        $tower->forceFill(['name' => 'Torre Test'])->save();

        $type = new UnitType();
        $type->forceFill([
            'name' => 'Tipo Test',
            'tower_id' => $tower->id,
            'bedrooms' => 2,
            'bathrooms' => 2.5,
            'interior_const' => 85.5,
            'exterior_const' => 20.0,
        ])->save();

        $unit = new Unit();
        $unit->forceFill([
            'unit_type_id' => $type->id,
            'tower_id' => $tower->id,
            'name' => '101A',
            'floor' => 1,
            'price' => 250000,
            'currency' => 'USD',
            'status' => 'Disponible',
            'interior_const' => 85.5,
            'exterior_const' => 20.0,
            'const_total' => 105.5,
        ])->save();

        $response = $this->getJson('/api/units')->assertOk();

        $response->assertJsonStructure([
            'data' => ['*' => [
                'id', 'project', 'name', 'status', 'price', 'currency',
                'section', 'unit_type', 'payment_plans', 'gallery', 'updated_at',
            ]],
        ]);

        $statuses = collect($response->json('data'))->pluck('status')->unique();
        $statuses->each(fn ($status) => $this->assertContains($status, ['available', 'reserved', 'sold']));
    }

    public function test_prune_api_logs_command_deletes_old_logs(): void
    {
        ApiRequestLog::create([
            'method' => 'GET',
            'path' => 'api/units',
            'status_code' => 200,
            'ip_address' => '127.0.0.1',
        ])->forceFill(['created_at' => now()->subDays(16)])->save();

        $this->artisan('api-logs:prune')->assertSuccessful();

        $this->assertDatabaseMissing('api_request_logs', [
            'path' => 'api/units',
            'status_code' => 200,
        ]);
    }
}
