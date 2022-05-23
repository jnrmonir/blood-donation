<?php

namespace App\Http\Livewire;

use App\Models\Feedback as ModelsFeedback;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Feedback extends Component
{
    public $feedback;

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'feedback' => 'required | min:3 | max:255'
        ]);
    }
    public function send(){
        $this->validate([
            'feedback' => 'required | min:3 | max:255'
        ]);
        if(Auth::check()){
           $feedback = new ModelsFeedback();
           $feedback->user_id = Auth::id();
           $feedback->feedback = $this->feedback;
           if($feedback->save()){
               session()->flash('status','Thank your Avaiable Feedback');
           }else{
            session()->flash('wrong','Something Went To Wrong');
           }
        }else{
            session()->flash('wrong','Please Login Then Push your Availabe Feedback');
        }
    }

    public function render()
    {
        return view('livewire.feedback');
    }

}
