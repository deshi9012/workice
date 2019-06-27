<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'payments', 'namespace' => 'Modules\Payments\Http\Controllers'],
    function () {
        Route::get('/', 'PaymentCustomController@index')->name('payments.index')->middleware('can:menu_payments');
        Route::get('data', 'PaymentCustomController@tableData')->name('payments.data')->middleware('can:menu_payments');
        Route::get('view/{payment}', 'PaymentCustomController@view')->name('payments.view');
        Route::get('edit/{payment}', 'PaymentCustomController@edit')->name('payments.edit')->middleware('can:payments_update');
        Route::get('refund/{payment}', 'PaymentCustomController@refund')->name('payments.refund')->middleware('can:payments_update');
        Route::get('export', 'PaymentCustomController@export')->name('payments.export');
        Route::get('pdf/{payment}', 'PaymentCustomController@pdf')->name('payments.pdf');

        Route::get('pay/{invoice}/{gateway}', 'GatewayCustomController@pay')->name('payments.pay');
        Route::post('checkout', 'GatewayCustomController@checkout')->name('payments.checkout');
        Route::post('stripe/checkout', 'StripeCustomController@checkout')->name('payments.stripe.checkout');
        Route::post('mollie/checkout', 'MollieCustomController@checkout')->name('payments.mollie.checkout');
        Route::post('2checkout/checkout', 'CheckoutCustomController@checkout')->name('payments.2checkout.checkout');
        Route::post('razorpay/checkout', 'RazorpayCustomController@checkout')->name('payments.razorpay.checkout');
        Route::post('braintree/checkout', 'BraintreeCustomController@checkout')->name('payments.braintree.checkout');
        Route::post('wepay/checkout', 'WepayCustomController@checkout')->name('payments.wepay.checkout');
        Route::get('wepay/callback', 'WepayCustomController@callback')->name('payments.wepay.callback');
        Route::any('paytm/checkout', 'PaytmCustomController@order')->name('payments.paytm.checkout');

        Route::get('paypal/cancel', 'PaypalCustomController@cancel')->name('paypal.cancel');
        Route::any('paypal/success', 'PaypalCustomController@success')->name('paypal.success');
        Route::post('paytm/status', 'PaytmCustomController@callback')->name('paytm.status');

        Route::post('pagseguro/form', 'PagseguroCustomController@form')->name('pagseguro.form');
        Route::any('pagseguro/callback', 'PagseguroCustomController@callback')->name('pagseguro.callback');

        Route::post('bulk-delete', 'PaymentCustomController@bulkDelete')->name('payments.bulk.delete')->middleware('can:payments_delete');
        Route::get('delete/{payment}', 'PaymentCustomController@delete')->name('payments.delete')->middleware('can:payments_delete');
    }
);
