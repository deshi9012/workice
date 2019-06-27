<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'contracts', 'namespace' => 'Modules\Contracts\Http\Controllers'],
    function () {
        Route::get('/', 'ContractCustomController@index')->name('contracts.index');
        Route::get('create', 'ContractCustomController@create')->name('contracts.create')->middleware('can:contracts_create');
        Route::get('view/{contract}', 'ContractCustomController@view')->name('contracts.view');
        Route::get('send/{contract}', 'ContractCustomController@send')->name('contracts.send');
        Route::get('remind/{contract}', 'ContractCustomController@remind')->name('contracts.remind');
        Route::get('edit/{contract}', 'ContractCustomController@edit')->name('contracts.edit')->middleware('can:contracts_update');
        Route::get('activity/{contract}', 'ContractCustomController@activity')->name('contracts.activity');
        Route::get('delete/{contract}', 'ContractCustomController@delete')->name('contracts.delete')->middleware('can:contracts_delete');
        Route::get('pdf/{contract}', 'ContractCustomController@pdf')->name('contracts.download');
        Route::get('copy/{contract}', 'ContractCustomController@copy')->name('contracts.copy')->middleware('can:contracts_create');
        Route::get('share/{id}', 'ContractCustomController@share')->name('contracts.share')->middleware('can:contracts_update');
        Route::get('show/{contract}', 'GuestController@show')->name('contracts.guest.show')->middleware('signed');
        Route::get('client-pdf/{contract}', 'GuestController@pdf')->name('contracts.client.pdf')->middleware('signed');
        Route::get('approve/{contract}', 'GuestController@approve')->name('contracts.client.approve')->middleware('signed');
        Route::post('client-sign/{contract}', 'GuestController@sign')->name('contracts.client.sign');
        Route::get('dismiss/{contract}', 'GuestController@dismiss')->name('contracts.client.dismiss')->middleware('signed');
        Route::post('reject/{contract}', 'GuestController@reject')->name('contracts.client.reject');
    }
);
