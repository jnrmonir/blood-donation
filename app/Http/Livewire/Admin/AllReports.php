<?php

namespace App\Http\Livewire\Admin;

use App\Models\Reports;
use Livewire\Component;
use Livewire\WithPagination;

class AllReports extends Component
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
        $reports = Reports::with('user:id,name')->where('reports','like','%'.$this->search.'%')->paginate($this->per_page);
        return view('livewire.admin.all-reports',['reports' => $reports])->extends('layouts.base');
    }
}
