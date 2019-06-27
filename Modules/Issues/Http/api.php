<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Issues\Http\Controllers\Api\v1'], function () {
        Route::get('issues', 'IssuesApiController@index')->name('issues.api.index')->middleware('can:issues_create');
        Route::get('issues/{id}', 'IssuesApiController@show')->name('issues.api.show')->middleware('can:issues_create');
        Route::get('issues/{id}/comments', 'IssuesApiController@comments')->name('issues.api.comments')->middleware('can:issues_update');
        Route::post('issues', 'IssuesApiController@save')->name('issues.api.save')->middleware('can:issues_create');
        Route::post('issues/{id}/status', 'IssuesApiController@status')->name('issues.api.status')->middleware('can:issues_update');
        Route::post('issues/{id}/ajax-status', 'IssuesApiController@ajaxStatus')->name('issues.api.ajax-status')->middleware('can:issues_update');
        Route::put('issues/{id}', 'IssuesApiController@update')->name('issues.api.update')->middleware('can:issues_update');
        Route::delete('issues/{id}', 'IssuesApiController@delete')->name('issues.api.delete')->middleware('can:issues_delete');
    }
);
