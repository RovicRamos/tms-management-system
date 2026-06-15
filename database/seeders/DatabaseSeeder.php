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
        $this->call([
            RoleSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'Admin',
                'password_hash' => Hash::make('password'),
                'role_id' => 1,
            ]
        );

        User::updateOrCreate(
            ['email' => 'client@example.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'Client',
                'password_hash' => Hash::make('password'),
                'role_id' => 2,
            ]
        );
    }
}