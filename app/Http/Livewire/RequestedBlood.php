<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\BloodGroup;
use App\Models\BloodRequest;
use App\Models\Notification;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\BloodRequestAgreement;

class RequestedBlood extends Component
{
    use WithPagination;


    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshDonar' => '$refresh'];

    public $bloodgroups = [];
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $selectedbloodgroup;
    public $selectedcountry;
    public $selectedstate;
    public $selectedcity;


    public $single_requested_blood = null;
    // public $blood_give_date;
    public $message;
    public $validationStatus = false;
    public $status;

    public function mount(){
        $this->bloodgroups = BloodGroup::all();
        $this->countries = Country::all();

    }

    public function updatingSelectedbloodgroup()
    {
        $this->resetPage();
    }

    public function updatedSelectedcountry(){
        $this->states = State::where('country_id',$this->selectedcountry)->get();
        $this->resetPage();
    }

    public function updatedSelectedState(){
        $this->cities = City::where('state_id',$this->selectedstate)->get();
        $this->resetPage();
    }

    public function updatingSelectedcity()
    {
        $this->resetPage();
    }


    public function bloodDonate($id)
    {
        $this->single_requested_blood = BloodRequest::find($id);

    }


    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            // 'blood_give_date'=>'required | date | after_or_equal:today',
            'message'=>'required | max:255',
        ]);

        $this->validationStatus = true;
    }

    public function submit(){
        $this->validate([
            // 'blood_give_date'=>'required | date | after_or_equal:today',
            'message'=>'required | max:255',
        ]);

        $this->status = true;
        // if($this->blood_give_date > $this->single_requested_blood->blood_need_date){
        //     session()->flash('wrong', 'Oppss !!. Please Sir Blood Donate into before <b>'.$this->single_requested_blood->blood_need_date.'</b>');

        // }else
        if(Auth::id() == $this->single_requested_blood->from_user_id){
            session()->flash('wrong', 'Oppss !!. Sorry Sir That is Your Blood Request');
        }else{
            if(BloodRequestAgreement::where('blood_donar_id',Auth::id())->where('blood_request_id',$this->single_requested_blood->id)->exists()){
                session()->flash('wrong', 'Oppss !!. Sorry Sir You Have Already Apply This Request');
            }else{
                $blood_request_aggrement = new BloodRequestAgreement();
                $blood_request_aggrement->blood_request_id = $this->single_requested_blood->id;
                $blood_request_aggrement->blood_donar_id = Auth::id();
                // $blood_request_aggrement->blood_give_date = $this->blood_give_date;
                $blood_request_aggrement->message = $this->message ?? '';
                if($blood_request_aggrement->save()){
                   $user =  User::find(Auth::id());
                   $user->role_id = 2;
                   $user->update();
                    $notification = new Notification();
                    $notification->user_id = $this->single_requested_blood->from_user_id;
                    $notification->notification_type = 2;
                    $notification->status = 0;
                    $notification->blood_request_id = $this->single_requested_blood->id;
                    $notification->blood_request_agreement_id = $blood_request_aggrement->id;
                    $notification->notification = Auth::user()->email.' give the blood.do you agree this man';
                    $notification->save();
                    session()->flash('status', 'Blood Donation Apply successfully.Thank you Very Much');
                    $this->emit('refreshDonar');

                }else{
                    session()->flash('wrong', 'Something Went to wrong');
                }
            }

        }

        $this->status = false;

    }



    public function render()
    {
        if($this->selectedbloodgroup > 0 && $this->selectedcountry > 0 && $this->selectedstate > 0 && $this->selectedcity > 0){
            $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
            ->where('blood_group_id',$this->selectedbloodgroup)
            ->where('country_id',$this->selectedcountry)
            ->where('state_id',$this->selectedstate)
            ->where('city_id',$this->selectedcity)->latest()->paginate(10);

        }elseif($this->selectedbloodgroup > 0 && $this->selectedcountry > 0 && $this->selectedstate > 0){
            $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
            ->where('blood_group_id',$this->selectedbloodgroup)
            ->where('country_id',$this->selectedcountry)
            ->where('state_id',$this->selectedstate)
            ->latest()->paginate(10);

        }elseif($this->selectedbloodgroup > 0 && $this->selectedcountry > 0){
            $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
            ->where('blood_group_id',$this->selectedbloodgroup)
            ->where('country_id',$this->selectedcountry)
            ->latest()->paginate(10);

        }elseif($this->selectedbloodgroup > 0){
            $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
            ->where('blood_group_id',$this->selectedbloodgroup)
            ->latest()->paginate(10);

        }elseif($this->selectedbloodgroup == 0 && $this->selectedcountry > 0 && $this->selectedstate > 0 && $this->selectedcity > 0){
           $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
            ->where('country_id',$this->selectedcountry)
            ->where('state_id',$this->selectedstate)
            ->where('city_id',$this->selectedcity)->latest()->paginate(10);

        }elseif($this->selectedbloodgroup == 0 && $this->selectedcountry > 0 && $this->selectedstate > 0){
            $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
             ->where('country_id',$this->selectedcountry)
             ->where('state_id',$this->selectedstate)
             ->latest()->paginate(10);

        }elseif($this->selectedbloodgroup == 0 && $this->selectedcountry > 0){
            $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
             ->where('country_id',$this->selectedcountry)
             ->latest()->paginate(10);
         }else{
            $requestedBloods = BloodRequest::select('id','from_user_id','blood_group_id','blood_need_date','address','updated_at','primary_contact_number','slug')->withCount('bloodRequestAgreement')->with(['fromUser:id,name','bloodGroup:id,full_name'])
            ->latest()->paginate(10);
        }

        return view('livewire.requested-blood',['requestedBloods' => $requestedBloods])->extends('layouts.app');
    }
}
