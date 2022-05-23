<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\BloodGroup;
use Illuminate\Support\Facades\Auth;

class Location extends Component
{
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
        if(Auth::check()){
            $this->newbloodgroup = Auth::user()->blood_group_id;
            $this->newcountry = Auth::user()->profile->present_country_id;
            $this->states = State::where('country_id',$this->newcountry)->get();
            $this->newstate = Auth::user()->profile->present_state_id;
            $this->cities = City::where('state_id',$this->newstate)->get();
            $this->newcity = Auth::user()->profile->present_city_id;
            $this->address = City::find($this->newcity)->name.', '.State::find($this->newstate)->name.', '.Country::find($this->newcountry)->name;

        }
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'newbloodgroup'=>'required',
            'newcountry'=>'required',
            'newstate'=>'required',
            'newcity'=>'required',
            'address' => 'required'
        ]);
    }

    public function updatedNewcountry(){
        $this->states = State::where('country_id',$this->newcountry)->get();
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
        return view('livewire.location');
    }
}
