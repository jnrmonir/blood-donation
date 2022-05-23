<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BloodRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\BloodRequestAgreement;
use App\Models\Notification;
use App\Models\User;

class BloodDonateModal extends Component
{
    public $requestedBlood;
    public $blood_give_date;

    public $message;
    public $from_user_id;
    public $validationStatus = false;
    public $status = false;

    public function mount($requestedBlood){
        $this->requestedBlood = $requestedBlood;
        $this->from_user_id = $requestedBlood->fromUser->id;
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'blood_give_date'=>'required | date | after_or_equal:today',
            'message'=>'required | max:255',
        ]);

        $this->validationStatus = true;
    }


    public function submit(){
        $this->validate([
            'blood_give_date'=>'required | date | after_or_equal:today',
            'message'=>'required | max:255',
        ]);

        $this->status = true;
        if($this->blood_give_date > $this->requestedBlood->blood_need_date){
            session()->flash('wrong', 'Oppss !!. Please Sir Blood Donate into before <b>'.$this->requestedBlood->blood_need_date.'</b>');

        }elseif(Auth::id() == $this->requestedBlood->from_user_id){
            session()->flash('wrong', 'Oppss !!. Sorry Sir That is Your Blood Request');
        }else{
            if(BloodRequestAgreement::where('blood_donar_id',Auth::id())->where('blood_request_id',$this->requestedBlood->id)->exists()){
                session()->flash('wrong', 'Oppss !!. Sorry Sir You Have Already Apply This Request');
            }else{
                $blood_request_aggrement = new BloodRequestAgreement();
                $blood_request_aggrement->blood_request_id = $this->requestedBlood->id;
                $blood_request_aggrement->blood_donar_id = Auth::id();
                $blood_request_aggrement->blood_give_date = $this->blood_give_date;
                $blood_request_aggrement->message = $this->message ?? '';
                if($blood_request_aggrement->save()){
                   $user =  User::find(Auth::id());
                   $user->role_id = 2;
                   $user->update();
                    $notification = new Notification();
                    $notification->user_id = $this->from_user_id;
                    $notification->notification_type = 2;
                    $notification->status = 0;
                    $notification->blood_request_id = $this->requestedBlood->id;
                    $notification->blood_request_agreement_id = $blood_request_aggrement->id;
                    $notification->notification = Auth::user()->email.' give the blood.do you agree this man';
                    $notification->save();
                    session()->flash('status', 'Blood Donation Apply successfully.Thank you Very Much');
                    $this->reset();
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
        return view('livewire.blood-donate-modal');
    }
}
