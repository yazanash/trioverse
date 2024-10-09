<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $supervisorRole = Role::create(['name' => 'supervisor']);
        $salesRole = Role::create(['name' => 'sales']);
        $salesRole = Role::create(['name' => 'user']);
        // Create permissions
        $permissions = [
            'view dashboard',
            'manage gyms',
            'manage users',
            'manage plans',
            'create licenses',
            'update licenses',
            'stop licenses',
            // Add more permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $supervisorRole->givePermissionTo([
            'manage gyms',
            'create licenses',
            'update licenses',
            'stop licenses']);
        $salesRole->givePermissionTo('create licenses');
    }
}
