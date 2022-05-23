<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','numeric','unique:users,phone'],
            'newbloodgroup' => ['required','numeric'],
            'newcountry' => ['required','numeric'],
            'newstate' => ['required','numeric'],
            'newcity' => ['required','numeric'],
            'address' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();



        $user = new User();
        $user->name = $input['full_name'];
        $user->slug = Str::slug($input['full_name'].'-'.Str::random(8));
        $user->role_id = 3;
        $user->blood_group_id = $input['newbloodgroup'];
        $user->email = $input['email'];
        $user->email_verified_at = Carbon::now();
        $user->phone = $input['phone'];
        $user->password = Hash::make($input['password']);
        if($user->save()){
            $userProfile = new UserProfile();
            $userProfile->present_country_id = $input['newcountry'];
            $userProfile->present_state_id = $input['newstate'];
            $userProfile->present_city_id = $input['newcity'];
            $userProfile->present_address = $input['address'];
            $userProfile->permanent_country_id = $input['newcountry'];
            $userProfile->permanent_state_id = $input['newstate'];
            $userProfile->permanent_city_id = $input['newcity'];
            $userProfile->permanent_address = $input['address'];
            if($user->profile()->save($userProfile)){
                return $user;
            }else{
                return false;
            }
            return $user;
        }else{
            return false;
        }

    }
}
