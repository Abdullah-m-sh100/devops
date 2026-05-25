<?php

use Illuminate\Support\Facades\Route;
use Modules\Subscription\Http\Controllers\PlanController;
use Modules\Subscription\Http\Controllers\SubscriptionController;

Route::middleware(['web', 'auth', 'verified', 'super.admin'])->group(function (): void {
    Route::resource('plans', PlanController::class);
    Route::resource('subscriptions', SubscriptionController::class)->except(['show']);
});
