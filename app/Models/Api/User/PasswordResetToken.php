<?php

namespace App\Models\Api\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $table = 'password_reset_tokens';

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];

    public $timestamps = false; // We manage timestamps manually

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
