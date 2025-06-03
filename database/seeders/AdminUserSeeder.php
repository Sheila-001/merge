<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Find user by email
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'status' => 'active', // Assuming 'status' is a valid column and value
                'class_year' => null, // Or a default value if applicable
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create a backup admin account
        User::updateOrCreate(
            ['email' => 'superadmin@hauzhayag.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('SuperAdmin@123'),
                'status' => 'active',
                'class_year' => '2024',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Change 'password' to your desired password
                'is_admin' => true, // Assuming you have an is_admin field
                'status' => 'active',
                'class_year' => null,
                'email_verified_at' => now(),
                // Add any other required fields from your users table, e.g., 'class_year', 'phone_number', etc.
            ]
        );
    }
}
