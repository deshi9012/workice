<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Todos\Http\Controllers\Api\v1'], function () {
        Route::get('todos', 'TodoApiController@index')->name('todos.api.index');
        Route::get('todos/{id}', 'TodoApiController@show')->name('todos.api.show');
        Route::post('todos/subtask', 'TodoApiController@subTask')->name('todos.api.subtask');
        Route::post('todos/done', 'TodoApiController@allDone')->name('todos.api.done');
        Route::post('todos/{id}/status', 'TodoApiController@status')->name('todos.api.status');
        Route::put('todos/{id}', 'TodoApiController@update')->name('todos.api.update');
        Route::delete('todos/{id}', 'TodoApiController@delete')->name('todos.api.delete');
        Route::post('todos', 'TodoApiController@save')->name('todos.api.save');
    }
);
