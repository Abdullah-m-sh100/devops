<?php

namespace Modules\Messages\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TenantDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Admin', 'Manager', 'Employee'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@tenant.test'],
            ['name' => 'Tenant Admin', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        $admin->syncRoles(['Admin']);
    }
}
