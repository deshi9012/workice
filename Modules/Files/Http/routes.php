<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'files', 'namespace' => 'Modules\Files\Http\Controllers'],
    function () {
        Route::get('upload/{module}/{id}', 'FilesController@upload')->name('files.upload')->middleware('can:files_create');
        Route::post('save', 'FilesController@save')->name('files.save')->middleware(['can:files_create', 'demo']);
        Route::get('download/{file}', 'FilesController@download')->name('files.download');
        Route::get('preview/{file}', 'FilesController@preview')->name('files.preview');
        Route::get('edit/{file}', 'FilesController@edit')->name('files.edit')->middleware(['can:update,file']);
        Route::put('update/{file}', 'FilesController@update')->name('files.update')->middleware(['can:update,file']);
        Route::get('delete/{file}', 'FilesController@delete')->name('files.delete')->middleware(['can:delete,file']);
        Route::delete('destroy', 'FilesController@destroy')->name('files.destroy')->middleware(['demo']);
    }
);
