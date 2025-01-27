<?php

namespace Database\Seeders\Order;

use Illuminate\Database\Seeder;
use App\Models\Order\OrderProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderProducts = [
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 2, 'returned_quantity' => 0],
            ['order_id' => 1, 'product_id' => 3, 'quantity' => 1, 'returned_quantity' => 0],
            ['order_id' => 2, 'product_id' => 2, 'quantity' => 4, 'returned_quantity' => 1],
            ['order_id' => 3, 'product_id' => 5, 'quantity' => 1, 'returned_quantity' => 0],
            ['order_id' => 4, 'product_id' => 1, 'quantity' => 3, 'returned_quantity' => 0],
            ['order_id' => 5, 'product_id' => 4, 'quantity' => 2, 'returned_quantity' => 0],
            ['order_id' => 6, 'product_id' => 2, 'quantity' => 5, 'returned_quantity' => 1],
            ['order_id' => 7, 'product_id' => 3, 'quantity' => 1, 'returned_quantity' => 0],
            ['order_id' => 8, 'product_id' => 5, 'quantity' => 2, 'returned_quantity' => 0],
            ['order_id' => 9, 'product_id' => 4, 'quantity' => 4, 'returned_quantity' => 2],
        ];

        foreach ($orderProducts as $orderProduct) {
            OrderProduct::create($orderProduct);
        }
    }
}
