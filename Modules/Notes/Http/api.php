<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Notes\Http\Controllers\Api\v1'], function () {
        Route::get('notes', 'NotesApiController@index')->middleware('can:menu_notes');
        Route::post('notes', 'NotesApiController@store')->middleware('can:menu_notes');
        Route::put('notes/{id}', 'NotesApiController@update')->middleware('can:menu_notes');
        Route::delete('notes/{id}', 'NotesApiController@delete')->middleware('can:menu_notes');
    }
);
