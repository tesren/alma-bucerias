<?php

namespace Tests\Unit;

use App\Http\Resources\Api\UnitResource;
use App\Models\Tower;
use App\Models\Unit;
use App\Models\UnitType;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UnitResourceTest extends TestCase
{
    public function test_unit_resource_returns_standard_schema_and_normalizes_types(): void
    {
        config(['app.api_project_slug' => 'alma-bucerias']);

        $tower = (new Tower)->forceFill(['id' => 1, 'name' => 'Torre A']);
        $type = (new UnitType)->forceFill([
            'id' => 2,
            'name' => 'Tipo 2',
            'bedrooms' => 2,
            'bathrooms' => 2.5,
            'flexrooms' => null,
            'interior_const' => '88.29',
            'exterior_const' => '19.62',
        ]);
        $type->setRelation('media', new Collection);

        $unit = (new Unit)->forceFill([
            'id' => 42,
            'name' => '101A',
            'status' => 'Disponible',
            'floor' => '1',
            'price' => '250000.00',
            'currency' => 'USD',
            'youtube_link' => null,
            'const_total' => '107.91',
            'updated_at' => now(),
        ]);
        $unit->setRelation('tower', $tower);
        $unit->setRelation('unitType', $type);
        $unit->setRelation('paymentPlans', new Collection);
        $unit->setRelation('media', new Collection);

        $array = (new UnitResource($unit))->toArray(Request::create('/'));

        $this->assertSame(42, $array['id']);
        $this->assertSame('alma-bucerias', $array['project']);
        $this->assertSame('available', $array['status']);
        $this->assertSame(1, $array['floor']);
        $this->assertSame(250000.0, $array['price']);
        $this->assertSame(['id' => 1, 'name' => 'Torre A'], $array['section']);
        $this->assertSame(107.91, $array['unit_type']['total_m2']);
        $this->assertSame([], $array['payment_plans']);
        $this->assertArrayHasKey('secondary_youtube_url', $array);
    }

    public function test_unit_resource_normalizes_sold_status(): void
    {
        $unit = (new Unit)->forceFill([
            'status' => 'Vendida',
            'price' => '0',
            'floor' => '3',
            'currency' => 'USD',
        ]);
        $unit->setRelation('tower', null);
        $unit->setRelation('unitType', null);
        $unit->setRelation('paymentPlans', new Collection);
        $unit->setRelation('media', new Collection);

        $array = (new UnitResource($unit))->toArray(Request::create('/'));

        $this->assertSame('sold', $array['status']);
    }
}
