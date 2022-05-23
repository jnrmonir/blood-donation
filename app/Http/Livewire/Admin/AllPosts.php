<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Post;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Str;
use Image;

class AllPosts extends Component
{
    use WithPagination;
    use WithFileUploads;


    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];
    public $per_page = 10;
    public $search;
    public $categories=[];
    public $title;
    public $slug;
    public $content;
    public $categoryName;
    public $thumbnail;
    public $editPost;
    public $post_id;
    public $editTitle;
    public $editSlug;
    public $editContent;
    public $editCategoryName;
    public $editThumbnail;
    public $status=false;

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function updated($propertyName){
        $this -> validateOnly($propertyName,[
            'title'=> 'required|unique:posts,title',
            'slug'=> 'required',
            'content'=> 'required|min:10|max:255',
            'categoryName'=> 'required',
            'thumbnail'=>  'required|image|max:1024',

            'editTitle'=> 'required|unique:posts,title',
            'editSlug'=> 'required',
            'editContent'=> 'required|min:10|max:255',
            'editCategoryName'=> 'required',
            'editThumbnail'=>  'required|image|max:1024'
        ]);
    }

    public function mount(){
        $this->categories = Category::latest()->get();
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function submit(){
        $this->validate([
            'title'=> 'required|unique:posts,title',
            'slug'=> 'required',
            'content'=> 'required|min:10|max:255',
            'categoryName'=> 'required',
            'thumbnail'=>  'required|image|max:1024'
        ]);

        $photo_name = Auth::user()->name.'.'.$this->thumbnail->getClientOriginalExtension();

        $post= new Post();
        $post->user_id= Auth::user()->id;
        $post->category_id= $this->categoryName;
        $post->title = $this->title;
        $post->thumbnail = $photo_name;
        $post->slug = Str::slug($this->slug);
        $post->content = $this->content;
        // $post->save();

        $img = Image::make($this->thumbnail->getRealPath())->encode('png', 90)->resize(128, 128);
        $img->stream(); // <-- Key point
        Storage::disk('local')->put('public/images/thumbnail' . '/' . $photo_name, $img, 'public');

        if ($post->save()) {
			session()->flash('status','Your Profile Photo Change Successfully Updated!!');
		}else{
			session()->flash('wrong','Something went to wrong');

		}
    }

    // Post Edit Page

    public function edit($id){
        $this->status=true;
        $this->editPost= Post::find($id);
        $this->post_id= $id;
        $this->editTitle= $this->editPost->title;
        $this->editSlug= $this->editPost->slug;
        $this->editContent= $this->editPost->content;
        $this->editCategoryName= $this->editPost->category_id;
        $this->editThumbnail= $this->editPost->thumbnail;

    }

    public function updatedEditTitle()
    {
        $this->editSlug = Str::slug($this->editTitle);
    }

    public function update(){
        $this->validate([
            'editTitle'=> 'required|unique:posts,title',
            'editSlug'=> 'required',
            'editContent'=> 'required|min:10|max:255',
            'editCategoryName'=> 'required',
            'editThumbnail'=>  'required|image|max:1024'
        ]);

        if($this->post_id){
            $thumbnail = $this->post_id.'.'.$this->editThumbnail->getClientOriginalExtension();

            $updatePost= Post::find($this->post_id);
            $updatePost->title= $this->editTitle;
            $updatePost->slug= Str::slug($this->editSlug);
            $updatePost->content= $this->editContent;
            $updatePost->category_id= $this->editCategoryName;
            $updatePost->thumbnail= $thumbnail;

            $img = Image::make($this->editThumbnail->getRealPath())->encode('png', 90)->resize(128, 128);
            $img->stream(); // <-- Key point
            Storage::disk('local')->put('public/images/thumbnail' . '/' . $thumbnail, $img, 'public');

            if ($updatePost->update()) {
                session()->flash('status','Your Profile Photo Change Successfully Updated!!');
                $this->reset();
            }else{
                session()->flash('wrong','Something went to wrong');

            }
        }
        else{
            return "Id not found";
        }

    }

    public function render()
    {
        $posts = Post::select('id','category_id','user_id','title','status','thumbnail')->where('title', 'like', '%'.$this->search.'%')->with(['user:id,name','category:id,name'])->withCount('comments')->paginate($this->per_page);

        return view('livewire.admin.all-posts',['posts' => $posts])->extends('layouts.base');
    }
}
