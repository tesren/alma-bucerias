<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Tower;
use Livewire\Component;
use App\Models\UnitType;
use Livewire\WithPagination;


class SearchPage extends Component
{
    use WithPagination;

    public $search_status = 0;
    public $floor = 0;
    public $bedrooms = 0;
    public $tower = 0;
    public $unit_type = 0;
    public $min_price = 1;
    public $max_price = 9999999999;

    public function search(){
        $this->resetPage();
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
        $units = Unit::where('price', '>' ,$this->min_price)->where('price','<', $this->max_price)->where('status', '!=', 'Vendida');

        $unit_types = UnitType::all();

        $towers = Tower::all();

        if( $this->floor != 0 ){
            $units = $units->where('floor', $this->floor);
        }

        if($this->tower != 0){
            if ($this->tower == 2) {
                $units = $units->whereIn('section_id', [1,2] );
            } 
            elseif($this->tower == 1){
                $units = $units->whereIn('section_id', [3,4] );
            }            
        }

        if($this->unit_type != 0){
            $units = $units->where('unit_type_id', $this->unit_type );
        }

        if( $this->bedrooms != 0 ){
            $units = $units->where('bedrooms', $this->bedrooms );            
        }

        $units = $units->orderBy('status', 'desc')->paginate(12);


        return view('search-page', compact('units', 'unit_types', 'towers'));
    }
}
