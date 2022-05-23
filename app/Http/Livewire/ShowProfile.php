<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowProfile extends Component
{
    public $user;
    public function mount($user){
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.show-profile');
    }
}
