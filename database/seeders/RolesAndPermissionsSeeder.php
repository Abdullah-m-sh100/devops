<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Message permissions
            'send messages',
            'receive messages',
            'read messages',
            'delete messages',
            'archive messages',
            'star messages',

            // Group permissions
            'create groups',
            'manage groups',

            // User management
            'manage users',
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Reports
            'view reports',
            'export reports',

            // Settings
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles and assign permissions

        // Super Admin Role (for central users)
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign super_admin role to central super admin user
        $superAdmin = User::where('email', 'superadmin@example.com')->first();
        if ($superAdmin) {
            $superAdmin->assignRole('super_admin');
        }

        // Tenant Roles
        // Admin Role (full access within tenant)
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());

        // Manager Role
        $managerRole = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $managerRole->givePermissionTo([
            'send messages',
            'receive messages',
            'read messages',
            'delete messages',
            'star messages',
            'create groups',
            'manage groups',
            'view users',
            'view reports',
        ]);

        // Employee Role
        $employeeRole = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);
        $employeeRole->givePermissionTo([
            'send messages',
            'receive messages',
            'read messages',
            'star messages',
        ]);

        $this->command->info('✅ Roles and permissions seeded successfully!');
        $this->command->info('Roles: super_admin, admin, manager, employee');
        $this->command->info('Permissions: ' . count($permissions) . ' permissions created');
    }
}
