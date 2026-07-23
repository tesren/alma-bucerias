<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UnitResource;
use App\Models\Unit;
use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'status' => 'sometimes|string|in:available,reserved,sold',
            'section_id' => 'sometimes|integer',
            'unit_type_id' => 'sometimes|integer',
            'bedrooms' => 'sometimes|integer',
            'price_min' => 'sometimes|numeric',
            'price_max' => 'sometimes|numeric',
            'currency' => 'sometimes|string|in:USD,MXN',
            'sort_by' => 'sometimes|string|in:price,floor,name,updated_at',
            'sort_dir' => 'sometimes|string|in:asc,desc',
            'per_page' => 'sometimes|integer|min:1|max:200',
        ]);

        $query = Unit::query()
            ->with(['tower', 'unitType.media', 'paymentPlans', 'media'])
            ->orderBy($validated['sort_by'] ?? 'name', $validated['sort_dir'] ?? 'asc');

        if (isset($validated['status'])) {
            $query->where('status', $this->denormalizeStatus($validated['status']));
        }

        if (isset($validated['section_id'])) {
            $query->where('tower_id', $validated['section_id']);
        }

        if (isset($validated['unit_type_id'])) {
            $query->where('unit_type_id', $validated['unit_type_id']);
        }

        if (isset($validated['currency'])) {
            $query->where('currency', $validated['currency']);
        }

        if (isset($validated['price_min'])) {
            $query->where('price', '>=', $validated['price_min']);
        }

        if (isset($validated['price_max'])) {
            $query->where('price', '<=', $validated['price_max']);
        }

        if (isset($validated['bedrooms'])) {
            $query->whereHas('unitType', fn ($q) => $q->where('bedrooms', $validated['bedrooms']));
        }

        return UnitResource::collection(
            $query->paginate($validated['per_page'] ?? 25)->appends($request->query())
        );
    }

    public function show(int $id)
    {
        $unit = Unit::with(['tower', 'unitType.media', 'paymentPlans', 'media'])->findOrFail($id);

        return new UnitResource($unit);
    }

    public function unitTypes()
    {
        // unit_types.interior_const/exterior_const no está poblado en este proyecto;
        // el total real vive por unidad en units.const_total, así que se promedia.
        $types = UnitType::withCount('units')
            ->withAvg('units', 'const_total')
            ->with('media')
            ->orderBy('name')
            ->get();

        return response()->json($types->map(fn ($type) => [
            'id' => $type->id,
            'name' => $type->name,
            'bedrooms' => (int) $type->bedrooms,
            'bathrooms' => $this->roundedFloat($type->bathrooms),
            'total_m2' => $this->roundedFloat($type->units_avg_const_total),
            'units_count' => (int) $type->units_count,
        ])->values());
    }

    private function denormalizeStatus(string $status): string
    {
        return match ($status) {
            'available' => 'Disponible',
            'reserved' => 'Apartada',
            'sold' => 'Vendida',
            default => $status,
        };
    }

    private function roundedFloat($value, int $decimals = 2): ?float
    {
        return $value === null ? null : round((float) $value, $decimals);
    }
}
