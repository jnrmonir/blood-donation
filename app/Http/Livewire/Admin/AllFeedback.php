<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Feedback;
use Livewire\WithPagination;


class AllFeedback extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public $per_page;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $feedbacks = Feedback::select('id','feedback','user_id','status','updated_at')->with(['user:id,name'])->where('feedback','like','%'.$this->search.'%')->paginate($this->per_page);
        // dd($feedbacks);
        return view('livewire.admin.all-feedback',['feedbacks' => $feedbacks])->extends('layouts.base');
    }
}
