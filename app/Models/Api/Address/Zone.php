<?php

namespace App\Models\Api\Address;

use App\Models\Api\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zone extends Model
{
    use HasFactory;
       /**
     * name of the table
     * @var string
     */
    protected $table = 'zones';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['name','city_id'];


   //...................Relation....................
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function orders()
    {
        $this->hasMany(Order::class);
    }
}
