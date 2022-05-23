<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\BloodRequest;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PeopleRequestedBloodToYou extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        $requestedBloods = BloodRequest::with(['fromUser','bloodGroup'])->where('to_user_id',Auth::id())->paginate(2);

        return view('livewire.auth.people-requested-blood-to-you',['requestedBloods' => $requestedBloods])->extends('layouts.app');
    }
}
