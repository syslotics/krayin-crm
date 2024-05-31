<?php

namespace Webkul\LeadPerson\Routes;

use Illuminate\Support\Facades\Route;
use Webkul\LeadPerson\Http\Controllers\LeadPersonController;

/**
 * Stripe Payment routes.
 */
Route::group(['middleware' => ['web', 'admin_locale'], 'prefix' => 'lead-person'], function () {
    Route::controller(LeadPersonController::class)->group(function () {
        Route::get('lead-person', 'index')->name('lead.person.index');
    });
});