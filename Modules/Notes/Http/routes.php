<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'notes', 'namespace' => 'Modules\Notes\Http\Controllers'], function () {
        Route::get('/', 'NotesCustomController@index')->name('notes.index');
        Route::get('data', 'NotesCustomController@get')->name('notes.get');
        Route::post('data', 'NotesCustomController@create')->name('notes.create');
        Route::put('data/{id}', 'NotesCustomController@store')->name('notes.update');
        Route::delete('data/{id}', 'NotesCustomController@delete')->name('notes.delete');
        Route::post('project', 'NotesCustomController@project')->name('notes.project');

        Route::post('destroy-note/{note}', 'NotesCustomController@destroyNote')->name('notes.destroy');
        Route::post('save', 'NotesCustomController@saveNote')->name('notes.save');
        Route::get('edit/{note}', 'NotesCustomController@editNote')->name('notes.edit');
        Route::post('update/{note}', 'NotesCustomController@updateNote')->name('notes.change');
    }
);
