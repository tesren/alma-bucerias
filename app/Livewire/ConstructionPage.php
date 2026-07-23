<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ConstructionUpdate;
use Livewire\WithPagination;

class ConstructionPage extends Component
{
    use WithPagination;

    public function render()
    {
        $const_updates = ConstructionUpdate::latest('date')->paginate(4);

        return view('construction-page', compact('const_updates') );
    }
}
