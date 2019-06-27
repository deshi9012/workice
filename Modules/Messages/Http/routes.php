<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'messages', 'namespace' => 'Modules\Messages\Http\Controllers'], function () {
        Route::get('/', 'MessageCustomController@index')->name('messages.index');
        Route::post('/ajax-send', 'MessageCustomController@ajaxSend')->name('messages.ajaxsend');
        Route::post('/pusher-message/{message}', 'MessageCustomController@pusherMessage')->name('messages.ajaxpusher');
        Route::post('/ajax-delete/{id}', 'MessageCustomController@ajaxDeleteMessage')->name('messages.ajaxdelete');
        Route::get('/new', 'MessageCustomController@newMessage')->name('messages.new');
        Route::post('/send', 'MessageCustomController@send')->name('message.send');
        Route::get('search', 'MessageCustomController@search')->name('messages.search');
        Route::get('/{id}', 'MessageCustomController@chatHistory')->name('message.read');
        Route::get('/email-delete/{mail}', 'MessageCustomController@emailDelete')->name('email.delete');
        Route::delete('/email-delete/{mail}', 'MessageCustomController@emailDestroy')->name('email.destroy');
    }
);
