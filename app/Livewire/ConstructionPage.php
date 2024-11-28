<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ConstructionUpdate;

class ConstructionPage extends Component
{
    public function render()
    {
        $const_updates = ConstructionUpdate::latest()->get();

        return view('construction-page', compact('const_updates') );
    }
}
