<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Projects\Http\Controllers\Api\v1'],
    function () {
        Route::post('projects/{id}/done', 'ProjectsApiController@close')->name('projects.api.close')->middleware('can:projects_update');
        Route::post('projects/{id}/invoice', 'ProjectsApiController@invoice')->name('projects.api.invoice')->middleware('can:invoices_create');
        Route::post('projects/{id}/copy', 'ProjectsApiController@copy')->name('projects.api.copy')->middleware('can:projects_copy');
        Route::post('projects/{id}/fromtemplate', 'ProjectsApiController@fromTemplate')->name('projects.api.fromtemplate')->middleware('can:projects_copy');
        Route::get('projects/{id}/invoices', 'ProjectsApiController@invoices');
        Route::get('projects/{id}/tasks', 'ProjectsApiController@tasks')->middleware('can:project_menu_tasks');
        Route::get('projects/{id}/expenses', 'ProjectsApiController@expenses');

        Route::get('projects', 'ProjectsApiController@index')->name('projects.api.index')->middleware('can:menu_projects');
        Route::get('projects/{id}', 'ProjectsApiController@show')->name('projects.api.show')->middleware('can:menu_projects');
        Route::put('projects/{id}', 'ProjectsApiController@update')->name('projects.api.update')->middleware('can:projects_update');
        Route::post('projects', 'ProjectsApiController@save')->name('projects.api.save')->middleware('can:projects_create');
        Route::delete('projects/{id}', 'ProjectsApiController@delete')->name('projects.api.delete')->middleware('can:projects_delete');
    }
);
