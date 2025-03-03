<?php

namespace Database\Seeders\User;

use Carbon\Carbon;
use App\Models\Api\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $users = [
            [
                'first_name' => 'admin',
                'last_name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '+963994709645',
                'address' => '123 Main St',
                'is_male' => true,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '1234567890',
                'address' => '123 Main St',
                'is_male' => true,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jana',
                'last_name' => 'Smith',
                'email' => 'jana.smith@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '0987654321',
                'address' => '456 Elm St',
                'is_male' => false,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ali',
                'last_name' => 'Doe',
                'email' => 'ali.doe@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '1234567890',
                'address' => '123 Main St',
                'is_male' => true,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Alaa',
                'last_name' => 'Smith',
                'email' => 'alaa.smith@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '0987654321',
                'address' => '456 Elm St',
                'is_male' => true,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'lolo',
                'last_name' => 'Doe',
                'email' => 'lolo.doe@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '1234567890',
                'address' => '123 Main St',
                'is_male' => false,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Rama',
                'last_name' => 'Smith',
                'email' => 'rama.smith@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '0987654321',
                'address' => '456 Elm St',
                'is_male' => false,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'seler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'reem',
                'last_name' => 'Doe',
                'email' => 'reem.doe@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '1234567890',
                'address' => '123 Main St',
                'is_male' => false,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'seler',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'omar',
                'last_name' => 'Smith',
                'email' => 'omar.smith@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '0987654321',
                'address' => '456 Elm St',
                'is_male' => true,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'roro',
                'last_name' => 'Doe',
                'email' => 'roro.doe@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '1234567890',
                'address' => '123 Main St',
                'is_male' => false,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'lara',
                'last_name' => 'Smith',
                'email' => 'lara.smith@example.com',
                'password' => Hash::make('pasSword123#'),
                'phone' => '0987654321',
                'address' => '456 Elm St',
                'is_male' => false,
                'birthdate' => Carbon::create('1990', '05', '20'),
                'telegram_user_id' => '123456789',
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
