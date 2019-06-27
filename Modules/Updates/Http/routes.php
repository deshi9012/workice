<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'updates', 'namespace' => 'Modules\Updates\Http\Controllers'],
    function () {
        Route::get('backup', 'UpdatesController@backup')->name('updates.backup')->middleware(['can:menu_settings', 'demo']);
        Route::get('schedule', 'UpdatesController@schedule')->name('updates.schedule')->middleware(['can:menu_settings', 'demo']);
        Route::get('check', 'UpdatesController@check')->name('updates.check')->middleware(['can:menu_settings', 'demo']);
        Route::post('process', 'UpdatesController@scheduleUpdate')->name('updates.process')->middleware(['can:menu_settings', 'demo']);
        Route::get('latest/{filename}', 'UpdatesController@getLatest')->name('updates.latest');
    }
);
