<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'todos', 'namespace' => 'Modules\Todos\Http\Controllers'], function () {
        Route::get('/create/{module}/{id}/{parent?}', 'TodoCustomController@create')->name('todo.create');
        Route::get('/subtask/{parent}', 'TodoCustomController@subtask')->name('todo.subtask');
        Route::post('/save-subtask', 'TodoCustomController@saveSubtask')->name('todo.save.subtask');
        Route::get('/edit/{todo}', 'TodoCustomController@edit')->name('todo.edit');

        Route::post('reorder', 'TodoCustomController@reOrder')->name('todo.reorder');
    }
);
