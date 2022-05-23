<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class UpdateCurrentLocation extends Component
{

    public $countries = [];
    public $states = [];
    public $cities = [];

    public $newcountry = null;
    public $newstate = null;
    public $newcity = null;
    public $address = null;

    public function mount(){
        $this->countries = Country::all();
        $this->newcountry = Auth::user()->profile->present_country_id;
        $this->states = State::where('country_id',$this->newcountry)->get();
        $this->newstate = Auth::user()->profile->present_state_id;
        $this->cities = City::where('state_id',$this->newstate)->get();
        $this->newcity = Auth::user()->profile->present_city_id;
        $this->address = City::find($this->newcity)->name.', '.State::find($this->newstate)->name.', '.Country::find($this->newcountry)->name;

    }

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
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


    protected $rules = [
        'newcountry'=>'required | integer',
        'newstate'=>'required | integer',
        'newcity'=>'required | integer',
        'address' => 'required'
    ];

    public function submit(){
    	$this->validate();
    	$user = Auth::user()->profile;
    	$user->present_country_id = $this->newcountry;
    	$user->present_state_id = $this->newstate;
    	$user->present_city_id = $this->newcity;
    	$user->present_address = $this->address;

    	if ($user->update()) {
			session()->flash('status','Your Present Location Successfully Updated!!');
            $this->emit('refreshLocation');
		}else{
			session()->flash('wrong','Something went to wrong');

		}
    }

    // public function updatedNewcountry(){
    //     $this->states = State::where('country_id',$this->newcountry)->get();
    // }

    // public function updatedNewstate(){
    //     $this->cities = City::where('state_id',$this->newstate)->get();
    // }

    // public function updatedNewcity(){
    //     $this->address = City::find($this->newcity)->name.', '.State::find($this->newstate)->name.', '.Country::find($this->newcountry)->name;
    //     $this->validationStatus = true;
    // }

    public function render()
    {
        return view('livewire.update-current-location');
    }
}
