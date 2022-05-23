<?php

namespace App\Models;

use App\Models\User;
use App\Models\BloodRequest;
use App\Models\BloodRequestAgreement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $fillable = ['user_id','notification_type','notification','status','blood_request_id','blood_request_agreement_id'];

    /**
     * Get the fromUser that owns the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bloodRequest()
    {
        return $this->belongsTo(BloodRequest::class, 'blood_request_id');
    }

    public function bloodRequestAgreement()
    {
        return $this->belongsTo(BloodRequestAgreement::class, 'blood_request_agreement_id');
    }


}
