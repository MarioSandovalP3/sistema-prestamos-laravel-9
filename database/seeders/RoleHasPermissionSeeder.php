<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Asigna todos los permisos al rol de administrador (id=1).
     *
     * @return void
     */
    public function run()
    {
        $permissionIds = DB::table('permissions')->pluck('id');
        
        $rolePermissions = $permissionIds->map(function ($permissionId) {
            return [
                'permission_id' => $permissionId,
                'role_id' => 1 // ID del rol admin
            ];
        })->toArray();

        // Insertar en bloques para mejor performance
        foreach (array_chunk($rolePermissions, 100) as $chunk) {
            DB::table('role_has_permissions')->insert($chunk);
        }
    }
}
