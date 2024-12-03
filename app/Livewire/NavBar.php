<?php

namespace App\Livewire;

use App\Models\Unit;
use App\Models\Tower;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ConstructionUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class NavBar extends Component
{

    public $unit_name = '101';
    public $tower = 'A';
    public $route = '';

    #[Url]
    public ?string $contact;

    #[On('id-unidad')] 
    public function updateUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $this->unit_name = $unit->name;
    }

    #[On('id-tower')]
    public function updateTower($id){
        $tower = Tower::findOrFail($id);
        $this->tower = $tower->name;
    }

    public function logout(){
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        $this->redirect('/', navigate: true);
    }

    public function mount()
    {
        $this->route = Route::currentRouteName();
        $this->contact = request()->query('contact');
        $this->tower =  $this->tower;
    }

    public function render()
    {
        $const_updates = ConstructionUpdate::all();
        $lang = app()->getLocale();
        
        return view('components.nav-bar', compact('const_updates', 'lang') );
    }
}
