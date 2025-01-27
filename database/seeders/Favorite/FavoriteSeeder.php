<?php

namespace Database\Seeders\Favorite;

use App\Models\Bundle\Bundle;
use App\Models\Favorite\Favorite;
use App\Models\Product\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $favorites = [ 
            [
                'user_id' => 1,
                'favorable_type' => Product::class,
                'favorable_id' => 1
            ],
            [
                'user_id' => 2,
                'favorable_type' => Bundle::class,
                'favorable_id' => 2
            ],
        ];


        foreach ($favorites as $favorite) {
            Favorite::create($favorite);
        }
    }
}
