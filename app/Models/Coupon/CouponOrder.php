<?php

namespace App\Models\Coupon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponOrder extends Model
{
    use HasFactory;
    protected $table = 'coupons_order';
}
