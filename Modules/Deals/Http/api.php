<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Deals\Http\Controllers\Api\v1'],
    function () {
        Route::get('deals/{id}/calls', 'DealsApiController@calls')->name('deals.api.calls')->middleware('can:menu_deals');
        Route::get('deals/{id}/todos', 'DealsApiController@todos')->name('deals.api.todos')->middleware('can:menu_deals');
        Route::get('deals/{id}/comments', 'DealsApiController@comments')->name('deals.api.comments')->middleware('can:menu_deals');
        Route::get('deals/{id}/products', 'DealsApiController@products')->name('deals.api.products')->middleware('can:menu_deals');
        Route::post('deals/{id}/close', 'DealsApiController@close')->name('deals.api.close')->middleware('can:deals_update');
        Route::post('deals/{id}/won', 'DealsApiController@won')->name('deals.api.won')->middleware('can:deals_update');
        Route::get('deals', 'DealsApiController@index')->name('deals.api.index')->middleware('can:menu_deals');
        Route::get('deals/{id}', 'DealsApiController@show')->name('deals.api.show')->middleware('can:menu_deals');
        Route::post('deals', 'DealsApiController@save')->name('deals.api.save')->middleware('can:deals_create');
        Route::put('deals/{id}', 'DealsApiController@update')->name('deals.api.update')->middleware('can:deals_update');
        Route::delete('deals/{id}', 'DealsApiController@delete')->name('deals.api.delete')->middleware('can:deals_delete');
    }
);
