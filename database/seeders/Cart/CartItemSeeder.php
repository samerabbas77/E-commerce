<?php

namespace Database\Seeders\Cart;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cartItems = [
            [
                'cart_id' => 1, 
                'product_id' => 1, 
                'quantity' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cart_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'cart_id' => 2,
                'product_id' => 3,
                'quantity' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

       foreach ($cartItems as $cartItem){
        CartItem::create($cartItem);
       }
    }
    }

