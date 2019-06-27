<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Timetracking\Http\Controllers\Api\v1'],
    function () {
        Route::get('timers/{id}', 'TimerApiController@show')->name('timers.api.show')->middleware('can:menu_projects');
        Route::post('timers', 'TimerApiController@save')->name('timers.api.save');
        Route::put('timers/{id}', 'TimerApiController@update')->name('timers.api.update');
        Route::delete('timers/{id}', 'TimerApiController@delete')->name('timers.api.delete')->middleware('can:timer_delete');
        Route::post('/timers/delete', 'TimerApiController@bulkDelete')->name('timers.api.bulk.delete')->middleware('can:timer_delete');
    }
);
