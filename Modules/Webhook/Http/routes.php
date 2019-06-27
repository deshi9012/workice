<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'webhook', 'namespace' => 'Modules\Webhook\Http\Controllers'],
    function () {
        Route::post('telegram/incoming/{token}', 'TelegramController@incoming')->name('telegram.incoming');
        Route::post('mailgun', 'MailgunController@inbound')->name('mailgun.inbound')->middleware('mailgun');
        Route::get('tracker/opens/{mail}', 'EmailTrackerController@track')->name('tracker.email');
        Route::post('paypal/ipn', 'PaypalWebhookController@ipn')->name('paypal.ipn');
        Route::post('mollie/ipn', 'MollieWebhookController@ipn')->name('mollie.ipn');
        Route::post('razorpay/capture', 'RazorPayWebhookController@capture')->name('razorpay.capture');
        Route::post('razorpay/ipn', 'RazorPayWebhookController@ipn')->name('razorpay.webhook');
        Route::post('wepay/ipn', 'WepayWebhookController@ipn')->name('wepay.webhook');
        Route::post('pagseguro/ipn', 'PagseguroController@ipn')->name('pagseguro.notification');
        Route::post('sentry/{token}', 'SentryIssueController@incoming')->name('sentry.incoming');
        Route::get('verifier', 'VeriCheckController@index');
        Route::post('whatsapp/callback', 'WhatsAppController@callback')->name('whatsapp.incoming');
        Route::post('whatsapp/status', 'WhatsAppController@status')->name('whatsapp.status');
    }
);
