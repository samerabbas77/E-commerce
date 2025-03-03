<?php

namespace App\Models\Api\Photo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['name','path','mime_type','photoable_id','photoable_type'];


    //.......................................Relation.............................

    public function photoable()
    {
        return $this->morphTo();
    }
}
