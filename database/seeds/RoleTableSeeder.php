<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions

        // create roles and assign created permissions

        $role = Role::create(['name' => 'Administrador']);
        // $role->givePermissionTo('edit articles');

        $role = Role::create(['name' => 'Usuario']);
        //
        // $role = Role::create(['name' => 'super-admin']);
        // $role->givePermissionTo(Permission::all());
    }
}
