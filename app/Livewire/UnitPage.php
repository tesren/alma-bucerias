<?php

namespace App\Livewire;

use App\Models\Unit;
use Livewire\Component;

class UnitPage extends Component
{

    public Unit $unit;

    public function mount($name)
    {
        $this->unit = Unit::where('name', $name)->firstOrFail();
        $this->dispatch('id-unidad', id:$this->unit->id);
    }
    
    public function saveUnit($unitID){

        $unit = Unit::findOrFail( $unitID );
        $unit->users()->attach( auth()->user()->id );
        $unit->save();

        session()->flash('saved', __('Se guardó la unidad ').$unit->name );
    }

    public function removeUnit($unitID){

        $unit = Unit::findOrFail( $unitID );
        $unit->users()->detach( auth()->user()->id );
        $unit->save();

        session()->flash('removed', __('Se quitó la unidad ').$unit->name);
    }
    
    public function render()
    {
        $similar_units = Unit::where('unit_type_id', $this->unit->id)->where('status', 'Disponible')->where('id', '!=', $this->unit->id)->limit(3)->get();

        if( count($similar_units) < 1 ){
            $more_units = Unit::where('status', 'Disponible')->where('id', '!=', $this->unit->id)->inRandomOrder()->take(3)->get();
        }else{
            $more_units = $similar_units;
        }

        return view('unit-page', compact('more_units') );
    }
}
