<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class AllNotification extends Component
{
    public $user;

    use WithPagination;

    public $checked = [];
    public $selected = [];


    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshRequest' => '$refresh'];

    public function submit($id){
       $notification = Notification::find($id);
       $notification->status = 1;
       $notification->save();
       $this->reset();
    }

    public function deleted(){
        if($this->checked == null){
           session()->flash('wrong','Something Went To Wrong!!');
           $this->reset();
        }else{
            foreach ($this->checked as $key => $value) {
                $notification = Notification::find($value)->delete();
            }
            session()->flash('status','Deleted Successfully!');
            $this->emit('refreshRequest');
        }


    }

    public function render()
    {
        $notifications =  Notification::where('user_id',Auth::id())->latest()->paginate(10);
        return view('livewire.auth.all-notification',['notifications' => $notifications])->extends('layouts.app');
    }
}
