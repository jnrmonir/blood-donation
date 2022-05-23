<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;

    public $search;
    public $filter = 'latest';
    protected $paginationTheme = 'bootstrap';



    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }



    public function render()
    {
        if($this->filter == 'latest'){
            $posts = Post::select('id','title','slug','content','thumbnail','updated_at')->latest()->withCount('comments')->where('title', 'like', '%'.$this->search.'%')->paginate(16);
        }elseif($this->filter == 'viewer'){
            $posts = Post::select('id','title','slug','content','thumbnail','updated_at')->withCount('comments')->where('title', 'like', '%'.$this->search.'%')->orderBy('view_count','desc')->paginate(16);

        }elseif($this->filter == 'popular'){
            $posts = Post::select('id','title','slug','content','thumbnail','updated_at')->withCount('comments')->where('title', 'like', '%'.$this->search.'%')->where('comments_count','desc')->paginate(16);
        }else{
            $posts = Post::select('id','title','slug','content','thumbnail','updated_at')->withCount('comments')->where('title', 'like', '%'.$this->search.'%')->latest()->paginate(16);
        }
        return view('livewire.blog',['posts' => $posts])->extends('layouts.app');
    }
}
