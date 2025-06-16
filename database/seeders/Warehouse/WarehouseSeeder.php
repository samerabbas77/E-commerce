<?php

namespace Database\Seeders\Warehouse;

use App\Models\Api\Warehouse\Warehouse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

                      $warehouses = [
            [
                'name' => 'Main Warehouse',
                'address' => '123 Main St',
                'city' => 'New York',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Central Warehouse',
                'address' => '456 Central Ave',
                'city' => 'Chicago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'West Coast Warehouse',
                'address' => '789 Ocean Blvd',
                'city' => 'Los Angeles',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // DB::table('warehouses')->insert($warehouses);
        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }   
    }
}
