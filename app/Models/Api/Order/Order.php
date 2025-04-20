<?php

namespace App\Models\Api\Order;

use App\Models\Api\User\User;
use App\Models\Api\Address\Zone;
use App\Models\Api\Coupon\Coupon;
use App\Models\Api\Refund\Refund;
use App\Models\Api\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['total_price','discount','final_price',
                           'status','order_number','payment_status',
                           'payment_method','transaction_id','postal_code',
                           'zone_id','user_id'];

//..................Relation....................

/**
 * mant to many relation (order have many products)
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function products()
{
    return $this->belongsToMany(Product::class,'order_product','order_id','product_id')
                ->withPivot('quantity')
                ->wherePivotNull('deleted_at')
                ->withTimestamps();
}

//.........................................
//.........................................
/**
 * many to many relation (order have many coupons)
 */
public function coupons()
{
    return $this->belongsToMany(Coupon::class,'coupons_order','order_id','coupon_id')
                ->withPivot('discount_amount','applied_at')
                ->wherePivotNull('deleted_at')
                ->withTimestamps();
}

//.........................................
//.........................................
/**
 * one to one (order have one refund)
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function refund()
{
    return $this->hasOne(Refund::class);
}
//.........................................
//.........................................

public function user()
{
    return $this->belongsTo(User::class);
}

//.........................................
//.........................................

public function zone()
{
    return $this->belongsTo(Zone::class);
}

}





