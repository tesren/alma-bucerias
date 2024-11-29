<?php

namespace App\Livewire;

use App\Models\Tower;
use Livewire\Component;
use App\Models\Unit;

class InventoryPage extends Component
{

    public Tower $tower;
    public $units;
    public $bedrooms = 0;
    public $min_price = 1;
    public $max_price = 9999999999;

    public function mount($name)
    {
        $this->tower = Tower::where('name', $name)->firstOrFail();
        $this->units = Unit::where('tower_id', $this->tower->id)->get();
        $this->dispatch('id-tower', id:$this->tower->id);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['bedrooms', 'min_price', 'max_price'])) {
            $this->search();
        }
    }

    public function search(){
        $units = Unit::where('price', '>' ,$this->min_price)->where('price','<', $this->max_price)->where('tower_id', $this->tower->id);

        if( $this->bedrooms != 0 ){

            if($this->bedrooms == 3 ){
                $units = $units->whereIn('unit_type_id', [1,3] );
            }
            elseif($this->bedrooms == 2 ){
                $units = $units->where('unit_type_id', 2 );
            }

        }

        $units = $units->get();

        $this->units = $units;
    }

    public function render()
    {
        return view('inventory-page');
    }
}
