<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\BloodGroup;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $full_name = null;
    public $email = null;
    public $phone = null;
    public $password;
    public $password_confirmation;
    public $validationStatus = false;
    public $terms;
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

    public function mount(){
        $this->countries = Country::latest()->get();
        $this->bloodGroups = BloodGroup::latest()->get();
    }



    public function updated($propertyName)
    {
       $this->validateOnly($propertyName,[
            'full_name' => 'required|min:3|string|max:255',
            'email' => 'required|string|email|unique:users,email|max:255',
            'phone'=>'required | numeric | unique:users,phone',
            'password'=>'required|min:08|confirmed',
            'newbloodgroup'=>'required',
            'newcountry'=>'required',
            'newstate'=>'required',
            'newcity'=>'required',
            'address' => 'required',
            'terms' => 'required'
        ]);

       $this->validationStatus = true;
    }


    public function updatedNewcountry(){
        $this->states = State::where('country_id',$this->newcountry)->get();
        $this->phone = Country::find($this->newcountry)->phonecode;
    }

    public function updatedNewstate(){
        $this->cities = City::where('state_id',$this->newstate)->get();
    }

    public function updatedNewcity(){
        $this->address = City::find($this->newcity)->name.', '.State::find($this->newstate)->name.', '.Country::find($this->newcountry)->name;
        $this->validationStatus = true;
    }

    public function register()
    {
        $this->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|unique:users,phone',
            'newbloodgroup' => 'required|numeric',
            'newcountry' => 'required|numeric',
            'newstate' => 'required|numeric',
            'newcity' => 'required|numeric',
            'address' => 'required',
            'password' => 'required|min:8',
        ]);

        $this->status = true;

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
                if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
                    session()->flash('status', 'Registration Has Been Successfully,Thank you');
                    $this->emit('refreshDonar');
                    $this->emit('refreshRequest');
                    $this->reset();
                }
            }else{
                session()->flash('wrong', 'Something Went to Wrong!!');
            }
        }else{
            session()->flash('wrong', 'Something Went to Wrong!!');
        }
    }









    public function render()
    {
        return view('livewire.register');
    }
}
