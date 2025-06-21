<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            "name" => "Admin",
            "guard_name" => "web"
        ]);
        DB::table('roles')->insert([
            "name" => "Supervisor",
            "guard_name" => "web"
        ]);
        DB::table('roles')->insert([
            "name" => "Empleado",
            "guard_name" => "web"
        ]);

    }
}
