<?php

namespace App\Models\Api\Coupon;

use App\Models\Api\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory,SoftDeletes;


    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['code','discount_value','expiration_date','max_uses','uses_count','status'];

    //......................Relation........................
    public function orders()
    {
        return $this->belongsToMany(Order::class,'coupons_order','coupon_id','order_id')
                    ->withPivot('discount_amount','applied_at')
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();
    }

}
