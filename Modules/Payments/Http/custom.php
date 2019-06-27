<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'payments', 'namespace' => 'Modules\Payments\Http\Controllers'],
    function () {
        // Route::post('custom/checkout', 'ExampleGatewayController@checkout')->name('payments.custom.checkout');
    }
);
