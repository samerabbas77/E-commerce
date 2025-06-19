<?php

namespace Database\Seeders\User;

use Carbon\Carbon;
use App\Enums\RoleUser;
use App\Models\Api\User\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define a list of users with their attributes and roles
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
                'role'     => RoleUser::Admin->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... other users omitted for brevity, but same structure ...
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
                'role'     => RoleUser::Customer->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            // Determine which guard to use based on the user's role
            // Admins use the 'web' guard, other roles use 'api'
            $guardName = $userData['role'] === RoleUser::Admin->value ? 'web' : 'api';

            // Create the role if it doesn't already exist for the specified guard
            Role::firstOrCreate([
                'name' => $userData['role'],
                'guard_name' => $guardName,
            ]);

            // Create the user if not exists, or fetch it by email
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'first_name' => $userData['first_name'],
                    'last_name' => $userData['last_name'],
                    'password' => $userData['password'], // Password is already hashed
                    'phone' => $userData['phone'],
                    'address' => $userData['address'],
                    'is_male' => $userData['is_male'],
                    'birthdate' => $userData['birthdate'],
                    'telegram_user_id' => $userData['telegram_user_id'],
                    'role' => $userData['role'],
                    'created_at' => $userData['created_at'],
                    'updated_at' => $userData['updated_at'],
                ]
            );

            // Assign the correct role to the user using the specified guard
            // This prevents "RoleDoesNotExist" error by making sure the correct guard is used
            $user->assignRole(Role::findByName($userData['role'], $guardName));

            // Log the result to the console for confirmation
            $this->command->info("User '{$userData['email']}' created and assigned role '{$userData['role']}' with guard '{$guardName}'.");
        }
    }
}
