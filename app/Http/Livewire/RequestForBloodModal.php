<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\BloodGroup;
use App\Models\BloodRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class RequestForBloodModal extends Component
{
    public $user;
    public $primary_contact_number;
    public $optional_contact_number;
    public $blood_need_bag;
    public $blood_need_time;
    public $blood_need_date;
    public $note;
    public $validationStatus = false;
    public $status = false;

    public $bloodGroups = [];
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $newbloodgroup = null;
    public $newcountry = null;
    public $newstate = null;
    public $newcity = null;
    public $address = null;

    public function mount($user)
    {
        $this->user = $user;
        $this->countries = Country::latest()->get();
        $this->bloodGroups = BloodGroup::latest()->get();
        if(Auth::check()){
            $this->newbloodgroup = Auth::user()->blood_group_id;
            $this->newcountry = Auth::user()->profile->present_country_id;
            $this->primary_contact_number = Auth::user()->phone;
            $this->states = State::where('country_id',$this->newcountry)->get();
            $this->newstate = Auth::user()->profile->present_state_id;
            $this->cities = City::where('state_id',$this->newstate)->get();
            $this->newcity = Auth::user()->profile->present_city_id;
            $this->address = City::find($this->newcity)->name.', '.State::find($this->newstate)->name.', '.Country::find($this->newcountry)->name;
        }


    }

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'newbloodgroup'=>'required | integer',
            'newcountry'=>'required | integer',
            'newstate'=>'required | integer',
            'newcity'=>'required | integer',
            'address' => 'required',
            'primary_contact_number' => 'required | numeric',
            'optional_contact_number' => 'nullable | numeric',
            'blood_need_date' => 'required | date',
            'blood_need_time' => 'required',
            'blood_need_bag' => 'required | integer | between:1,5',
        ]);

        $this->validationStatus = true;
    }


    public function submit(){
        $this->validate([
            'newbloodgroup'=>'required | integer',
            'newcountry'=>'required | integer',
            'newstate'=>'required | integer',
            'newcity'=>'required | integer',
            'address' => 'required',
            'primary_contact_number' => 'required | numeric',
            'optional_contact_number' => 'nullable | numeric',
            'blood_need_date' => 'required | date',
            'blood_need_time' => 'required',
            'blood_need_bag' => 'required | integer | between:1,5',
        ]);

        $this->status = true;

        $blood_request = new BloodRequest();

        $blood_request->from_user_id = Auth::user()->id;
        $blood_request->to_user_id = $this->user->id;
        $blood_request->blood_group_id = $this->newbloodgroup;
        $blood_request->country_id = $this->newcountry;
        $blood_request->state_id = $this->newstate;
        $blood_request->city_id = $this->newcity;
        $blood_request->address = $this->address;
        $blood_request->primary_contact_number = $this->primary_contact_number;
        $blood_request->optional_contact_number = $this->optional_contact_number ?? '';
        $blood_request->blood_need_date = $this->blood_need_date;
        $blood_request->blood_need_time = date('h:i A', strtotime($this->blood_need_time));
        $blood_request->blood_need_bag = $this->blood_need_bag;
        $blood_request->note = $this->note ?? '';

        if($blood_request->save()){

            $notification = new Notification();
            $notification->user_id = $this->user->id;
            $notification->notification_type = 1;
            $notification->blood_request_id = $blood_request->id;
            $notification->notification = Auth::user()->email.' A New Blood Requested.Do You want To donate Blood Please Click here';
            $notification->save();

            session()->flash('status','Blood Request Has Been Successfully.Thank You For Your Request');
            $this->reset();
            $this->emit('refreshRequest');
        }else{
            session()->flash('wrong','Opps!!. Something went to wrong!!!');

        }

    }

    public function updatedNewcountry(){
        $this->states = State::where('country_id',$this->newcountry)->get();
        $this->optional_contact_number = Country::find($this->newcountry)->phonecode;
    }

    public function updatedNewstate(){
        $this->cities = City::where('state_id',$this->newstate)->get();
    }

    public function updatedNewcity(){
        $this->address = City::find($this->newcity)->name.', '.State::find($this->newstate)->name.', '.Country::find($this->newcountry)->name;
        $this->validationStatus = true;
    }


    public function render()
    {
        return view('livewire.request-for-blood-modal');
    }
}
