<?php

namespace App\Observers;

use App\Models\Unit;
use App\Mail\NewLowestPrice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class UnitObserver
{
    /**
     * Handle the Unit "created" event.
     */
    public function created(Unit $unit): void
    {
        //
    }

    public function updated(Unit $unit): void
    {
        // Recuperar el último precio más bajo almacenado en caché
        $cachedLowest = Cache::get('lowest_priced_unit');

        // Limpiar el cache previo antes de recalcular
        Cache::forget('lowest_priced_unit');

        // Obtener todas las unidades disponibles ordenadas por precio
        $availableUnits = Unit::where('status', 'Disponible')->orderBy('price', 'asc')->get();

        // Determinar la unidad con el precio más bajo
        $lowestPricedUnit = $availableUnits->first();

        if (!$lowestPricedUnit) {
            // Si no hay unidades disponibles, no hacemos nada
            return;
        }

        // Actualizar la unidad más barata en caché
        Cache::forever('lowest_priced_unit', [
            'id' => $lowestPricedUnit->id,
            'price' => $lowestPricedUnit->price,
        ]);

        if( isset($cachedLowest) ){

            // Comparar con el valor en caché para evitar notificaciones repetidas
            if ( $cachedLowest['id'] != $lowestPricedUnit->id ) {

                // Si hay un cambio en la unidad más barata, notificar
                $email = Mail::to('erick@punto401.com')->cc('michelena@punto401.com');
                $email->send(new NewLowestPrice($lowestPricedUnit));

            }

        }
        
    }

    /**
     * Handle the Unit "deleted" event.
     */
    public function deleted(Unit $unit): void
    {
        //
    }

    /**
     * Handle the Unit "restored" event.
     */
    public function restored(Unit $unit): void
    {
        //
    }

    /**
     * Handle the Unit "force deleted" event.
     */
    public function forceDeleted(Unit $unit): void
    {
        //
    }
}
