<?php

namespace App\Http\Livewire\Chat;

use App\Models\User;
use Livewire\Component;
use App\Models\Chat as ModelsChat;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{

    protected $listeners = ['chatRefresh' => '$refresh'];
    public $search;
    protected $queryString = ['search'];

    public $to_id;



    public function selectDonar($id){
        $user_name = User::find($id)->name;
        $this->to_id = $id;
    }




    public function render()
    {
        $donars = User::select('id','name','blood_group_id','last_seen','profile_photo_path')->where('id','!=',Auth::id())->where('name', 'like', '%'.$this->search.'%')->orderBy('last_seen','desc')->get();
        return view('livewire.chat.chat',['donars'=>$donars])->extends('layouts.app');
    }
}
