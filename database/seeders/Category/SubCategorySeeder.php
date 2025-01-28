<?php

namespace Database\Seeders\Category;

use App\Models\Category\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        $subCategories = [
            ['sub_category_name' => 'Smartphones'],
            ['sub_category_name' => 'Laptops'],
            ['sub_category_name' => 'Men’s Clothing'],
            ['sub_category_name' => 'Women’s Clothing'],
            ['sub_category_name' => 'Kitchen Appliances'],
            ['sub_category_name' => 'Furniture'],
            ['sub_category_name' => 'Fiction Books'],
            ['sub_category_name' => 'Educational Books'],
            ['sub_category_name' => 'Skincare'],
            ['sub_category_name' => 'Makeup'],
        ];

        foreach ($subCategories as $subCategorie) {
            SubCategory::create($subCategorie);
        }
    }
}
