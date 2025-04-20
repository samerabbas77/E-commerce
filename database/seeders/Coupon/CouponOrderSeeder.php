<?php

namespace Database\Seeders\Coupon;

use App\Models\Api\Coupon\CouponOrder;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouponOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couponOrders = [
            [
                'order_id' => 1,
                'coupon_id' => 1,
                'discount_amount' => 10,
                'applied_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'order_id' => 2,
                'coupon_id' => 2,
                'discount_amount' => 15,
                'applied_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'order_id' => 3,
                'coupon_id' => 3,
                'discount_amount' => 20,
                'applied_at' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        foreach($couponOrders as $couponOrder){
            CouponOrder::create($couponOrder);
        }
    }
}
