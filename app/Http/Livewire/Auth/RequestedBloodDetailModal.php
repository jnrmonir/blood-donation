<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\BloodRequestAgreement;
use App\Models\User;
use Carbon\Carbon;

class RequestedBloodDetailModal extends Component
{

    public $requestedBlood;
    public $blood_give_date;
    public $blood_give_time;
    public $blood_give_bag;
    public $message;
    public $validationStatus = false;
    public $status = false;



    public function mount($requestedBlood){
        $this->requestedBlood = $requestedBlood;
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
            session()->flash('status','Agreement Successfully Updated!!');
            $this->emitUp('refreshModal');
            $this->status = true;
        }else{
            session()->flash('wrong','Something went to wrong');
        }
    }

    public function render()
    {
        return view('livewire.auth.requested-blood-detail-modal');
    }
}
