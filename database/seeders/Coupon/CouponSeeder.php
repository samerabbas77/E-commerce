<?php

namespace Database\Seeders\Coupon;

use App\Models\Api\Coupon\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => strtoupper(Str::random(10)),
                'discount_value' => 20,
                'expiration_date' => Carbon::now()->addDays(30),
                'max_uses' => 100,
                'uses_count' => 0,
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => strtoupper(Str::random(10)),
                'discount_value' => 50,
                'expiration_date' => Carbon::now()->addDays(15),
                'max_uses' => 50,
                'uses_count' => 10,
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => strtoupper(Str::random(10)),
                'discount_value' => 10,
                'expiration_date' => Carbon::now()->subDays(5), 
                'max_uses' => 30,
                'uses_count' => 30,
                'status' => 'expired',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach($coupons as $coupon){
            Coupon::create($coupon);
        }
    }
}
