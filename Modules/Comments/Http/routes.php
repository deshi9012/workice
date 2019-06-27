<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'comments', 'namespace' => 'Modules\Comments\Http\Controllers'], function () {
        Route::post('/ajax-send', 'CommentCustomController@ajaxSend')->name('comments.ajaxsend');
        Route::post('ajax-delete', 'CommentCustomController@ajaxDeleteComment')->name('comments.ajaxdelete');
        Route::post('create', 'CommentCustomController@create')->name('comments.create');
        Route::get('edit/{comment}', 'CommentCustomController@edit')->name('comments.edit');
        Route::put('update/{comment}', 'CommentCustomController@update')->name('comments.update');
        Route::get('delete/{comment}/{module}', 'CommentCustomController@delete')->name('comments.delete')->middleware('can:comments_delete');
        Route::delete('destroy', 'CommentCustomController@destroy')->name('comments.destroy')->middleware('can:comments_delete');
        Route::get('reply/{comment}', 'CommentCustomController@reply')->name('comments.reply');
    }
);
