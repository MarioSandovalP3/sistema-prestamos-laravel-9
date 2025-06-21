<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            "name" => "Home_Index",
            "guard_name" => "web"
        ]);

        DB::table('permissions')->insert([
            "name" => "Company_Index",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Company_Buscar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Company_Crear",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Company_Editar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Company_Eliminar",
            "guard_name" => "web"
        ]);

        DB::table('permissions')->insert([
            "name" => "Usuario_Index",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Usuario_Buscar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Usuario_Crear",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Usuario_Editar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Usuario_Eliminar",
            "guard_name" => "web"
        ]);
        
        DB::table('permissions')->insert([
            "name" => "Role_Index",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Role_Buscar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Role_Crear",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Role_Editar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Role_Eliminar",
            "guard_name" => "web"
        ]);


        DB::table('permissions')->insert([
            "name" => "Permiso_Index",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Permiso_Buscar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Permiso_Crear",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Permiso_Editar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Permiso_Eliminar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "Asignar_Index",
            "guard_name" => "web"
        ]);
       
       
        DB::table('permissions')->insert([
            "name" => "ClienteProveedor_Index",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "ClienteProveedor_Buscar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "ClienteProveedor_Crear",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "ClienteProveedor_Editar",
            "guard_name" => "web"
        ]);
        DB::table('permissions')->insert([
            "name" => "ClienteProveedor_Eliminar",
            "guard_name" => "web"
        ]);
       
    }
}
