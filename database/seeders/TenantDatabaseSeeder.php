<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Messages\Database\Seeders\TenantDatabaseSeeder as MessagesTenantSeeder;

class TenantDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(MessagesTenantSeeder::class);
    }
}
