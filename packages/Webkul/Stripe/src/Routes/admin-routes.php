<?php

namespace Webkul\Stripe\Routes\admin;

use Illuminate\Support\Facades\Route;
use Webkul\Stripe\Http\Controllers\StripePagesController;
use Webkul\Stripe\Http\Controllers\StripePaymentController;

/**
 * Stripe Payment routes.
 */
Route::group(['middleware' => ['web', 'admin_locale', 'stripe'], 'prefix' => 'stripe'], function () {
    Route::controller(StripePaymentController::class)->group(function () {
        Route::get('payment', 'createPaymentSession')->name('stripe.payment');

        Route::get('success', 'paymentSuccess')->name('payment.success');

        Route::get('cancel', 'paymentCancel')->name('payment.cancel');
    });

    Route::controller(StripePagesController::class)->prefix('view')->group(function () {
        Route::get('success', 'paymentSuccess')->name('payment.success.view');

        Route::get('cancel', 'paymentCancel')->name('payment.cancel.view');

        Route::get('send-quote-invoice', 'sendQuoteInvoice')->name('payment.send.invoice');
    });
});