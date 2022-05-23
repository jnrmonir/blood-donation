<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\BloodRequest;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\BloodRequestAgreement;

class SingleRequestedBlood extends Component
{
    protected $listeners = ['refreshRequest' => '$refresh'];

    public $requestedBlood;
    public $agreement_with_donars;
    public $request_to_donars;
    public $donar_want_doantes;
    public $validationStatus = false;
    // public $blood_give_date;
    public $message;
    public $status;
    public $note;


    public function mount($slug){
        $this->requestedBlood = BloodRequest::where('slug',$slug)->firstOrFail();
        $this->agreement_with_donars = $this->requestedBlood->bloodRequestAgreement()->where('approved',1)->where('status',1)->get();
        $this->donar_want_doantes = $this->requestedBlood->bloodRequestAgreement()->where('approved',0)->get();
        $this->request_to_donars = $this->requestedBlood->bloodDonars;
        // dd($this->request_to_donars);
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            // 'blood_give_date'=>'required | date | after_or_equal:today',
            'note'=>'required | max:255',
        ]);

        $this->validationStatus = true;
    }


    public function approvedBloodDonar($id){
        $requestAgreement = BloodRequestAgreement::find($id);
        $requestAgreement->approved = 1;
        $requestAgreement->status = 1;
          if($requestAgreement->update()){
              $notification = new Notification();
              $notification->user_id = $requestAgreement->blood_donar_id;
              $notification->notification_type = 3;
              $notification->blood_request_id = $this->requestedBlood->id;
              $notification->blood_request_agreement_id = $requestAgreement->id;
              $notification->notification = Auth::user()->email.'. Will Agree Received Your Blood.Please Contact and Gives Your Blood.Thank You!!';
              $notification->save();
              $user = User::find($requestAgreement->blood_donar_id);
              $user->last_blood_donation = Carbon::now();
              $user->update();
              $this->status = true;
            //   $this->emit('refreshRequest');
              session()->flash('status','Agreement Successfully Updated!!');
              redirect()->route('single_requested_blood',$this->requestedBlood->slug);
          }else{
              session()->flash('wrong','Something went to wrong');
          }
      }

    public function submit(){
        $this->validate([
            // 'blood_give_date'=>'required | date | after_or_equal:today',
            'note'=>'required | max:255',
        ]);

        $this->status = true;
        // if($this->blood_give_date > $this->requestedBlood->blood_need_date){
        //     session()->flash('wrong', 'Oppss !!. Please Sir Blood Donate into before <b>'.$this->requestedBlood->blood_need_date.'</b>');

        // }else
        if(Auth::id() == $this->requestedBlood->from_user_id){
            session()->flash('wrong', 'Oppss !!. Sorry Sir That is Your Blood Request');
        }else{
            if(BloodRequestAgreement::where('blood_donar_id',Auth::id())->where('blood_request_id',$this->requestedBlood->id)->exists()){
                session()->flash('wrong', 'Oppss !!. Sorry Sir You Have Already Apply This Request');
            }else{
                $blood_request_aggrement = new BloodRequestAgreement();
                $blood_request_aggrement->blood_request_id = $this->requestedBlood->id;
                $blood_request_aggrement->blood_donar_id = Auth::id();
                // $blood_request_aggrement->blood_give_date = $this->blood_give_date;
                $blood_request_aggrement->message = $this->note ?? '';
                if($blood_request_aggrement->save()){
                   $user =  User::find(Auth::id());
                   $user->role_id = 2;
                   $user->update();
                    $notification = new Notification();
                    $notification->user_id = $this->requestedBlood->from_user_id;
                    $notification->notification_type = 2;
                    $notification->status = 0;
                    $notification->blood_request_id = $this->requestedBlood->id;
                    $notification->blood_request_agreement_id = $blood_request_aggrement->id;
                    $notification->notification = Auth::user()->email.' give the blood.do you agree this man';
                    $notification->save();
                    session()->flash('status', 'Blood Donation Apply successfully.Thank you Very Much');
                    $this->emit('refreshRequest');


                }else{
                    session()->flash('wrong', 'Something Went to wrong');
                }
            }

        }

        $this->status = false;

    }

    public function render()
    {
        return view('livewire.single-requested-blood')->extends('layouts.app');
    }
}
