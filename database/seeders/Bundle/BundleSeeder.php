<?php

namespace Database\Seeders\Bundle;

use Carbon\Carbon;
use App\Models\Api\Bundle\Bundle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BundleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {  
        $bundles = [
            [
                'title' => 'Winter Bundle',
                'description' => 'A bundle of winter essentials including coats, gloves, and hats.',
                'price' => 100,
                'discount_amount' => 10,
                'total_price' => 90,
                'status' => 'active',
                'start_date' => Carbon::create(2025, 1, 1),
                'end_date' => Carbon::create(2025, 3, 1),
                'usage_limit' => 100,
            ],
            [
                'title' => 'Summer Bundle',
                'description' => 'A bundle for summer with shorts, t-shirts, and sunglasses.',
                'price' => 80,
                'discount_amount' => 5,
                'total_price' => 75,
                'status' => 'active',
                'start_date' => Carbon::create(2025, 6, 1),
                'end_date' => Carbon::create(2025, 8, 31),
                'usage_limit' => 200,
            ],
            [
                'title' => 'Holiday Bundle',
                'description' => 'A special holiday bundle with festive decorations and gifts.',
                'price' => 150,
                'discount_amount' => 30,
                'total_price' => 120,
                'status' => 'inactive',
                'start_date' => Carbon::create(2025, 11, 1),
                'end_date' => Carbon::create(2025, 12, 31),
                'usage_limit' => 50,
            ],
            [
                'title' => 'Tech Bundle',
                'description' => 'A tech bundle with gadgets, headphones, and accessories.',
                'price' => 250,
                'discount_amount' => 50,
                'total_price' => 200,
                'status' => 'active',
                'start_date' => Carbon::create(2025, 2, 1),
                'end_date' => Carbon::create(2025, 4, 30),
                'usage_limit' => 150,
            ],
            [
                'title' => 'Fitness Bundle',
                'description' => 'A fitness bundle with workout equipment and gear.',
                'price' => 120,
                'discount_amount' => 20,
                'total_price' => 100,
                'status' => 'active',
                'start_date' => Carbon::create(2025, 1, 1),
                'end_date' => Carbon::create(2025, 6, 30),
                'usage_limit' => 80,
            ],
            [
                'title' => 'Gourmet Bundle',
                'description' => 'A gourmet food bundle with snacks, chocolates, and coffee.',
                'price' => 60,
                'discount_amount' => 5,
                'total_price' => 55,
                'status' => 'inactive',
                'start_date' => Carbon::create(2025, 3, 1),
                'end_date' => Carbon::create(2025, 5, 31),
                'usage_limit' => 120,
            ],
            [
                'title' => 'Back to School Bundle',
                'description' => 'A back to school bundle with stationery, books, and accessories.',
                'price' => 50,
                'discount_amount' => 5,
                'total_price' => 45,
                'status' => 'active',
                'start_date' => Carbon::create(2025, 8, 1),
                'end_date' => Carbon::create(2025, 9, 30),
                'usage_limit' => 300,
            ],
            [
                'title' => 'Eco-Friendly Bundle',
                'description' => 'A bundle with eco-friendly products like reusable bags, bottles, and utensils.',
                'price' => 80,
                'discount_amount' => 10,
                'total_price' => 70,
                'status' => 'inactive',
                'start_date' => Carbon::create(2025, 4, 1),
                'end_date' => Carbon::create(2025, 6, 30),
                'usage_limit' => 50,
            ],
            [
                'title' => 'Luxury Bundle',
                'description' => 'A luxury bundle with high-end products and accessories.',
                'price' => 500,
                'discount_amount' => 100,
                'total_price' => 400,
                'status' => 'active',
                'start_date' => Carbon::create(2025, 1, 1),
                'end_date' => Carbon::create(2025, 2, 28),
                'usage_limit' => 30,
            ],
            [
                'title' => 'Spring Bundle',
                'description' => 'A spring bundle with outdoor gear, gardening tools, and seeds.',
                'price' => 70,
                'discount_amount' => 10,
                'total_price' => 60,
                'status' => 'active',
                'start_date' => Carbon::create(2025, 3, 1),
                'end_date' => Carbon::create(2025, 5, 31),
                'usage_limit' => 150,
            ],
        ];

        foreach ($bundles as $bundle) {
            Bundle::create($bundle);
        }    }
}
