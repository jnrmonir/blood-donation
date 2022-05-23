<?php

namespace App\Http\Livewire;


use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\BloodGroup;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use App\Models\BloodRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RequestForBlood extends Component
{
    protected $listeners = ['refreshRequest' => '$refresh'];

    public $full_name = null;
    public $email = null;
    public $phone = null;
    public $password;
    public $password_confirmation;


    public $optional_contact_number;

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

    public function mount()
    {

        $this->countries = Country::latest()->get();
        $this->bloodGroups = BloodGroup::latest()->get();

        if(Auth::check()){
            $this->newbloodgroup = Auth::user()->blood_group_id;
            $this->address = Auth::user()->profile->present_address;
        }


    }


    public function updated($propertyName){
        if(Auth::check()){
            $this->validateOnly($propertyName,[
                'newbloodgroup'=>'required | integer',
                'newcountry'=>'required | integer',
                'newstate'=>'required | integer',
                'newcity'=>'required | integer',
                'address' => 'required',
                'optional_contact_number' => 'nullable | numeric',
                'blood_need_date' => 'required | date',
            ]);
        }else{
            $this->validateOnly($propertyName,[
                'full_name' => 'required|min:3|string|max:255',
                'email' => 'required|string|email|unique:users,email|max:255',
                'phone'=>'required | numeric | unique:users,phone',
                'password'=>'required|min:08|confirmed',
                'newbloodgroup'=>'required | integer',
                'newcountry'=>'required | integer',
                'newstate'=>'required | integer',
                'newcity'=>'required | integer',
                'address' => 'required',
                'optional_contact_number' => 'nullable | numeric',
                'blood_need_date' => 'required | date',
            ]);
        }

        $this->validationStatus = true;
    }

    public function submit(){
        if(Auth::check()){
            $this->validate([
                'newbloodgroup'=>'required | integer',
                'newcountry'=>'required | integer',
                'newstate'=>'required | integer',
                'newcity'=>'required | integer',
                'address' => 'required',
                'optional_contact_number' => 'nullable | numeric',
                'blood_need_date' => 'required | date',
            ]);
        }else{
            $this->validate([
                'full_name' => 'required|min:3|string|max:255',
                'email' => 'required|string|email|unique:users,email|max:255',
                'phone'=>'required | numeric | unique:users,phone',
                'password'=>'required|min:08',
                'newbloodgroup'=>'required | integer',
                'newcountry'=>'required | integer',
                'newstate'=>'required | integer',
                'newcity'=>'required | integer',
                'address' => 'required',
                'optional_contact_number' => 'nullable | numeric',
                'blood_need_date' => 'required | date',
            ]);
        }

        $this->status = true;

        if(Auth::check()){
            $slug = Str::slug(Auth::user()->name.'-blood-'.BloodGroup::find($this->newbloodgroup)->full_name.'-'.Str::uuid());

            $blood_request = new BloodRequest();
            $blood_request->from_user_id = Auth::user()->id;
            $blood_request->blood_group_id = $this->newbloodgroup;
            $blood_request->country_id = $this->newcountry;
            $blood_request->state_id = $this->newstate;
            $blood_request->city_id = $this->newcity;
            $blood_request->address = $this->address;
            $blood_request->slug = $slug;
            $blood_request->primary_contact_number = Auth::user()->phone;;
            $blood_request->optional_contact_number = $this->optional_contact_number ?? '';
            $blood_request->blood_need_date = $this->blood_need_date;
            $blood_request->note = $this->note ?? '';

            if($blood_request->save()){
                $users = User::bloodDonar()->where('blood_group_id',$this->newbloodgroup)->get();
                if($users->count() > 0){
                    foreach ($users as $user) {
                        $notification = new Notification();
                        $notification->user_id = $user->id;
                        $notification->notification_type = 1;
                        $notification->blood_request_id = $blood_request->id;
                        $notification->notification = Auth::user()->email.' A New Blood Requested.Do You want To donate Blood Please Click here';
                        $notification->save();
                    }
                }

                session()->flash('status','Blood Request Has Been Successfully.Thank You For Your Request');
                $this->reset();
                $this->emit('refreshRequest');
                redirect()->route('auth.requested_blood',Auth::user()->slug);

            }else{
                session()->flash('wrong','Opps!!. Something went to wrong!!!');
            }
        }else{
            $user = new User();
            $user->name = $this->full_name;
            $user->slug = Str::slug($this->full_name.'-'.Str::random(8));
            $user->role_id = 2;
            $user->blood_group_id = $this->newbloodgroup;
            $user->email = $this->email;
            $user->email_verified_at = Carbon::now();
            $user->phone = $this->phone;
            $user->password = Hash::make($this->password);
            if($user->save()){
                $userProfile = new UserProfile();
                $userProfile->present_country_id = $this->newcountry;
                $userProfile->present_state_id = $this->newstate;
                $userProfile->present_city_id = $this->newcity;
                $userProfile->present_address = $this->address;
                $userProfile->permanent_country_id = $this->newcountry;
                $userProfile->permanent_state_id = $this->newstate;
                $userProfile->permanent_city_id = $this->newcity;
                $userProfile->permanent_address = $this->address;
                if($user->profile()->save($userProfile)){

                    $slug = Str::slug($user->name.'-blood-'.BloodGroup::find($this->newbloodgroup)->full_name.'-'.Str::uuid());

                    $blood_request = new BloodRequest();
                    $blood_request->from_user_id = $user->id;
                    $blood_request->blood_group_id = $this->newbloodgroup;
                    $blood_request->country_id = $this->newcountry;
                    $blood_request->state_id = $this->newstate;
                    $blood_request->city_id = $this->newcity;
                    $blood_request->address = $this->address;
                    $blood_request->slug = $slug;
                    $blood_request->primary_contact_number = $this->phone;;
                    $blood_request->optional_contact_number = $this->optional_contact_number ?? '';
                    $blood_request->blood_need_date = $this->blood_need_date;
                    $blood_request->note = $this->note ?? '';

                    if($blood_request->save()){
                        $users_notification = User::bloodDonar()->where('blood_group_id',$this->newbloodgroup)->get();
                        if($users_notification->count() > 0){
                            foreach ($users_notification as $user_notification) {
                                $notification = new Notification();
                                $notification->user_id = $user_notification->id;
                                $notification->notification_type = 1;
                                $notification->blood_request_id = $blood_request->id;
                                $notification->notification = $this->email.' A New Blood Requested.Do You want To donate Blood Please Click here';
                                $notification->save();
                            }
                        }
                        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
                            session()->flash('status','Blood Request Has Been Successfully.Thank You For Your Request');
                            $this->reset();
                            $this->emit('refreshRequest');
                            redirect()->route('auth.requested_blood',$user->slug);
                        }

                    }else{
                        session()->flash('wrong','Opps!!. Something went to wrong!!!');
                    }
                }else{
                    session()->flash('wrong', 'Something Went to Wrong!!');
                }
            }else{
                session()->flash('wrong', 'Something Went to Wrong!!');
            }
        }


    }

    public function updatedNewcountry(){
        $this->states = State::where('country_id',$this->newcountry)->get();
        $country = Country::find($this->newcountry);
        $this->optional_contact_number = $country->phonecode;

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
        return view('livewire.request-for-blood')->extends('layouts.app');
    }
}
