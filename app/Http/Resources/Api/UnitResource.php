<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    public function toArray($request): array
    {
        $tower = $this->whenLoadedValue('tower');
        $unitType = $this->whenLoadedValue('unitType');

        return [
            'id' => $this->id,
            'project' => config('app.api_project_slug'),
            'name' => $this->name,
            'status' => $this->normalizeStatus((string) $this->status),
            'floor' => (int) $this->floor,
            'price' => $this->roundedFloat($this->price),
            'currency' => $this->currency,
            'section' => $tower ? [
                'id' => $tower->id,
                'name' => $tower->name,
            ] : null,
            'unit_type' => $unitType ? [
                'id' => $unitType->id,
                'name' => $unitType->name,
                'bedrooms' => (int) $unitType->bedrooms,
                'bathrooms' => $this->roundedFloat($unitType->bathrooms),
                'flexrooms' => (int) ($unitType->flexrooms ?? 0),
                'interior_m2' => $this->roundedFloat($unitType->interior_const),
                'exterior_m2' => $this->roundedFloat($unitType->exterior_const),
                'open_exterior_m2' => null,
                'parking_m2' => null,
                'storage_m2' => null,
                // unit_types.interior_const/exterior_const no está poblado en este proyecto;
                // el total real vive por unidad en units.const_total.
                'total_m2' => $this->roundedFloat($this->const_total),
                'blueprints' => $this->mediaCollection($unitType, 'blueprints'),
                'gallery' => $this->mediaCollection($unitType, 'gallery'),
            ] : null,
            'payment_plans' => $this->paymentPlansArray(),
            'gallery' => $this->mediaCollection($this->resource, 'unitgallery'),
            'youtube_url' => $this->youtube_link ?? null,
            'secondary_youtube_url' => $this->secondary_link ?? null,
            'project_extras' => array_filter([
                'parking_m2' => $this->roundedFloat($this->parking_area),
                'garden_m2' => $this->roundedFloat($this->garden),
                'view_path' => $this->view_path ? asset('media/'.$this->view_path) : null,
                'unit_bedrooms' => $this->bedrooms !== null ? $this->roundedFloat($this->bedrooms) : null,
                'unit_bathrooms' => $this->bathrooms !== null ? $this->roundedFloat($this->bathrooms) : null,
                'unit_interior_m2' => $this->roundedFloat($this->interior_const),
                'unit_exterior_m2' => $this->roundedFloat($this->exterior_const),
                'unit_total_m2' => $this->roundedFloat($this->const_total),
                // Columna unit_types.parking_spaces: siempre null en los datos actuales,
                // no tiene equivalente m2 confirmado en el schema estándar
                'unit_type_parking_spaces' => $unitType ? $unitType->parking_spaces : null,
            ], fn ($value) => $value !== null),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }

    private function paymentPlansArray(): array
    {
        if (! $this->resource->relationLoaded('paymentPlans')) {
            return [];
        }

        return $this->paymentPlans->map(fn ($plan) => [
            'id' => $plan->id,
            'name' => $plan->name,
            'name_en' => $plan->name_en ?? null,
            'discount' => $this->roundedFloat($plan->discount ?? 0, 0),
            'additional_discount' => $this->roundedFloat($plan->additional_discount),
            'down_payment' => $this->roundedFloat($plan->down_payment ?? 0, 0),
            'starting_const' => 0.0,
            'second_payment' => $this->roundedFloat($plan->second_payment ?? 0, 0),
            'second_payment_months' => 0,
            'second_payment_const' => false,
            'third_payment' => 0.0,
            'third_payment_months' => 0,
            'third_payment_const' => false,
            'months_percent' => $this->roundedFloat($plan->months_percent ?? 0, 0),
            // Siempre null: payment_plans no tiene columna de cantidad de meses en este proyecto
            'monthly_payments' => null,
            'months_during_const' => false,
            'closing_payment' => $this->roundedFloat($plan->closing_payment ?? 0, 0),
        ])->values()->all();
    }

    private function whenLoadedValue(string $relation)
    {
        return $this->resource->relationLoaded($relation) ? $this->{$relation} : null;
    }

    private function normalizeStatus(string $status): string
    {
        return match ($status) {
            'Disponible' => 'available',
            'Apartada', 'Reservada' => 'reserved',
            'Vendida', 'Vendido' => 'sold',
            default => strtolower($status),
        };
    }

    private function mediaCollection($model, string $collection): array
    {
        if (! $model || ! method_exists($model, 'getMedia')) {
            return [];
        }

        return $model->getMedia($collection)->map(fn ($media) => array_filter([
            'url' => $media->getUrl(),
            'thumb' => $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : null,
            'medium' => $media->hasGeneratedConversion('medium') ? $media->getUrl('medium') : null,
        ], fn ($value) => $value !== null))->values()->all();
    }

    private function roundedFloat($value, int $decimals = 2): ?float
    {
        return $value === null ? null : round((float) $value, $decimals);
    }
}
