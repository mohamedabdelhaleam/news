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

            'show employees',
            'add employees',
            'edit employees',
            'delete employees',

            'show services',
            'add services',
            'edit services',
            'delete services',

            'show branches',
            'add branches',
            'edit branches',
            'delete branches',
            
            'show customers',
            'delete customers',
        ];
        $role = Role::create(['guard_name' => 'admin', 'name' => 'super_admin']);
        foreach ($permissions as $permission) {
            $permission = Permission::create(['guard_name' => 'admin', 'name' => $permission]);
            $role->givePermissionTo($permission);
            $permission->assignRole($role);
        }
    }
}
