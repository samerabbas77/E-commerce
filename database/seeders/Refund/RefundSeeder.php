<?php

namespace Database\Seeders\Refund;

use App\Models\Api\Refund\Refund;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $refunds = [
            [
                'reason' => 'Product damaged',
                'refund_amount' => 100,
                'refund_method' => 'Original_Payment_Method',
                'status' => 'approved',
                'refunded_at' => Carbon::now(),
                'notes' => 'Refund approved for a damaged item',
                'refund_type' => 'full',
                'order_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'reason' => 'Customer changed mind',
                'refund_amount' => 50,
                'refund_method' => 'Store_Credit',
                'status' => 'pending',
                'refunded_at' => null,
                'notes' => 'Customer requested refund due to a change of mind',
                'refund_type' => 'partial',
                'order_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'reason' => 'Order delayed',
                'refund_amount' => 200,
                'refund_method' => 'Original_Payment_Method',
                'status' => 'processed',
                'refunded_at' => Carbon::now(),
                'notes' => 'Refund due to delayed delivery',
                'refund_type' => 'full',
                'order_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'reason' => 'Product defective',
                'refund_amount' => 120,
                'refund_method' => 'Original_Payment_Method',
                'status' => 'approved',
                'refunded_at' => Carbon::now(),
                'notes' => 'Refund issued for defective product',
                'refund_type' => 'full',
                'order_id' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'reason' => 'Order was not as described',
                'refund_amount' => 75,
                'refund_method' => 'Store_Credit',
                'status' => 'rejected',
                'refunded_at' => null,
                'notes' => 'Refund rejected, the product was as described',
                'refund_type' => 'partial',
                'order_id' => 5,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($refunds as $refund) {
            Refund::create($refund);
        }
    }
}
