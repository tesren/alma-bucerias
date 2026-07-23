<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // La home consulta datos de negocio (towers/units) que viven fuera del
        // sistema de migraciones de Laravel y no existen en la base de test aislada.
        if (! \Illuminate\Support\Facades\Schema::hasTable('towers')) {
            $this->markTestSkipped('Tablas de negocio no disponibles en este entorno de test.');
        }

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
