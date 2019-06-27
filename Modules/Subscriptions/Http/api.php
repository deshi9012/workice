<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Subscriptions\Http\Controllers\Api\v1'], function () {
        Route::post('plans', 'PlansApiController@save')->name('plans.api.save')->middleware('can:subscriptions_create');
        Route::post('plans/{id}/send', 'PlansApiController@send')->name('plans.api.send')->middleware('can:subscriptions_create');
        Route::put('plans/{id}', 'PlansApiController@update')->name('plans.api.update')->middleware('can:subscriptions_create');
        Route::delete('plans/{id}', 'PlansApiController@delete')->name('plans.api.delete')->middleware('can:subscriptions_create');
    }
);
