<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'projects', 'namespace' => 'Modules\Projects\Http\Controllers'],
    function () {
        Route::get('/', 'ProjectCustomController@index')->name('projects.index')->middleware('can:menu_projects');

        Route::get('data', 'ProjectCustomController@tableData')->name('projects.data')->middleware('can:menu_projects');
        Route::get('view/{project}/{tab?}/{item?}', 'ProjectCustomController@view')->name('projects.view');
        Route::get('create/{client?}', 'ProjectCustomController@create')->name('projects.create')->middleware('can:projects_create');
        Route::get('edit/{project}', 'ProjectCustomController@edit')->name('projects.edit')->middleware('can:projects_update');
        Route::get('invoice/{project}', 'ProjectCustomController@invoice')->name('projects.invoice')->middleware('can:invoices_create');
        Route::get('auto-progress/{project}', 'ProjectCustomController@autoProgress')->name('projects.autoprogress')->middleware('can:projects_update');
        Route::get('done/{project}', 'ProjectCustomController@done')->name('projects.done')->middleware('can:done,project');
        Route::get('copy/{project}', 'ProjectCustomController@copy')->name('projects.copy')->middleware('can:projects_copy');
        Route::get('from-template/{project}', 'ProjectCustomController@fromTemplate')->name('projects.fromtemplate')->middleware('can:projects_copy');

        Route::get('settings', 'SetupController@settings')->name('projects.default.config')->middleware('can:menu_settings');
        Route::post('settings', 'SetupController@save')->name('projects.default.setup')->middleware('can:menu_settings');
        Route::get('delete/{project}', 'ProjectCustomController@delete')->name('projects.delete')->middleware('can:projects_delete');
        Route::post('bulk-delete', 'ProjectCustomController@bulkDelete')->name('projects.bulk.delete')->middleware('can:projects_delete');
        Route::post('bulk-invoice', 'ProjectCustomController@bulkInvoice')->name('projects.bulk.invoice')->middleware('can:invoices_create');
        Route::view('link/create/{project}', 'projects::modal.links.create')->name('links.create')->middleware('can:links_create');
        Route::post('link/save', 'LinkCustomController@save')->name('links.save')->middleware('can:links_create');
        Route::get('link/edit/{link}', 'LinkCustomController@edit')->name('links.edit')->middleware('can:links_create');
        Route::put('link/update/{link}', 'LinkCustomController@update')->name('links.update')->middleware('can:links_create');
        Route::get('link/delete/{link}', 'LinkCustomController@delete')->name('links.delete')->middleware('can:links_create');
        Route::delete('link/delete/{link}', 'LinkCustomController@destroy')->name('links.destroy')->middleware('can:links_create');
        Route::get('link/pin/{link}', 'LinkCustomController@pin')->name('links.pin');
        Route::get('pdf/{project}', 'ProjectCustomController@pdf')->name('projects.export')->middleware('can:projects_download');
        Route::get('feedback/{token}', 'GuestController@feedback')->name('projects.feedback');
        Route::post('rating/{token}', 'GuestController@rating')->name('projects.rating');
    }
);
