<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['provider', 'provider_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
