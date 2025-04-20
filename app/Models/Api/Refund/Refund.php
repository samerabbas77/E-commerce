<?php

namespace App\Models\Api\Refund;

use App\Models\Api\Order\Order;
use App\Models\Api\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Refund extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'refunds';

    protected $fillable = ['reason','refund_amount','refund_method','status','refunded_at','notes','refund_type','order_id'];


    //......................Relation................
    public function products()
    {
        return $this->belongsToMany(Product::class,'refund_items','refund_id','product_id')
                    ->withPivot('quantity')
                    ->wherePivotNull('deleted_at')
                    ->withTimestamps();
    }

    //.................

    /**
     * one to one relation( ervery refund belongs to one order)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}








