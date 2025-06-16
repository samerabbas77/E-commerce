<?php

namespace Database\Seeders\Warehouse;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Api\Product\Product;
use App\Models\Api\Warehouse\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WarehouseProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $warehouseProducts = [
            // Warehouse ID 1
            ['warehouse_id' => 1, 'product_id' => 1, 'stack' => 50, 'last_updated' => now()],
            ['warehouse_id' => 1, 'product_id' => 2, 'stack' => 30, 'last_updated' => now()],
            
            // Warehouse ID 2
            ['warehouse_id' => 2, 'product_id' => 1, 'stack' => 20, 'last_updated' => now()],
            ['warehouse_id' => 2, 'product_id' => 3, 'stack' => 100, 'last_updated' => now()],

            // Warehouse ID 3
            ['warehouse_id' => 3, 'product_id' => 2, 'stack' => 15, 'last_updated' => now()],
            ['warehouse_id' => 3, 'product_id' => 3, 'stack' => 80, 'last_updated' => now()],
        ];

        DB::table('warehouse_products')->insert($warehouseProducts);

    
    }
}
