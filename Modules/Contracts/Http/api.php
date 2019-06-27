<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Contracts\Http\Controllers\Api\v1'],
    function () {
        Route::get('contracts/{id}', 'ContractsApiController@show')->name('contracts.api.show')->middleware('can:menu_contracts');
        Route::put('contracts/{id}', 'ContractsApiController@update')->name('contracts.api.update')->middleware('can:contracts_update');
        Route::get('contracts', 'ContractsApiController@index')->name('contracts.api.index')->middleware('can:menu_contracts');
        Route::post('contracts', 'ContractsApiController@save')->name('contracts.api.save')->middleware('can:contracts_create');
        Route::post('contracts/{id}/remind', 'ContractsApiController@remind')->name('contracts.api.remind')->middleware('can:contracts_update');
        Route::post('contracts/{id}/sign', 'ContractsApiController@sign')->name('contracts.api.sign')->middleware('can:contracts_sign');
        Route::post('contracts/{id}/copy', 'ContractsApiController@copy')->name('contracts.api.copy')->middleware('can:contracts_create');
        Route::delete('contracts/{id}', 'ContractsApiController@delete')->name('contracts.api.delete')->middleware('can:contracts_delete');
    }
);
