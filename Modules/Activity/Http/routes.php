<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'activity', 'namespace' => 'Modules\Activity\Http\Controllers'], function () {
        Route::get('/', 'ActivityController@index')->name('activity.index')->middleware('auth');
        Route::post('/pusher', 'ActivityController@pusherAuth')->name('pusher.auth');
    }
);
