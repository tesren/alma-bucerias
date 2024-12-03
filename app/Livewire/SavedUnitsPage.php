<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;

class SavedUnitsPage extends Component
{

    public function removeUnit($unitID){

        $unit = Unit::findOrFail( $unitID );
        $unit->users()->detach( auth()->user()->id );
        $unit->save();
        
        session()->flash('removed', __('Se quitó la unidad ').$unit->name);
    }
    
    public function render()
    {
        $units = auth()->user()->savedUnits;

        return view('saved-units-page', compact('units') );
    }
}
