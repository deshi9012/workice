<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Estimates\Http\Controllers\Api\v1'], function () {
        Route::get('estimates', 'EstimatesApiController@index')->name('estimates.api.index')->middleware('can:menu_estimates');
        Route::get('estimates/{id}/items', 'EstimatesApiController@items')->name('estimates.api.items')->middleware('can:menu_estimates');
        Route::post('estimates/{id}/invoice', 'EstimatesApiController@invoice')->name('estimates.api.invoice')->middleware('can:invoices_create');
        Route::post('estimates/{id}/copy', 'EstimatesApiController@copy')->name('estimates.api.copy')->middleware('can:estimates_create');
        Route::post('estimates/{id}/send', 'EstimatesApiController@send')->name('estimates.api.send')->middleware('can:estimates_send');
        Route::post('estimates/{id}/project', 'EstimatesApiController@convert')->name('estimates.api.convert')->middleware('can:projects_create');
        Route::post('estimates/{id}/cancel', 'EstimatesApiController@cancel')->name('estimates.api.cancel')->middleware('can:menu_estimates');
        Route::get('estimates/{id}/comments', 'EstimatesApiController@comments')->name('estimates.api.comments')->middleware('can:menu_estimates');
        Route::get('estimates/{id}', 'EstimatesApiController@show')->name('estimates.api.show')->middleware('can:menu_estimates');
        Route::post('estimates', 'EstimatesApiController@save')->name('estimates.api.save')->middleware('can:estimates_create');
        Route::put('estimates/{id}', 'EstimatesApiController@update')->name('estimates.api.update')->middleware('can:estimates_update');
        Route::delete('estimates/{id}', 'EstimatesApiController@delete')->name('estimates.api.delete')->middleware('can:estimates_delete');
    }
);
