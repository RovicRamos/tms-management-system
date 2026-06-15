<?php

namespace Database\Seeders; // Ensure correct casing

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Call the project's role seeder first so ID 1 and 2 actually exist!
        // Check your database/seeders folder to make sure this class name matches exactly
        $this->call([
            RoleSeeder::class, 
        ]);

        // 2. Now creating a test user will work because its role dependency is satisfied
        User::create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password_hash' => Hash::make('password'),
            'role_id' => 1, 
        ]);
    }
}