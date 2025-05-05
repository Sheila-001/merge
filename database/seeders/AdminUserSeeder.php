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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'class_year' => '2024',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Create a backup admin account
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@hauzhayag.com',
            'password' => Hash::make('SuperAdmin@123'),
            'role' => 'admin',
            'status' => 'active',
            'class_year' => '2024',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}
