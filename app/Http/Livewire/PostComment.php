<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PostComment extends Component
{

    use WithPagination;


    public $post_id;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshRequest' => '$refresh'];


    public function mount($post_id)
    {
        $this->post_id = $post_id;
    }




    public function render()
    {
        $comments =  Comment::with('user:id,name,profile_photo_path')->where('post_id',$this->post_id)->latest()->paginate(2);
        return view('livewire.post-comment',['comments' => $comments]);
    }
}
