<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Tasks\Http\Controllers\Api\v1'],
    function () {
        Route::get('tasks', 'TasksApiController@index')->name('tasks.api.index')->middleware('can:menu_tasks');
        Route::get('tasks/{id}', 'TasksApiController@show')->name('tasks.api.show')->middleware('can:menu_tasks');
        Route::post('tasks', 'TasksApiController@save')->name('tasks.api.save');
        Route::post('/tasks/{id}/status', 'TasksApiController@status')->name('tasks.api.status')->middleware('can:tasks_update');
        Route::post('/tasks/{id}/copy', 'TasksApiController@copy')->name('tasks.api.copy')->middleware('can:tasks_update');
        Route::post('/tasks/{id}/milestone', 'TasksApiController@changeMilestone')->name('tasks.api.change.milestone')->middleware('can:tasks_update');
        Route::post('/tasks/{id}/progress', 'TasksApiController@progress')->name('tasks.api.progress')->middleware('can:tasks_update');
        Route::post('/tasks/close', 'TasksApiController@bulkClose')->name('tasks.api.bulk.close')->middleware('can:tasks_update');
        Route::post('/tasks/delete', 'TasksApiController@bulkDelete')->name('tasks.api.bulk.delete')->middleware('can:tasks_delete');
        Route::put('tasks/{id}', 'TasksApiController@update')->name('tasks.api.update');
        Route::delete('tasks/{id}', 'TasksApiController@delete')->name('tasks.api.delete');
    }
);
