<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class UserProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'user_profiles';
    protected $fillable = ['user_id','contact_number','alt_contact_number','present_country_id','present_state_id','present_city_id','present_address','permanent_country_id','permanent_state_id','permanent_city_id','permanent_address','date_of_birth','gender','status','approved'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Get the country that owns the UserProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function presentCountry()
    {
        return $this->belongsTo(Country::class, 'present_country_id');
    }

     /**
     * Get the country that owns the UserProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permanentCountry()
    {
        return $this->belongsTo(Country::class, 'permanent_country_id');
    }

     /**
     * Get the country that owns the UserProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function presentState()
    {
        return $this->belongsTo(State::class, 'present_state_id');
    }

    public function permanentState()
    {
        return $this->belongsTo(State::class, 'permanent_state_id');
    }

    public function presentCity()
    {
        return $this->belongsTo(City::class, 'present_city_id');
    }

    public function permanentCity()
    {
        return $this->belongsTo(City::class, 'permanent_city_id');
    }
}
