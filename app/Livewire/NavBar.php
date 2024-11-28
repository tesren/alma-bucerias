<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ConstructionUpdate;
use Illuminate\Support\Facades\Route;

class NavBar extends Component
{

    public $route = '';

    public function mount(){
        $this->route = Route::currentRouteName();
    }

    public function render()
    {
        $const_updates = ConstructionUpdate::all();
        $lang = app()->getLocale();
        
        return view('components.nav-bar', compact('const_updates', 'lang') );
    }
}
