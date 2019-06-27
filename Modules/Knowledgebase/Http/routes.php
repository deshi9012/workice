<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'knowledgebase', 'namespace' => 'Modules\Knowledgebase\Http\Controllers'],
    function () {
        Route::get('/', 'KbCustomController@index')->name('kb.index')->middleware('can:menu_knowledgebase');
        Route::get('view/{kb}', 'KbCustomController@view')->name('kb.view');
        Route::get('create', 'KbCustomController@create')->name('kb.create')->middleware('can:articles_create');
        Route::post('save', 'KbCustomController@save')->name('kb.save')->middleware('can:articles_create');
        Route::get('edit/{kb}', 'KbCustomController@edit')->name('kb.edit')->middleware('can:articles_update');
        Route::put('update/{kb}', 'KbCustomController@update')->name('kb.update')->middleware('can:articles_update');
        Route::get('delete/{kb}', 'KbCustomController@delete')->name('kb.delete')->middleware('can:articles_delete');
        Route::delete('destroy', 'KbCustomController@destroy')->name('kb.destroy')->middleware('can:articles_delete');

        Route::get('show-categories', 'SetupController@showCategory')->name('kb.category.show');
        Route::post('save-category', 'SetupController@saveCategory')->name('kb.category.save');
        Route::get('edit-category/{id}', 'SetupController@editCategory')->name('kb.category.edit');
        Route::put('update-category/{id}', 'SetupController@updateCategory')->name('kb.category.update');
        Route::post('delete-category', 'SetupController@destroyCategory')->name('kb.category.destroy');

        Route::get('vote/{article}/{vote}', 'KbCustomController@vote')->name('kb.vote');
    }
);
