<?php

use App\Providers\AppServiceProvider;
use Modules\Companies\Providers\CompaniesServiceProvider;
use Modules\Messages\Providers\MessagesServiceProvider;
use Modules\Subscription\Providers\SubscriptionServiceProvider;

return [
    AppServiceProvider::class,
    CompaniesServiceProvider::class,
    MessagesServiceProvider::class,
    SubscriptionServiceProvider::class,
];
