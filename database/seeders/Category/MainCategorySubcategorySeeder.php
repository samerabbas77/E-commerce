<?php

namespace Database\Seeders\Category;

use App\Models\Category\MainCategorySubcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MainCategorySubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $main_sub_categories = [
            [
                'main_category_id' => 1,
                'sub_category_id' => 1
            ],
            [
                'main_category_id' => 1,
                'sub_category_id' => 2
            ],
            [
                'main_category_id' => 2,
                'sub_category_id' => 3
            ],
            [
                'main_category_id' => 2,
                'sub_category_id' => 4
            ],
            [
                'main_category_id' => 3,
                'sub_category_id' => 5
            ],
            [
                'main_category_id' => 3,
                'sub_category_id' => 6
            ],
            [
                'main_category_id' => 4,
                'sub_category_id' => 7
            ],
            [
                'main_category_id' => 4,
                'sub_category_id' => 8
            ],
            [
                'main_category_id' => 5,
                'sub_category_id' => 9
            ],
            [
                'main_category_id' => 5,
                'sub_category_id' => 10
            ],
            
        ];

        foreach ($main_sub_categories as $main_sub_category) {
            MainCategorySubcategory::create($main_sub_category);
        }
    }
}
