<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;

class NavBar extends Component
{

    public $route = '';

    public function mount(){
        $this->route = Route::currentRouteName();
    }

    public function render()
    {
        return view('components.nav-bar');
    }
}
