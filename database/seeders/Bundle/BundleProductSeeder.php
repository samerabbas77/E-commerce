<?php

namespace Database\Seeders\Bundle;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BundleProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bundleProducts = [
            [
                'bundle_id' => 1,
                'product_id' => 1, 
                'quantity' => 3    
            ],
            [
                'bundle_id' => 1,
                'product_id' => 2,
                'quantity' => 2
            ],
            [
                'bundle_id' => 2,
                'product_id' => 3,
                'quantity' => 1
            ],
            [
                'bundle_id' => 2,
                'product_id' => 4,
                'quantity' => 5
            ],
            [
                'bundle_id' => 3,
                'product_id' => 5,
                'quantity' => 2
            ],
            // أضف المزيد من السجلات كما تشاء
        ];

        // إدخال البيانات في جدول bundle_product
        foreach ($bundleProducts as $bundleProduct) {
            DB::table('bundle_product')->insert($bundleProduct);
        } 
    }
}
