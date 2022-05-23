<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OthersInformation extends Component
{
	public $alt_contact_number=null;
	public $date=null;
	public $gender=null;
    public $area_representive;

	public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
		'alt_contact_number'=>'required',
		'date'=>'required',
		'gender'=>'required',
	    ]);
	}

    public function mount(){
		$user = Auth::user()->profile;
		$this->alt_contact_number = $user->alt_contact_number;
		$this->date = $user->date_of_birth;
		$this->gender = $user->gender;
        $this->area_representive = $user->status;
	}

	public function submit(){
		$this->validate([
			'alt_contact_number'=>'required | numeric',
			'date'=>'required | date',
			'gender'=>'required',
		]);

		$user = Auth::user()->profile;
		$user->alt_contact_number = $this->alt_contact_number;
		$user->date_of_birth = $this->date;
		$user->gender = $this->gender;
        if($this->area_representive == true){
            $user->status = 1;
        }


		if ($user->update()) {
			session()->flash('status','Your Other Information Successfully Updated!!');
            $this->emit('refreshLocation');
		}else{
			session()->flash('wrong','Something went to wrong');

		}
	}

    public function render()
    {
        return view('livewire.others-information');
    }
}
