<?php

namespace App\Http\Livewire\Auth;

use App\Models\BloodRequest;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class RequestedBlood extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshModal','$refresh'];


    public function refreshModal(){
        $requestedBloods = BloodRequest::where('from_user_id',Auth::id())->paginate(2);
    }

    public function render()
    {
        $requestedBloods = BloodRequest::where('from_user_id',Auth::id())->paginate(2);
        return view('livewire.auth.requested-blood',['requestedBloods' => $requestedBloods])->extends('layouts.app');
    }
}
