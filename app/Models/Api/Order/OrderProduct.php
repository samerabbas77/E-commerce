<?php

namespace App\Models\Api\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_product';

    protected $fillable = ['order_id','product_id','quantity','returned_quantity'];
   



}
