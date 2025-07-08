<?php

namespace Database\Seeders\Order;

use App\Models\Api\Order\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'total_price' => 150,
                'discount' => 10,
                'final_price' => 140,
                'status' => 'pending',
                'order_number' => 'ORD-1001',
                'payment_status' => 'Pending',
                'payment_method' => 'Credit Card',
                'transaction_id' => 'TXN123456',
                'postal_code' => '12345',
                'zone_id' => 1,
                'user_id' => 2,
            ],
            [
                'total_price' => 250,
                'discount' => 20,
                'final_price' => 230,
                'status' => 'paid',
                'order_number' => 'ORD-1002',
                'payment_status' => 'Completed',
                'payment_method' => 'PayPal',
                'transaction_id' => 'TXN123457',
                'postal_code' => '67890',
                'zone_id' => 2,
                'user_id' => 2,
            ],
            [
                'total_price' => 300,
                'discount' => 30,
                'final_price' => 270,
                'status' => 'shipped',
                'order_number' => 'ORD-1003',
                'payment_status' => 'Completed',
                'payment_method' => 'Cash',
                'transaction_id' => null,
                'postal_code' => '11111',
                'zone_id' => 3,
                'user_id' => 3,
            ],
            [
                'total_price' => 400,
                'discount' => 40,
                'final_price' => 360,
                'status' => 'delivered',
                'order_number' => 'ORD-1004',
                'payment_status' => 'Completed',
                'payment_method' => 'Strip',
                'transaction_id' => 'TXN123458',
                'postal_code' => '22222',
                'zone_id' => 1,
                'user_id' => 4,
            ],
            [
                'total_price' => 120,
                'discount' => 10,
                'final_price' => 110,
                'status' => 'canceled',
                'order_number' => 'ORD-1005',
                'payment_status' => 'Failed',
                'payment_method' => 'PayPal',
                'transaction_id' => 'TXN123459',
                'postal_code' => '33333',
                'zone_id' => 2,
                'user_id' => 5,
            ],
            [
                'total_price' => 220,
                'discount' => 15,
                'final_price' => 205,
                'status' => 'pending',
                'order_number' => 'ORD-1006',
                'payment_status' => 'Pending',
                'payment_method' => 'Credit Card',
                'transaction_id' => 'TXN123460',
                'postal_code' => '44444',
                'zone_id' => 3,
                'user_id' => 6,
            ],
            [
                'total_price' => 500,
                'discount' => 50,
                'final_price' => 450,
                'status' => 'paid',
                'order_number' => 'ORD-1007',
                'payment_status' => 'Completed',
                'payment_method' => 'Cash',
                'transaction_id' => null,
                'postal_code' => '55555',
                'zone_id' => 1,
                'user_id' => 7,
            ],

        
          
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
