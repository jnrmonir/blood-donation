<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class AddComment extends Component
{
    public $post_id;
    public $comment;


    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'comment' => 'required | min:3 | max:255'
        ]);
    }

    public function submit(){

        $this->validate([
            'comment' => 'required | min:3 | max:255'
        ]);

        if(Auth::check()){
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->post_id = $this->post_id;
            $comment->comment = $this->comment;
            if($comment->save()){
                session()->flash('status','Thanks. Your Available Comment');
                $this->reset();
                $this->emit('refreshRequest');
            }else{
                session()->flash('wrong','Something went to wrong');
            }
        }else{
            session()->flash('wrong','Your Are not Authenticate.Please Login');
        }

        
    }
    
    public function render()
    {
        return view('livewire.add-comment');
    }
}
