<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatBox extends Component
{
    protected $listeners = ['chatRefresh' => 'refresh'];

    public $messages = [];
    public $user_name = null;
    public $to_id;
    public $status = false;


    public function mount($id){
        $this->messages = Chat::where('from_id',Auth::id())->where('to_id',$id)->orWhere('to_id',Auth::id())->orWhere('from_id',$id)->get();

        $this->user_name = User::find($id)->name;
        $this->to_id = $id;
    }

    public function getMessage(){
        $this->refresh();

    }

    public function refresh()
    {
        $this->messages = Chat::where('from_id',Auth::id())->where('to_id',$this->to_id)->orWhere('to_id',Auth::id())->orWhere('from_id',$this->to_id)->get();
        $this->status = !$this->status;
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
