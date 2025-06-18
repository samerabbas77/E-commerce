<?php

namespace Database\Seeders\Role;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $webPermissions = [
            //User
            'create_user',
            'update_user',
            'show_user',
            'show_all_user',
            'delete_user',
            'force_delete_user',
            'restore_user',

            //product
            'show_product',
            'show_all_product',
            'create_product',
            'update_product',
            'delete_product',
            'force_delete_product',
            'restore_product',
            'edit_stock',
            'set_eco_score',

            //category
            'show_category',
            'show_all_category',

            'create_category',
            'update_category',
            'delete_category',
            'force_delete_category',
            'restore_category',

            //sub_catrgory
            'show_sub_categoer',
            'show_all_sub_categoer',

            'create_sub_categoer',
            'update_sub_categoer',
            'delete_sub_categoer',
            'force_delete_sub_categoer',
            'restore_sub_categoer',


        ];

        $apiPermissions = [

            //product
            'show_product',
            'show_all_product',


            //category

            'show_category',
            'show_all_category',


            //sub_catrgory

            'show_sub_categoer',
            'show_all_sub_categoer',

            //order

            'create_order',
            'update_order',
            'show_order',
            'show_all_order',
            'delete_order',
            'force_delete_order',
            'restore_order',
            'total_price_order',
            //'edit_status_order',
            'order_number_generate',
            'payment_order',
            'check_postal_code_valid',

            //cart (cart created when user login)
            'add_prodact_to_cart',
            'delete_cart',
            'force_delete_cart',
            'restore_cart',
            'delete_cart_items',
            'force_delete_cart_items',
            'restore_cart_items',

            //coupons
            'create_coupon',
            'update_coupon',
            'show_coupon',
            'show_all_coupon',
            'delete_coupon',
            'force_delete_coupon',
            'edit_coupon',
            'apply_coupon',

            //bundle
            'create_bundle',
            'update_bundle',
            'show_bundle',
            'show_all_bundle',
            'delete_bundle',
            'force_delete_bundle',
            'restore_bundle',
            'status_update_bundle',
            'add_bundle_to_cart',

            //refund
            'create_refund',
            'update_refund',
            'delete_refund',
            'show_refund',
            'show_all__refund',
            'force_delete_refund',
            'restore_refund',
            'review_refund',
            'apply_refund',

            //review
            'create_review',
            'update_review',
            'delete_review',
            'show_review',
            'show_all_review',
            'force_delete_review',
            'restore_review',

            //favorite
            'create_favorite',
            'update_favorite',
            'delete_favorite',
            'show_favorite',
            'show_all_favorite',
            'force_delete_favorite',
            'restore_favorite',

            //photo
            'create_photo',
            'update_photo',
            'delete_photo',
            'show_photo',
            'show_all_photo',
            'force_delete_photo',
            'restore_photo',
        ];

        foreach ($webPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        foreach ($apiPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'api']);
        }


        $roles = [
            'Admin' => 'web',
            'Seller' => 'api',
            'Customer' => 'api',
        ];

        foreach ($roles as $roleName => $guard) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => $guard]);

            switch ($roleName) {
                case 'Admin':
                    $role->syncPermissions(Permission::where('guard_name', 'web')->pluck('name')->toArray());
                    break;


                case 'Seller':
                    $role->syncPermissions(
                        [
                            //product

                            'show_product',
                            'show_all_product',


                            //order
                            'show_order',
                            'show_all_order',
                            'total_price_order',
                            //'edit_status_order',
                            'order_number_generate',
                            'payment_order',
                            'check_postal_code_valid',

                            //refund
                            'show_all__refund',

                            // Review
                            'show_review',
                            'show_all_review',

                            // Bundle
                            'create_bundle',
                            'update_bundle',
                            'show_bundle',
                            'show_all_bundle',
                            'status_update_bundle',
                        ]
                    );
                    break;

                case 'Customer':
                    $role->syncPermissions([
                        // User (limited to their own account)
                        // 'create_user',
                        // 'show_user',
                        // 'update_user',

                        // Product
                        'show_product',
                        'show_all_product',

                        // Order
                        'create_order',
                        'show_order',
                        //'total_price_order',
                        //'payment_order',
                        'check_postal_code_valid',

                        // Category
                        'show_category',
                        'show_all_category',

                        // Subcategory
                        'show_sub_categoer',
                        'show_all_sub_categoer',

                        // Cart
                        'add_prodact_to_cart',
                        'delete_cart_items',

                        // Coupons
                        'show_coupon',
                        'show_all_coupon',
                        //'apply_coupon',

                        // Review
                        'create_review',
                        'update_review',
                        'delete_review',
                        'show_review',
                        'show_all_review',

                        // Favorite
                        'create_favorite',
                        'update_favorite',
                        'delete_favorite',
                        'show_favorite',

                        // Bundle
                        'add_bundle_to_cart',

                    ]);
                    break;
            }
        }

        $this->command->info('Permissions and roles seeded successfully!');
    }
}
