<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class Login extends Component
{
    public $email;
    public $password;
    public $remember_me = false;
    public $status = false;
    public $pending = false;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'email' => 'required|email',
            'password'=>'required|min:08',
        ]);

        $this->status =true;
    }

    public function login()
    {
        $this->login = true;
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            session()->flash('status', 'Blood Donation Apply successfully.Thank you Very Much');
            $this->emit('refreshDonar');
            $this->emit('refreshRequest');
            $this->reset();
        }else{
            session()->flash('wrong', 'Something Went to Wrong!!');
        }

    }



    public function render()
    {
        return view('livewire.login');
    }
}
