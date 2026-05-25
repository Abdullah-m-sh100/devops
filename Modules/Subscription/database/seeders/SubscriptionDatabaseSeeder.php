<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Subscription\Models\Plan;

class SubscriptionDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Starter', 'slug' => 'starter', 'price' => 29, 'billing_period' => 'monthly', 'max_users' => 10, 'max_messages' => 1000],
            ['name' => 'Business', 'slug' => 'business', 'price' => 79, 'billing_period' => 'monthly', 'max_users' => 50, 'max_messages' => 10000],
            ['name' => 'Enterprise', 'slug' => 'enterprise', 'price' => 199, 'billing_period' => 'monthly', 'max_users' => 250, 'max_messages' => 100000],
        ] as $plan) {
            Plan::updateOrCreate(['slug' => $plan['slug']], $plan + ['is_active' => true]);
        }
    }
}
