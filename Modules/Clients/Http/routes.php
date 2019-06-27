<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'clients', 'namespace' => 'Modules\Clients\Http\Controllers'], function () {
        Route::get('/', 'ClientCustomController@index')->name('clients.index')->middleware('can:menu_clients');
        Route::get('create', 'ClientCustomController@create')->name('clients.create')->middleware('can:clients_create');
        Route::get('edit/{client}', 'ClientCustomController@edit')->name('clients.edit')->middleware('can:clients_update');
        Route::get('delete/{client}', 'ClientCustomController@delete')->name('clients.delete')->middleware('can:clients_delete');
        Route::post('bulk-delete', 'ClientCustomController@bulkDelete')->name('clients.bulk.delete')->middleware('can:clients_delete');
        Route::delete('destroy/{client}', 'ClientCustomController@destroy')->name('clients.destroy')->middleware('can:clients_delete');

        Route::get('view/{client}/{tab?}', 'ClientCustomController@view')->name('clients.view')->middleware('can:menu_clients');
        Route::get('data', 'ClientCustomController@tableData')->name('clients.data')->middleware('can:menu_clients');
        Route::get('import', 'ClientCustomController@import')->name('clients.import')->middleware('can:clients_create');
        Route::post('csvmap', 'ClientCustomController@parseImport')->name('clients.csvmap')->middleware('can:clients_create');
        Route::post('csvprocess', 'ClientCustomController@processImport')->name('clients.csvprocess')->middleware('can:clients_create');

        Route::get('export', 'ClientCustomController@export')->name('clients.export')->middleware('can:clients_create');
        Route::get('email/{client}', 'ClientCustomController@email')->name('clients.email');
        Route::post('send', 'ClientCustomController@send')->name('clients.send');
    }
);
