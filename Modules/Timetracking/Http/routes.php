<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'timetracking', 'namespace' => 'Modules\Timetracking\Http\Controllers'],
    function () {
        Route::get('start/{id}/{module}', 'TimerCustomController@start')->name('clock.start')->middleware('can:timer_start');
        Route::get('stop/{id}/{module}', 'TimerCustomController@stop')->name('clock.stop')->middleware('can:timer_start');
        Route::get('create/{module}/{id}', 'TimerCustomController@create')->name('timetracking.create');
        Route::get('view/{entry}', 'TimerCustomController@view')->name('timetracking.view');
        Route::get('bill/{entry}', 'TimerCustomController@bill')->name('timetracking.bill');
        Route::get('unbill/{entry}', 'TimerCustomController@unbill')->name('timetracking.unbill');
        Route::get('edit/{entry}', 'TimerCustomController@edit')->name('timetracking.edit')->middleware('can:timer_update');
        Route::get('delete/{entry}', 'TimerCustomController@delete')->name('timetracking.delete')->middleware('can:timer_delete');

        Route::get('timers', 'TimerCustomController@timers')->name('timetracking.timers')->middleware('can:menu_projects');
        Route::get('all/{project}', 'TimerCustomController@tableData')->name('timetracking.all')->middleware('can:menu_projects');
    }
);
