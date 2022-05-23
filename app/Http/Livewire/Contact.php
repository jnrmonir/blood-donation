<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact as ContactUs;

class Contact extends Component
{
    public $full_name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public function updated($propertyName){
        $this->validateOnly($propertyName,[
            'full_name' => 'required | min:2 |max:255',
            'email' => 'required | email',
            'phone' => 'nullable | numeric',
            'subject' => 'required | min:2 |max:255',
            'message' => 'required | min:3'
        ]);
    }

    public function send(){
        $this->validate([
            'full_name' => 'required | min:2 |max:255',
            'email' => 'required | email',
            'phone' => 'nullable | numeric',
            'subject' => 'required | min:2 |max:255',
            'message' => 'required | min:3'
        ]);

        $contact = new ContactUs();
        $contact->name = $this->full_name;
        $contact->email = $this->email;
        $contact->phone = $this->phone ?? '';
        $contact->subject = $this->subject;
        $contact->message = $this->message;
        if($contact->save()){
            session()->flash('status','Message Send Successfully.Thank You For Your Message');
            $this->reset();
        }else{
            session()->flash('wrong','Something Went To Wrong');
        }
    }
    public function render()
    {
        return view('livewire.contact');
    }
}
