<?php

namespace Database\Seeders\Refund;

use App\Models\Refund\RefundItem;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefundItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $refundItems = [
            [
                'refund_id' => 1, 
                'product_id' => 1, 
                'quantity' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'refund_id' => 2,
                'product_id' => 2,
                'quantity' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'refund_id' => 3,
                'product_id' => 3,
                'quantity' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'refund_id' => 4,
                'product_id' => 4,
                'quantity' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'refund_id' => 5,
                'product_id' => 5,
                'quantity' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($refundItems as $item) {
            RefundItem::create($item);        }
    }
}   
