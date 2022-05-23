<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DonarBox extends Component
{
    public $search;
    protected $queryString = ['search'];
    public $to_id;
    public $body;

    public function mount($id){
        $this->to_id = $id;
    }

    public function send(){
        $this->validate([
            'body' => 'required | max:255'
        ]);


        $message = new Chat();
        $message->from_id = Auth::id();
        $message->to_id = $this->to_id;
        $message->type = 1;
        $message->body = $this->body;
        $message->save();
        $this->emit('chatRefresh');
        $this->body = '';


    }

    public function render()
    {
        return view('livewire.chat.donar-box');
    }
}
