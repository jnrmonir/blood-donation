<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UpdateProfilePhoto extends Component
{

	use WithFileUploads;

    public $photo;
    public $status = true;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'photo' => 'required|image|max:1024',
        ]);

        $this->status = false;
    }

    public function submit()
    {
        $this->validate([
            'photo' => 'required|image|max:1024',
        ]);

        $photo_name = Auth::user()->slug.'.'.$this->photo->getClientOriginalExtension();

        $user = Auth::user();
        $user->profile_photo_path = $photo_name;

        $img = Image::make($this->photo->getRealPath())->encode('png', 90)->resize(128, 128);
        $img->stream(); // <-- Key point
        Storage::disk('local')->put('public/images/avatars' . '/' . $photo_name, $img, 'public');



        if ($user->update()) {
			session()->flash('status','Your Profile Photo Change Successfully Updated!!');
            $this->emit('refreshLocation');
            $this->reset();
            $this->status = true;
		}else{
			session()->flash('wrong','Something went to wrong');

		}
    }

    public function render()
    {
        return view('livewire.update-profile-photo');
    }
}
