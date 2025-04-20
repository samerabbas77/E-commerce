<?php

namespace Database\Seeders\Review;

use App\Models\Api\Bundle\Bundle;
use App\Models\Api\Product\Product;
use App\Models\Api\Review\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'rating' => 5,
                'comment' => 'Great product! High quality and excellent service.',
                'user_id' => 4,
                'reviewable_id' => 1,
                'reviewable_type' => Product::class,

            ],
            [
                'rating' => 4,
                'comment' => 'The package was very useful, but some details could be improved.',
                'user_id' => 2,
                'reviewable_id' => 1,
                'reviewable_type' => Bundle::class,

            ],
            [
                'rating' => 3,
                'comment' => 'Great product! ',
                'user_id' => 3,
                'reviewable_id' => 2,
                'reviewable_type' => Product::class,

            ],
            [
                'rating' => 5,
                'comment' => ' The package was very useful, but some details could be improved.',
                'user_id' => 5,
                'reviewable_id' => 2,
                'reviewable_type' => Bundle::class,

            ],
            [
                'rating' => 2,
                'comment' => 'The product was not as I expected, it needs to be improved.',
                'user_id' =>6,
                'reviewable_id' => 3,
                'reviewable_type' => Product::class,

            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
