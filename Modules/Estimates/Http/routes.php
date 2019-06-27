<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'estimates', 'namespace' => 'Modules\Estimates\Http\Controllers'],
    function () {
        Route::get('/', 'EstimateCustomController@index')->name('estimates.index')->middleware('can:menu_estimates');
        Route::get('data', 'EstimateCustomController@tableData')->name('estimates.data')->middleware('can:menu_estimates');
        Route::get('create/{client?}', 'EstimateCustomController@create')->name('estimates.create')->middleware('can:estimates_create');
        Route::get('copy/{estimate}', 'EstimateCustomController@duplicate')->name('estimates.duplicate')->middleware('can:estimates_create');

        Route::get('view/{estimate}', 'EstimateCustomController@view')->name('estimates.view');
        Route::get('convert/{estimate}', 'EstimateCustomController@convert')->name('estimates.convert')->middleware('can:invoices_create');
        Route::get('show/{estimate}', 'EstimateCustomController@show')->name('estimates.show')->middleware('can:estimates_update');
        Route::get('hide/{estimate}', 'EstimateCustomController@hide')->name('estimates.hide')->middleware('can:estimates_update');
        Route::get('activity/{estimate}', 'EstimateCustomController@activity')->name('estimates.activity');
        Route::get('edit/{estimate}', 'EstimateCustomController@edit')->name('estimates.edit')->middleware('can:estimates_update');
        Route::get('send/{estimate}', 'EstimateCustomController@send')->name('estimates.send')->middleware('can:estimates_send');
        Route::get('decline/{estimate}', 'EstimateCustomController@declined')->name('estimates.declined')->middleware('can:decline,estimate');
        Route::get('accept/{estimate}', 'EstimateCustomController@accepted')->name('estimates.accepted')->middleware('can:accept,estimate');
        Route::get('project/{estimate}', 'EstimateCustomController@toProject')->name('estimates.project')->middleware('can:projects_create');
        Route::get('export', 'EstimateCustomController@export')->name('estimates.export');
        Route::get('comments/{estimate}', 'EstimateCustomController@comments')->name('estimates.comments')->middleware('can:estimates_comment');

        Route::get('import', 'EstimateCustomController@import')->name('estimates.import')->middleware('can:estimates_create');
        Route::post('csvmap', 'EstimateCustomController@parseImport')->name('estimates.csvmap')->middleware('can:estimates_create');
        Route::post('csvprocess', 'EstimateCustomController@processImport')->name('estimates.csvprocess')->middleware('can:estimates_create');

        Route::get('delete/{estimate}', 'EstimateCustomController@delete')->name('estimates.delete')->middleware('can:estimates_delete');
        Route::get('pdf/{estimate}', 'EstimateCustomController@pdf')->name('estimates.pdf')->middleware('can:menu_estimates');
        Route::get('share/{id}', 'EstimateCustomController@share')->name('estimates.share')->middleware('can:estimates_update');

        Route::get('shared/{estimate}', 'GuestCustomController@guest')->name('estimates.guest')->middleware('signed');
        Route::get('shared-pdf/{estimate}', 'GuestCustomController@pdf')->name('estimates.guestpdf')->middleware('signed');
        Route::get('shared-accept/{estimate}', 'GuestCustomController@accept')->name('estimates.guestaccept')->middleware('signed');
        Route::get('shared-decline/{estimate}', 'GuestCustomController@decline')->name('estimates.guestdecline')->middleware('signed');
        Route::post('shared-cancel/{estimate}', 'GuestCustomController@cancel')->name('estimates.guestcancel')->middleware('signed');

        Route::post('bulk-delete', 'EstimateCustomController@bulkDelete')->name('estimates.bulk.delete')->middleware('can:estimates_delete');
        Route::post('bulk-send', 'EstimateCustomController@bulkSend')->name('estimates.bulk.send')->middleware('can:estimates_send');
    }
);
