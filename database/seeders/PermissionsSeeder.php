<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'show roles',
            'add roles',
            'edit roles',
            'delete roles',

            'show admins',
            'add admins',
            'edit admins',
            'delete admins',

            'show categories',
            'add category',
            'edit category',
            'delete category',

            'show articles',
            'add article',
            'edit article',
            'delete article',
        ];
        $role = Role::create(['guard_name' => 'admin', 'name' => 'super_admin']);
        foreach ($permissions as $permission) {
            $permission = Permission::create(['guard_name' => 'admin', 'name' => $permission]);
            $role->givePermissionTo($permission);
            $permission->assignRole($role);
        }
    }
}
