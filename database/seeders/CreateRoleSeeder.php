<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ROLE_BRAND = 1
        Role::create([
            'name' => 'Brand',
            'description' => ''
        ]);

        // ROLE_INFLUENCER = 2
        Role::create([
            'name' => 'Influencer',
            'description' => ''
        ]);

        // ROLE_ADMIN = 3
        Role::create([
            'name' => 'Admin',
            'description' => ''
        ]);
    }
}