<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'tasks', 'namespace' => 'Modules\Tasks\Http\Controllers'],
    function () {
        Route::get('create/{project}/{milestone?}', 'TaskCustomController@create')->name('tasks.create')->middleware('can:createTask,project');
        Route::post('save-template', 'TaskCustomController@saveTemplate')->name('tasks.savetemplate')->middleware('can:tasks_create');
        Route::get('edit/{task}', 'TaskCustomController@edit')->name('tasks.edit');
        Route::get('insert/{project}', 'TaskCustomController@fromTemplate')->name('tasks.insert')->middleware('can:tasks_create');
        Route::get('all/{project}', 'TaskCustomController@tableData')->name('tasks.all')->middleware('can:menu_projects');
        Route::get('view/{task}', 'TaskCustomController@view')->name('tasks.view');
        Route::get('timesheet/{task}', 'TaskCustomController@timesheet')->name('tasks.timesheet');
        Route::get('clock/{task}/{action}', 'TaskCustomController@clock')->name('tasks.clock');
        Route::get('close/{task}', 'TaskCustomController@close')->name('tasks.close')->middleware('can:update,task');
        Route::get('copy/{task}', 'TaskCustomController@copy')->name('tasks.copy')->middleware('can:tasks_create');
        Route::get('delete/{task}', 'TaskCustomController@delete')->name('tasks.delete')->middleware('can:tasks_delete');
        Route::post('autotasks', 'TaskCustomController@autotasks')->name('tasks.autotasks');
        Route::post('autotask', 'TaskCustomController@autotask')->name('tasks.autotask');
        Route::get('template', 'TaskCustomController@template')->name('tasks.template')->middleware('can:menu_tasks');
        Route::get('edit-template/{task}', 'TaskCustomController@editTemplate')->name('tasks.editTemplate');
        Route::put('update-template/{task}', 'TaskCustomController@updateTemplate')->name('tasks.updateTemplate');
        Route::get('delete-template/{task}', 'TaskCustomController@deleteTemplate')->name('tasks.deleteTemplate');
        Route::delete('destroy-template', 'TaskCustomController@destroyTemplate')->name('tasks.destroyTemplate');
        Route::get('/', 'TaskCustomController@index')->name('tasks.index')->middleware('can:menu_tasks');
        Route::get('ajax/todos/{id}', 'TaskCustomController@ajaxTodos')->name('tasks.ajax.todos');
        Route::get('ajax/timesheets/{id}', 'TaskCustomController@ajaxTimesheets')->name('tasks.ajax.timesheets');
    }
);
