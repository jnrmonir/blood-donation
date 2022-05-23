<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class SingleBlog extends Component
{
    public $post;

    public function mount($slug){
       $this->post = Post::where('slug',$slug)->first();
        $blogkey = 'blog-'.$this->post->slug;
        if(!Session::has($blogkey)){
            $this->post->increment('view_count');
            Session::put($blogkey,1);
        }
    }
    public function render()
    {
        $recent_posts = Post::latest()->withCount('comments')->paginate(6);
        return view('livewire.single-blog',['recent_posts' => $recent_posts])->extends('layouts.app');
    }
}
