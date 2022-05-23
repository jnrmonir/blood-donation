<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AllRoles extends Component
{
    public function render()
    {
        return view('livewire.admin.all-roles')->extends('layouts.base');
    }
}
