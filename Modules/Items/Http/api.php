<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Items\Http\Controllers\Api\v1'], function () {
        Route::post('items', 'ItemsApiController@save')->name('items.api.save');
        Route::post('items/templates', 'ItemsApiController@saveTemplate')->name('items.api.save.template');
        Route::put('items/{id}', 'ItemsApiController@update')->name('items.api.update');
        Route::delete('items/{id}', 'ItemsApiController@delete')->name('items.api.delete');
    }
);
