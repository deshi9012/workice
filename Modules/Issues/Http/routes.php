<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'issues', 'namespace' => 'Modules\Issues\Http\Controllers'],
    function () {
        Route::get('create/{project}/{status?}', 'IssuesCustomController@create')->name('issues.create')->middleware('can:issues_create');
        Route::get('status/{issue}', 'IssuesCustomController@status')->name('issues.status');
        Route::get('edit/{issue}', 'IssuesCustomController@edit')->name('issues.edit')->middleware('can:issues_update');
        Route::get('delete/{issue}', 'IssuesCustomController@delete')->name('issues.delete')->middleware('can:issues_create');
        Route::get('ajax/files/{id}', 'IssuesCustomController@ajaxFiles')->name('tasks.ajax.files');
        Route::get('sentry/{token}', 'IssuesCustomController@sentry')->name('issues.sentry');
    }
);
