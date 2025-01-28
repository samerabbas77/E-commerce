<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * name of the table
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['name'];


   //...................Relation....................
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
