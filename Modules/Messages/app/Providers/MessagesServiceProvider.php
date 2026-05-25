<?php

namespace Modules\Messages\Providers;

use Illuminate\Support\ServiceProvider;

class MessagesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(module_path('Messages', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Messages', 'resources/views'), 'messages');
    }
}
