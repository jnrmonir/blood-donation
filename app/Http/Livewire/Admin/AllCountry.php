<?php

namespace App\Http\Livewire\Admin;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class AllCountry extends Component
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
        $countries = Country::select('id','name','code','phonecode')->withCount('states')->where('name', 'like', '%'.$this->search.'%')->paginate($this->per_page);

        return view('livewire.admin.all-country',['countries' => $countries])->extends('layouts.base');
    }
}
