<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllUsers extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];


    public $per_page = 10;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::select('id','name','email','blood_group_id','phone')->with(['bloodGroup:id,short_name'])->withCount('bloodRequests')->withCount('bloodRequestAgreement')->where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.all-users',['users' => $users])->extends('layouts.base');
    }
}
