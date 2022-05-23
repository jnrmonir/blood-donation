<?php

namespace App\Models;

use App\Models\User;
use App\Models\BloodGroup;
use App\Models\BloodRequestAgreement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloodRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blood_requests';
    protected $fillable = ['from_user_id','to_user_id','blood_group_id','country_id','state_id','city_id','primary_contact_number','optional_contact_number','blood_need_date','blood_need_time','message','note','status','approved','view_count'];

    public function fromUser(){
        return $this->belongsTo(User::class,'from_user_id','id');
    }

    public function toUser(){
        return $this->belongsTo(User::class,'to_user_id','id');
    }

    public function bloodGroup(){
        return $this->belongsTo(BloodGroup::class);
    }

    public function bloodRequestAgreement()
    {
        return $this->hasMany(BloodRequestAgreement::class);
    }

    /**
     * The bloodDonars that belong to the BloodRequest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function bloodDonars()
    {
        return $this->belongsToMany(User::class, 'user_blood_request_to_blood_donar', 'blood_request_id', 'blood_donar_id')->withPivot('message', 'status',)->withTimestamps();
    }



}
