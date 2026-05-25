<?php

namespace Modules\Subscription\Providers;

use Illuminate\Support\ServiceProvider;

class SubscriptionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(module_path('Subscription', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Subscription', 'resources/views'), 'subscription');
        $this->loadMigrationsFrom(module_path('Subscription', 'database/migrations'));
    }
}
