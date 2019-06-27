<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Extras\Http\Controllers\Api\v1'], function () {
        Route::post('calls', 'CallsApiController@save')->name('calls.api.save');
        Route::put('calls/{id}', 'CallsApiController@update')->name('calls.api.update');
        Route::delete('calls/{id}', 'CallsApiController@delete')->name('calls.api.delete');

        Route::post('clauses', 'ClausesApiController@save')->name('clauses.api.save');
        Route::put('clauses/{id}', 'ClausesApiController@update')->name('clauses.api.update');
        Route::delete('clauses/{id}', 'ClausesApiController@delete')->name('clauses.api.delete');

        Route::post('responses', 'CannedApiController@save')->name('responses.api.save');
        Route::put('responses/{id}', 'CannedApiController@update')->name('responses.api.update');
        Route::delete('responses/{id}', 'CannedApiController@delete')->name('responses.api.delete');

        Route::post('vaults', 'VaultApiController@save')->name('vaults.api.save');
        Route::put('vaults/{id}', 'VaultApiController@update')->name('vaults.api.update');
        Route::delete('vaults/{id}', 'VaultApiController@delete')->name('vaults.api.delete');
    }
);
