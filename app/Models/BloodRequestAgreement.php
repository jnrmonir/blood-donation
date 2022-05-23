<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BloodRequest;
use App\Models\User;

class BloodRequestAgreement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blood_request_agreements';
    protected $fillable = ['blood_request_id','blood_donar_id','message','approved','status'];

    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class);
    }

    public function bloodDonar(){
    	return $this->belongsTo(User::class,'blood_donar_id');
    }
}
