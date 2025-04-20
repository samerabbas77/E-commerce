<?php

namespace Database\Seeders\Product;

use App\Models\Api\Product\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Eco-Friendly Laptop',
                'price' => 1500,
                'description' => 'A high-performance laptop with eco-friendly materials.',
                'stack' => 10,
                'eco_score' => 85,
                'maincategory_subcategory_id' => 1,
            ],
            [
                'name' => 'Organic Cotton T-Shirt',
                'price' => 30,
                'description' => 'Soft and breathable t-shirt made from 100% organic cotton.',
                'stack' => 50,
                'eco_score' => 95,
                'maincategory_subcategory_id' => 2,
            ],
            [
                'name' => 'Solar-Powered Watch',
                'price' => 120,
                'description' => 'A stylish watch that runs on solar energy.',
                'stack' => 20,
                'eco_score' => 90,
                'maincategory_subcategory_id' => 3,
            ],
            [
                'name' => 'Reusable Water Bottle',
                'price' => 25,
                'description' => 'Stainless steel bottle to reduce plastic waste.',
                'stack' => 100,
                'eco_score' => 98,
                'maincategory_subcategory_id' => 4,
            ],
            [
                'name' => 'Bamboo Toothbrush',
                'price' => 10,
                'description' => 'An eco-friendly alternative to plastic toothbrushes.',
                'stack' => 200,
                'eco_score' => 97,
                'maincategory_subcategory_id' => 5,
            ],
            [
                'name' => 'Biodegradable Phone Case',
                'price' => 45,
                'description' => 'A phone case made from biodegradable materials.',
                'stack' => 30,
                'eco_score' => 92,
                'maincategory_subcategory_id' => 1,
            ],
            [
                'name' => 'Recycled Paper Notebook',
                'price' => 12,
                'description' => 'Notebook made from 100% recycled paper.',
                'stack' => 75,
                'eco_score' => 99,
                'maincategory_subcategory_id' => 2,
            ],
            [
                'name' => 'Solar Charger',
                'price' => 80,
                'description' => 'Portable solar charger for mobile devices.',
                'stack' => 15,
                'eco_score' => 89,
                'maincategory_subcategory_id' => 3,
            ],
            [
                'name' => 'Eco-Friendly Backpack',
                'price' => 55,
                'description' => 'Backpack made from recycled plastic bottles.',
                'stack' => 40,
                'eco_score' => 94,
                'maincategory_subcategory_id' => 4,
            ],
            [
                'name' => 'Organic Skincare Set',
                'price' => 65,
                'description' => 'A skincare set made from natural and organic ingredients.',
                'stack' => 25,
                'eco_score' => 96,
                'maincategory_subcategory_id' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

    }
}
