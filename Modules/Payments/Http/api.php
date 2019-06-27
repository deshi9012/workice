<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Payments\Http\Controllers\Api\v1'], function () {
        Route::get('payments', 'PaymentsApiController@index')->name('payments.api.index')->middleware('can:menu_payments');
        Route::post('payments', 'PaymentsApiController@pay')->name('payments.api.pay')->middleware('can:invoices_pay');
        Route::get('payments/{id}', 'PaymentsApiController@show')->name('payments.api.show')->middleware('can:menu_payments');
        Route::post('payments/{id}/refund', 'PaymentsApiController@refund')->name('payments.api.refund')->middleware('can:payments_update');
        Route::get('payments/{id}/comments', 'PaymentsApiController@comments')->name('payments.api.comments')->middleware('can:menu_payments');
        Route::put('payments/{id}', 'PaymentsApiController@update')->name('payments.api.update')->middleware('can:payments_update');
        Route::delete('payments/{id}', 'PaymentsApiController@delete')->name('payments.api.delete')->middleware('can:payments_delete');
    }
);
