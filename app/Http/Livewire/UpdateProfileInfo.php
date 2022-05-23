<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdateProfileInfo extends Component
{
	public $name;
	public $phone;
	public $newbloodgroup;
	public $status=false;
	public $error=null;

	public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'name' => 'required | max:255',
        	'phone' => 'required | numeric | unique:users,phone',
        	'newbloodgroup' => 'required | integer',
        ]);

        $this->status =true;
    }

    public function mount(){
        $this->name = Auth::user()->name;
        $this->phone = Auth::user()->phone;
        $this->newbloodgroup = Auth::user()->blood_group_id;
    }

	protected $rules = [
        'name' => 'required | max:255',
        'phone' => 'required | numeric | unique:users,phone',
        'newbloodgroup' => 'required | integer',
    ];

	public function submit(){
		$this->validate();
		$user = Auth::user();
		$user->name = $this->name;
		$user->phone = $this->phone;
		$user->blood_group_id = $this->newbloodgroup;
		if ($user->update()) {
			session()->flash('status','Your Profile Information Successfully Updated!!');
            $this->emit('refreshLocation');
		}else{
			session()->flash('wrong','Something went to wrong');

		}
	}

    public function render()
    {
        return view('livewire.update-profile-info');
    }
}
