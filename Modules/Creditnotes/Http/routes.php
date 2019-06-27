<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'creditnotes', 'namespace' => 'Modules\Creditnotes\Http\Controllers'],
    function () {
        Route::get('/', 'CreditCustomController@index')->name('creditnotes.index')->middleware('can:menu_creditnotes');
        Route::get('data', 'CreditCustomController@tableData')->name('creditnotes.data');
        Route::get('create', 'CreditCustomController@create')->name('creditnotes.create')->middleware('can:credits_create');
        Route::get('export', 'CreditCustomController@export')->name('creditnotes.export')->middleware('can:menu_creditnotes');
        Route::get('view/{creditnote}', 'CreditCustomController@view')->name('creditnotes.view')->middleware('can:view,creditnote');
        Route::get('edit/{creditnote}', 'CreditCustomController@edit')->name('creditnotes.edit')->middleware('can:credits_update');
        Route::get('send/{creditnote}', 'CreditCustomController@send')->name('creditnotes.send')->middleware('can:credits_send');
        Route::get('activity/{creditnote}', 'CreditCustomController@activity')->name('creditnotes.activity');
        Route::get('comments/{creditnote}', 'CreditCustomController@comments')->name('creditnotes.comments');
        Route::get('pdf/{creditnote}', 'CreditCustomController@pdf')->name('creditnotes.pdf');
        Route::get('apply/{invoice}', 'CreditCustomController@credits')->name('creditnotes.apply')->middleware('can:invoices_update');
        Route::get('delete/{creditnote}', 'CreditCustomController@delete')->name('creditnotes.delete')->middleware('can:credits_delete');
        Route::get('remove-credit/{credited}', 'CreditCustomController@removeCredit')->name('creditnotes.remove_credit')->middleware('can:credits_update');
        Route::post('bulk-delete', 'CreditCustomController@bulkDelete')->name('creditnotes.bulk.delete')->middleware('can:credits_delete');
        Route::post('bulk-send', 'CreditCustomController@bulkSend')->name('creditnotes.bulk.send')->middleware('can:credits_send');
    }
);
