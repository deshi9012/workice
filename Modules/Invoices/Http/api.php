<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Invoices\Http\Controllers\Api\v1'],
    function () {
        Route::get('invoices', 'InvoicesApiController@index')->name('invoices.api.index')->middleware('can:menu_invoices');
        Route::get('invoices/{id}/items', 'InvoicesApiController@items')->name('invoices.api.items')->middleware('can:menu_invoices');
        Route::post('invoices/{id}/cancel', 'InvoicesApiController@cancel')->name('invoices.api.cancel')->middleware('can:invoices_update');
        Route::get('invoices/{id}/payments', 'InvoicesApiController@payments')->name('invoices.api.payments')->middleware('can:menu_invoices');
        Route::get('invoices/{id}/comments', 'InvoicesApiController@comments')->name('invoices.api.comments')->middleware('can:menu_invoices');
        Route::get('invoices/{id}', 'InvoicesApiController@show')->name('invoices.api.show')->middleware('can:menu_invoices');
        Route::post('invoices', 'InvoicesApiController@save')->name('invoices.api.save')->middleware('can:invoices_create');
        Route::post('invoices/{id}/remind', 'InvoicesApiController@remind')->name('invoices.api.reminder')->middleware('can:invoices_remind');
        Route::post('invoices/{id}/send', 'InvoicesApiController@send')->name('invoices.api.send')->middleware('can:invoices_send');
        Route::post('invoices/{id}/copy', 'InvoicesApiController@copy')->name('invoices.api.copy')->middleware('can:invoices_create');
        Route::put('invoices/{id}', 'InvoicesApiController@update')->name('invoices.api.update')->middleware('can:invoices_update');
        Route::delete('invoices/{id}', 'InvoicesApiController@delete')->name('invoices.api.delete')->middleware('can:invoices_delete');
    }
);
