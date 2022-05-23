<?php

namespace App\Http\Livewire\Admin;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;

class AllCity extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public $per_page = 100;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $cities = City::select('id','name','state_id')->where('name','like','%'.$this->search.'%')->with('state:id,name,country_id')->paginate($this->per_page);
        return view('livewire.admin.all-city',['cities' => $cities])->extends('layouts.base');
    }
}
