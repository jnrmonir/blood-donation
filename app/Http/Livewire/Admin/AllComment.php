<?php

namespace App\Http\Livewire\Admin;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class AllComment extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];


    public $per_page = 10;
    public $search;
    public $name;
    public $title;
    public $Comments;
    public $editComments;
    public $comment_id;
    public $deleteComment;
    public $status = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'editComments' => 'required',
        ]);
    }

    public function edit($id){
        $this->editComments= Comment::find($id);
        $this->status = true;
        $this->comment_id= $id;
        $this->name = $this->editComments->user->name;
        $this->title = $this->editComments->post->title;
        $this->Comments = $this->editComments->comment;

    }

    public function update(){
        $this->validate([
            'editComments' => 'required',
        ]);

        if($this->comment_id){
            $updateComment= Comment::find($this->comment_id);
            $updateComment->comment = $this->Comments;

            if($updateComment->update()){
                $this->status = false;
                session()->flash('status','Add Catergory Successfully');
                $this->reset();
            }
            else{
                session()->flash('error','OPPS! What the happen?');
            }
        }
        else{
            return "Id not Found";
        }
    }

    public function delete($id){
        $this->deleteComment= Comment::find($id);
        $this->deleteComment->delete();
    }

    public function render()
    {
        $comments = Comment::with(['post:id,title','user:id,name'])->where('comment', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.all-comment',['comments' => $comments])->extends('layouts.base');
    }
}
