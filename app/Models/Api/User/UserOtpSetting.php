<?php

namespace App\Models\Api\User;

use App\Models\Api\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserOtpSetting extends Model
{
    protected $table = 'user_otp_settings';

    protected $fillable = ['user_id', 'is_enabled','provider','expired_at','last_verified_at'];


    /**
     * one To One Relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
