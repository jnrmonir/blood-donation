<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\BloodRequest;
use Livewire\WithPagination;

class RequestedBlood extends Component
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
        $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_bag','blood_need_date','updated_at')->with(['fromUser:id,name','bloodGroup:id,short_name'])->withCount('bloodRequestAgreement')->where('blood_need_date','like','%'.$this->search.'%')->paginate($this->per_page);

        return view('livewire.admin.requested-blood',['requestedBloods' => $requestedBloods])->extends('layouts.base');
    }
}
