<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'invoices', 'namespace' => 'Modules\Invoices\Http\Controllers'],
    function () {
        Route::get('/', 'InvoiceCustomController@index')->name('invoices.index')->middleware('can:menu_invoices');
        Route::get('data', 'InvoiceCustomController@tableData')->name('invoices.data')->middleware('can:menu_invoices');
        Route::get('view/{invoice}', 'InvoiceCustomController@view')->name('invoices.view')->middleware('can:view,invoice');
        Route::get('hide/{invoice}', 'InvoiceCustomController@hide')->name('invoices.hide')->middleware('can:invoices_update');
        Route::get('show/{invoice}', 'InvoiceCustomController@show')->name('invoices.show')->middleware('can:invoices_update');

        Route::get('tax_rates', 'RatesController@index')->name('rates.index')->middleware('can:menu_tax_rates');
        Route::get('tax_rates/create', 'RatesController@create')->name('rates.create')->middleware('can:taxes_create');
        Route::post('tax_rates/save', 'RatesController@save')->name('rates.save')->middleware('can:taxes_create');
        Route::get('tax_rates/edit/{rate}', 'RatesController@edit')->name('rates.edit')->middleware('can:taxes_update');
        Route::post('tax_rates/update', 'RatesController@update')->name('rates.update')->middleware('can:taxes_update');
        Route::get('tax_rates/delete/{rate}', 'RatesController@delete')->name('rates.delete')->middleware('can:taxes_delete');
        Route::delete('tax_rates/{rate}', 'RatesController@destroy')->name('rates.destroy')->middleware('can:taxes_delete');

        Route::get('pay/{invoice}', 'InvoiceCustomController@pay')->name('invoices.pay')->middleware('can:invoices_pay');
        Route::get('pdf/{invoice}', 'InvoiceCustomController@pdf')->name('invoices.pdf');
        Route::get('send/{invoice}', 'InvoiceCustomController@send')->name('invoices.send')->middleware('can:invoices_send');
        Route::get('mark-sent/{invoice}', 'InvoiceCustomController@markSent')->name('invoices.mark.sent')->middleware('can:invoices_send');
        Route::get('share/{id}', 'InvoiceCustomController@share')->name('invoices.share')->middleware('can:invoices_update');
        Route::get('copy/{invoice}', 'InvoiceCustomController@copy')->name('invoices.copy')->middleware('can:invoices_create');

        Route::get('create/{client?}', 'InvoiceCustomController@create')->name('invoices.create')->middleware('can:invoices_create');

        Route::get('import', 'InvoiceCustomController@import')->name('invoices.import')->middleware('can:invoices_create');
        Route::post('csvmap', 'InvoiceCustomController@parseImport')->name('invoices.csvmap')->middleware('can:invoices_create');
        Route::post('csvprocess', 'InvoiceCustomController@processImport')->name('invoices.csvprocess')->middleware('can:invoices_create');
        Route::get('export', 'InvoiceCustomController@export')->name('invoices.export');

        Route::get('edit/{invoice}', 'InvoiceCustomController@edit')->name('invoices.edit')->middleware('can:invoices_update');
        Route::get('delete/{invoice}', 'InvoiceCustomController@delete')->name('invoices.delete')->middleware('can:invoices_delete');
        Route::get('cancel/{invoice}', 'InvoiceCustomController@cancel')->name('invoices.cancel')->middleware('can:invoices_update');
        Route::get('remind/{invoice}', 'InvoiceCustomController@remind')->name('invoices.remind')->middleware('can:invoices_remind');

        Route::get('transactions/{invoice}', 'InvoiceCustomController@transactions')->name('invoices.transactions');
        Route::get('mark_paid/{invoice}', 'InvoiceCustomController@markPaid')->name('invoices.mark_paid')->middleware('can:invoices_update');
        Route::get('activity/{invoice}', 'InvoiceCustomController@activity')->name('invoices.activity');
        Route::get('child/{invoice}', 'InvoiceCustomController@children')->name('invoices.child');
        Route::get('comments/{invoice}', 'InvoiceCustomController@comments')->name('invoices.comments')->middleware('can:invoices_comment');
        Route::get('stop-recurring/{invoice}', 'InvoiceCustomController@stopRecurring')->name('invoices.stop_recur')->middleware('can:invoices_update');
        Route::post('end-recurring', 'InvoiceCustomController@endRecurring')->name('invoices.end_recur')->middleware('can:invoices_update');

        Route::get('shared/{invoice}', 'GuestCustomController@guest')->name('invoices.guest')->middleware('signed');
        Route::get('shared-pdf/{invoice}', 'GuestCustomController@pdf')->name('invoices.guestpdf')->middleware('signed');

        Route::post('bulk-delete', 'InvoiceCustomController@bulkDelete')->name('invoices.bulk.delete')->middleware('can:invoices_delete');
        Route::post('bulk-send', 'InvoiceCustomController@bulkSend')->name('invoices.bulk.send')->middleware('can:invoices_send');
        Route::post('bulk-pay', 'InvoiceCustomController@bulkPay')->name('invoices.bulk.pay')->middleware('can:invoices_pay');
    }
);
