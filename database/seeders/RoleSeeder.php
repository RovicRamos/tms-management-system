<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insertOrIgnore([
            ['role_id' => 1, 'role_name' => 'Admin'],
            ['role_id' => 2, 'role_name' => 'Client'],
        ]);
    }
}