<?php

namespace App\Models;

use App\Models\Role;
use App\Models\BloodGroup;
use App\Models\UserProfile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Redis;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Notification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role_id',
        'blood_group_id',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'blood_group_id' => 'integer',
        'role' => 'integer'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_blood_donation',
        'last_seen',
        // your other new column
    ];





    public function bloodRequests(){
        return $this->hasMany(BloodRequest::class,'from_user_id');
    }


    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function bloodRequestAgreement(){
        return $this->hasOne(BloodRequestAgreement::class,'blood_donar_id','id');
    }


    public function profile(){
        return $this->hasOne(UserProfile::class);
    }

    public function user_blooddonate(){
        return $this->belongsToMany(UserBloodDonate::class);
    }


    /**
     * Get all of the notifications for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class,);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * The requestBloods that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requestForBloods()
    {
        return $this->belongsToMany(BloodRequest::class, 'user_blood_request_to_blood_donar', 'blood_donar_id', 'blood_request_id')->withTimestamps();
    }

    /**
     * Get all of the chats for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }


    public function scopeBloodDonar($query)
    {
        return $query->where('role_id', 2);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role_id', 1);
    }


}
