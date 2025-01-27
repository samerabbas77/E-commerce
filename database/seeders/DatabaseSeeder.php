<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\User\UsersSeeder;
use Database\Seeders\Order\OrderSeeder;
use Database\Seeders\Photo\PhotoSeeder;
use Database\Seeders\Review\ReviewSeeder;
use Database\Seeders\Address\AddressSeeder;
use Database\Seeders\Bundle\BundleProductSeeder;
use Database\Seeders\Bundle\BundleSeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\Favorite\FavoriteSeeder;
use Database\Seeders\Order\OrderProductSeeder;
use Database\Seeders\Category\SubCategorySeeder;
use Database\Seeders\Category\MainCategoriesSeeder;
use Database\Seeders\Category\MainCategorySubcategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        //  PhotoSeeder::class,    
         UsersSeeder::class,
         MainCategoriesSeeder::class,
         SubCategorySeeder::class,
         MainCategorySubcategorySeeder::class,
         ProductSeeder::class,
         AddressSeeder::class,
         ReviewSeeder::class,
         FavoriteSeeder::class,
         OrderSeeder::class,
         OrderProductSeeder::class,
         BundleSeeder::class,
         BundleProductSeeder::class,

        ]);
    }
}
