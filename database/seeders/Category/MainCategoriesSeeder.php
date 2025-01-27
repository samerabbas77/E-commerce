<?php

namespace Database\Seeders\Category;

use App\Models\Category\main_categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainCategoriesSeeder extends Seeder
{ 
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainCategories = [
            ['main_category_name' => 'Electronics'],
            ['main_category_name' => 'Fashion'],
            ['main_category_name' => 'Home & Kitchen'],
            ['main_category_name' => 'Books'],
            ['main_category_name' => 'Health & Beauty'],
        ];

        foreach ($mainCategories as $mainCategorie) {
            main_categories::create($mainCategorie);
        }
    }
}
