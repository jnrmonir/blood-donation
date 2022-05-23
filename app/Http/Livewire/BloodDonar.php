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
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BloodRequestAgreement;
use Illuminate\Database\Eloquent\Builder;

class BloodDonar extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshRequest' => '$refresh'];

    public $full_name = null;
    public $email = null;
    public $phone = null;
    public $password;
    public $password_confirmation;

    public $updateStatus = false;
    public $exist_blood_requests = [];
    public $exist_blood_request_id;

    public $bloodgroups = [];
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $selectedbloodgroup;
    public $selectedcountry;
    public $selectedstate;
    public $selectedcity;

    public $single_blood_donar = null;
    public $optional_contact_number;

    public $blood_need_date;
    public $note;
    public $validationStatus = false;
    public $status = false;
    public $newbloodgroup = null;
    public $newcountry = null;
    public $newstate = null;
    public $newcity = null;
    public $address = null;


    public function mount(){
        $this->bloodgroups = BloodGroup::select('id','full_name')->get();
        $this->countries = Country::all();
        if(Auth::check()){
            $this->newbloodgroup = Auth::user()->blood_group_id;
            $this->address = Auth::user()->profile->present_address;
            if(Auth::user()->has('bloodRequests')){
                $this->updateStatus = true;
                $this->exist_blood_requests = Auth::user()->bloodRequests()->select('id','blood_group_id','updated_at')->latest()->get();

            }
        }
    }

    public function updatingSelectedbloodgroup()
    {
        $this->resetPage();
    }

    public function updateExistRequest()
    {
        $this->updateStatus = true;
    }

    public function createNewRequest()
    {
        $this->updateStatus = false;
    }

    public function updateRequest()
    {

        if(DB::table('user_blood_request_to_blood_donar')->where('blood_donar_id', $this->single_blood_donar->id)->where('blood_request_id',$this->exist_blood_request_id)->exists()){
            session()->flash('wrong','Oppss!!,Sorry Sir You Have Already Blood Requested To This User.');
        }else{
            $exist_blood_request = BloodRequest::find($this->exist_blood_request_id);
            $exist_blood_request->bloodDonars()->attach($this->single_blood_donar->id,['message' => $this->note]);
            $notification = new Notification();
            $notification->user_id = $this->single_blood_donar->id;
            $notification->notification_type = 1;
            $notification->blood_request_id = $this->exist_blood_request_id;
            $notification->notification = Auth::user()->email.' A New Blood Requested.Do You want To donate Blood Please Click here';
            $notification->save();

            session()->flash('status','Blood Request Has Been Successfully.Thank You For Your Request');
            $this->emit('refreshRequest');
        }

    }

    public function updatedSelectedcountry(){
        $this->states = State::select('id','country_id','name')->where('country_id',$this->selectedcountry)->get();
        $this->resetPage();
    }

    public function updatedSelectedState(){
        $this->cities = City::select('id','state_id','name','parent_id')->where('state_id',$this->selectedstate)->get();
        $this->resetPage();
    }

    public function updatingSelectedcity()
    {
        $this->resetPage();
    }


    public function requestForBlood($id){

        $this->single_blood_donar = User::select('id','name')->bloodDonar()->where('id',$id)->first();


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

            $blood_request->from_user_id = Auth::id();
            $blood_request->to_user_id = $this->single_blood_donar->id;
            $blood_request->blood_group_id = $this->newbloodgroup;
            $blood_request->country_id = $this->newcountry;
            $blood_request->state_id = $this->newstate;
            $blood_request->city_id = $this->newcity;
            $blood_request->address = $this->address;
            $blood_request->slug = $slug;
            $blood_request->primary_contact_number = Auth::user()->phone;
            $blood_request->optional_contact_number = $this->optional_contact_number ?? '';
            $blood_request->blood_need_date = $this->blood_need_date;
            $blood_request->note = $this->note ?? '';

            if($blood_request->save()){

                $notification = new Notification();
                $notification->user_id = $this->single_blood_donar->id;
                $notification->notification_type = 1;
                $notification->blood_request_id = $blood_request->id;
                $notification->notification = Auth::user()->email.' A New Blood Requested.Do You want To donate Blood Please Click here';
                $notification->save();

                session()->flash('status','Blood Request Has Been Successfully.Thank You For Your Request');
                $this->emit('refreshRequest');
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
                            $this->emit('refreshRequest');

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



    public function render()
    {
        if($this->selectedbloodgroup > 0 && $this->selectedcountry > 0 && $this->selectedstate > 0 && $this->selectedcity > 0){
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile',function(Builder $query){
                $query->where('present_country_id',$this->selectedcountry)
                ->where('present_state_id',$this->selectedstate)
                ->where('present_city_id',$this->selectedcity);
            })->where('blood_group_id',$this->selectedbloodgroup)->bloodDonar()->latest()->paginate(10);

        }elseif($this->selectedbloodgroup > 0 && $this->selectedcountry > 0 && $this->selectedstate > 0){
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile',function(Builder $query){
                $query->where('present_country_id',$this->selectedcountry)
                ->where('present_state_id',$this->selectedstate);
            })->where('blood_group_id',$this->selectedbloodgroup)->bloodDonar()->latest()->paginate(10);

        }elseif($this->selectedbloodgroup > 0 && $this->selectedcountry > 0 ){
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile',function(Builder $query){
                $query->where('present_country_id',$this->selectedcountry);
            })->where('blood_group_id',$this->selectedbloodgroup)->bloodDonar()->latest()->paginate(10);

        }elseif($this->selectedbloodgroup > 0){
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile')->where('blood_group_id',$this->selectedbloodgroup)->bloodDonar()->latest()->paginate(10);

        }elseif($this->selectedbloodgroup == 0 && $this->selectedcountry > 0 && $this->selectedstate > 0 && $this->selectedcity > 0){
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile',function(Builder $query){
                $query->where('present_country_id',$this->selectedcountry)
                ->where('present_state_id',$this->selectedstate)
                ->where('present_city_id',$this->selectedcity);
            })->bloodDonar()->latest()->paginate(10);

        }elseif($this->selectedbloodgroup == 0 && $this->selectedcountry > 0 && $this->selectedstate > 0){
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile',function(Builder $query){
                $query->where('present_country_id',$this->selectedcountry)
                ->where('present_state_id',$this->selectedstate);
            })->latest()->bloodDonar()->paginate(10);

        }elseif($this->selectedbloodgroup == 0 && $this->selectedcountry > 0 ){
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile',function(Builder $query){
                $query->where('present_country_id',$this->selectedcountry);
            })->bloodDonar()->latest()->paginate(10);

        }else{
            $bloodDonars = User::select('id','role_id','name','blood_group_id','last_blood_donation','last_seen','phone','profile_photo_path','slug')->with(['profile:id,user_id,present_address,present_country_id,present_state_id,present_city_id','bloodGroup:id,full_name'])->whereHas('profile')->bloodDonar()->latest()->paginate(10);

        }

        // dd($bloodDonars);
        return view('livewire.blood-donar',['bloodDonars' => $bloodDonars])->extends('layouts.app');
    }
}
