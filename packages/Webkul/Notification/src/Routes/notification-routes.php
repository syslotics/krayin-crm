<?php

namespace Webkul\Admin\Routes\admin;

use Illuminate\Support\Facades\Route;
use Webkul\Notification\Http\Controllers\NotificationController;

/**
 * Setting routes.
 */
Route::group(['middleware' => ['web', 'admin_locale']], function () {
    Route::prefix('notification')->group(function () {
        Route::controller(NotificationController::class)->group(function () {
            Route::get('', 'index')->name('admin.notification.index');

            Route::get('mark-as-read', 'markAsRead')->name('admin.notification.mark-as-read');

            Route::get('recent', 'getNavNotification')->name('admin.notification.recent');

            Route::post('read', 'readNotification')->name('admin.notification.read');
        });
    });
});