<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UpdateLocation extends Component
{
    protected $listeners = ['refreshLocation' => '$refresh'];

    public function render()
    {
        return view('livewire.update-location');
    }
}
