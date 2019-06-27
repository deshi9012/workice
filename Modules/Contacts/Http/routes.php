<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'contacts', 'namespace' => 'Modules\Contacts\Http\Controllers'],
    function () {
        Route::get('/', 'ContactCustomController@index')->name('contacts.index')->middleware('can:contacts_view');
        Route::get('edit/{user}', 'ContactCustomController@edit')->name('contacts.edit')->middleware('can:contacts_update');
        Route::get('create/{client?}', 'ContactCustomController@create')->name('contacts.create')->middleware('can:contacts_create');
        Route::get('data', 'ContactCustomController@tableData')->name('contacts.data')->middleware('can:contacts_view');
        Route::get('view/{user}', 'ContactCustomController@view')->name('contacts.view')->middleware('can:contacts_view');
        Route::get('email/{contact}', 'ContactCustomController@email')->name('contacts.email');
        Route::post('send', 'ContactCustomController@send')->name('contacts.send');
        Route::get('export', 'ContactCustomController@export')->name('contacts.export')->middleware('can:contacts_view');
        Route::get('primary/{client}/{user}', 'ContactCustomController@makePrimary')->name('contacts.primary')->middleware('can:contacts_update');

        Route::get('import', 'ContactCustomController@import')->name('contacts.import')->middleware('can:contacts_create');
        Route::get('import/callback', 'ContactCustomController@importGoogleContacts')->name('contacts.import.callback')->middleware('can:contacts_create');
        Route::post('csvmap', 'ContactCustomController@parseImport')->name('contacts.csvmap')->middleware('can:contacts_create');
        Route::post('csvprocess', 'ContactCustomController@processImport')->name('contacts.csvprocess')->middleware('can:contacts_create');
        Route::post('search', 'ContactCustomController@search')->name('contacts.search');
        Route::get('delete', 'ContactCustomController@delete')->name('contacts.delete')->middleware('can:contacts_delete');
        Route::delete('destroy', 'ContactCustomController@destroy')->name('contacts.destroy')->middleware('can:contacts_delete');
    }
);
