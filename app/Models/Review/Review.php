<?php

namespace App\Models\Review;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['rating','comment','user_id','reviewable_type','reviewable_id'];


    //...............Relation.............
    /**
     * every review is belongs to one user 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //.....................
    public function reviewable()
    {
        return $this->morphTo();
    }
}
