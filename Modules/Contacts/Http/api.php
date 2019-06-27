<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Contacts\Http\Controllers\Api\v1'], function () {
        Route::get('contacts', 'ContactApiController@index')->name('contacts.api.index')->middleware('can:contacts_view');
        Route::post('contacts', 'ContactApiController@save')->name('contacts.api.save');
        Route::get('contacts/{id}', 'ContactApiController@show')->name('contacts.api.show')->middleware('can:contacts_view');
        Route::put('contacts/{id}', 'ContactApiController@update')->name('contacts.api.update')->middleware('can:contacts_update');
        Route::delete('contacts/{id}', 'ContactApiController@delete')->name('contacts.api.delete')->middleware('can:contacts_delete');
    }
);
