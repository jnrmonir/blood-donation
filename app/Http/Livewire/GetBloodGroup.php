<?php

namespace App\Http\Livewire;

use App\Models\BloodGroup;
use Livewire\Component;

class GetBloodGroup extends Component
{
    public function render()
    {
        $blood_groups = BloodGroup::all();
        return view('livewire.get-blood-group',['blood_groups'=>$blood_groups]);
    }
}
