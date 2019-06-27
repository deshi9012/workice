<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'milestones', 'namespace' => 'Modules\Milestones\Http\Controllers'], function () {
        Route::get('/', 'MilestoneCustomController@index')->name('milestones.index');
        Route::get('create/{project}', 'MilestoneCustomController@create')->name('milestones.create')->middleware('can:milestones_create');
        Route::post('save', 'MilestoneCustomController@save')->name('milestones.save')->middleware('can:milestones_create');
        Route::get('edit/{milestone}', 'MilestoneCustomController@edit')->name('milestones.edit')->middleware('can:milestones_update');
        Route::post('milestone/{milestone}', 'MilestoneCustomController@update')->name('milestones.update')->middleware('can:milestones_update');
        Route::get('delete/{milestone}', 'MilestoneCustomController@delete')->name('milestones.delete')->middleware('can:milestones_delete');
        Route::post('destroy/{milestone}', 'MilestoneCustomController@destroy')->name('milestones.destroy')->middleware('can:milestones_delete');
    }
);
