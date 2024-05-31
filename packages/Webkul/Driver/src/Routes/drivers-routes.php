<?php

namespace Webkul\Driver\Routes;

use Illuminate\Support\Facades\Route;
use Webkul\Driver\Http\Controllers\DriverController;

/**
 * Stripe Payment routes.
 */
Route::group(['middleware' => ['web', 'admin_locale'], 'prefix' => 'drivers'], function () {
    Route::controller(DriverController::class)->group(function () {
        Route::get('', 'index')->name('drivers.information.index');

        Route::get('create', 'create')->name('drivers.information.create');

        Route::post('create', 'store')->name('drivers.information.store');

        Route::get('edit/{id}', 'edit')->name('drivers.information.edit');

        Route::put('edit/{id}', 'update')->name('drivers.information.update');

        Route::get('lead-driver', 'getDriverOnLead')->name('drivers.lead.edit');

        Route::get('driver/{lead_id}', 'driver')->name('drivers.lead.information.get');

        Route::delete('{id}', 'destroy')->name('drivers.information.delete');

        Route::put('mass-delete', 'massDestroy')->name('drivers.information.mass_delete');

        Route::get('search', 'search')->name('drivers.information.search');
    });
});