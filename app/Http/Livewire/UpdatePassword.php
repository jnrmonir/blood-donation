<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Component
{
    public $oldpassword;
    public $password;
    public $password_confirmation;
    public $status = false;
    public $error = null;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'oldpassword' => 'required',
            'password'=>'required|min:08|confirmed',
        ]);

        $this->status =true;
    }

    public function updatedOldpassword()
    {
        if(Hash::check($this->oldpassword, Auth::user()->password)){
            $this->status = true;
            $this->error = null;
        }
        else{
            $this->status = false;
            $this->error = 'old password deos not match';
        }
        // $this->newpassword = $this->oldpassword;

    }
    protected $rules = [
        'password' => 'required|min:8|confirmed',
    ];


    public function submit(){

        $this->validate();

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        if ($user->update()) {
			session()->flash('status','Your Password Successfully Updated!!');
            $this->emit('refreshLocation');
		}else{
			session()->flash('wrong','Something went to wrong');

		}

    }

    public function render()
    {
        return view('livewire.update-password');
    }
}
