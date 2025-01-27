<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\User\UsersSeeder;
use Database\Seeders\Category\SubCategorySeeder;
use Database\Seeders\Category\MainCategoriesSeeder;
use Database\Seeders\Category\MainCategorySubcategorySeeder;
use Database\Seeders\Photo\PhotoSeeder;

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
         

        ]);
    }
}
