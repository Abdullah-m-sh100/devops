<?php

use Illuminate\Support\Facades\Route;
use Modules\Messages\Http\Controllers\MessageController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
    'auth',
    'verified',
    'subscription.active',
])->prefix('messages')->name('messages.')->group(function (): void {
    Route::get('/', [MessageController::class, 'inbox'])->name('inbox');
    Route::get('/sent', [MessageController::class, 'sent'])->name('sent');
    Route::get('/compose', [MessageController::class, 'create'])->name('create');
    Route::post('/', [MessageController::class, 'store'])->name('store');
    Route::get('/{message}', [MessageController::class, 'show'])->name('show');
    Route::delete('/{message}', [MessageController::class, 'destroy'])->name('destroy');
});
