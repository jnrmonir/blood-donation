<?php

namespace App\Http\Livewire\Admin;

use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class AllStates extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public $per_page = 20;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPer_page()
    {
        $this->resetPage();
    }

    public function render()
    {
        $states = State::select('id','name','country_id')->with(['country:id,name'])->withCount('cities')->where('name','like','%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.all-states',['states' => $states])->extends('layouts.base');
    }
}
