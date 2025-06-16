<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\Cart\CartSeeder;
use Database\Seeders\User\UsersSeeder;
use App\Models\Api\Warehouse\Warehouse;
use Database\Seeders\Order\OrderSeeder;
use Database\Seeders\Photo\PhotoSeeder;
use Database\Seeders\Bundle\BundleSeeder;
use Database\Seeders\Cart\CartItemSeeder;
use Database\Seeders\Coupon\CouponSeeder;
use Database\Seeders\Refund\RefundSeeder;
use Database\Seeders\Review\ReviewSeeder;
use Database\Seeders\Address\AddressSeeder;
use Database\Seeders\Product\ProductSeeder;
use Database\Seeders\Role\PermissionSeeder;
use Spatie\Permission\Contracts\Permission;
use Database\Seeders\Favorite\FavoriteSeeder;
use Database\Seeders\Refund\RefundItemSeeder;
use Database\Seeders\Coupon\CouponOrderSeeder;
use Database\Seeders\Order\OrderProductSeeder;
use App\Models\Api\Warehouse\Warehouse_product;
use Database\Seeders\User\UserOtpSettingSeeder;
use Database\Seeders\Warehouse\WarehouseSeeder;
use Database\Seeders\Bundle\BundleProductSeeder;
use Database\Seeders\Category\SubCategorySeeder;
use Database\Seeders\Category\MainCategoriesSeeder;
use Database\Seeders\Warehouse\WarehouseProductSeeder;
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
         ProductSeeder::class,
         OrderSeeder::class,
         OrderProductSeeder::class,
         BundleSeeder::class,
         BundleProductSeeder::class,
         RefundSeeder::class,
         RefundItemSeeder::class,
         CartSeeder::class,
         CartItemSeeder::class,
         CouponSeeder::class,
         CouponOrderSeeder::class,
         PermissionSeeder::class,
         UserOtpSettingSeeder::class,
         WarehouseSeeder::class,
         WarehouseProductSeeder::class
        ]);
    }
}
