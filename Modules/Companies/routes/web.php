<?php

use Illuminate\Support\Facades\Route;
use Modules\Companies\Http\Controllers\CompaniesController;

Route::middleware(['web', 'auth', 'verified', 'super.admin'])->group(function () {
    Route::resource('companies', CompaniesController::class)->names('companies');
});
