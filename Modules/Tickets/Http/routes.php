<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'tickets', 'namespace' => 'Modules\Tickets\Http\Controllers'],
    function () {
        Route::get('/', 'TicketCustomController@index')->name('tickets.index')->middleware('can:menu_tickets');
        Route::get('create', 'TicketCustomController@create')->name('tickets.create')->middleware(['can:tickets_create']);
        Route::get('edit/{ticket}', 'TicketCustomController@edit')->name('tickets.edit')->middleware('can:update,ticket');
        Route::get('delete/{ticket}', 'TicketCustomController@delete')->name('tickets.delete')->middleware('can:delete,ticket');
        Route::post('bulk-delete', 'TicketCustomController@bulkDelete')->name('tickets.bulk.delete')->middleware('can:tickets_delete');
        Route::post('bulk-close', 'TicketCustomController@bulkClose')->name('tickets.bulk.close')->middleware('can:tickets_delete');
        Route::get('data', 'TicketCustomController@tableData')->name('tickets.data')->middleware('can:menu_tickets');
        Route::get('view/{ticket}', 'TicketCustomController@view')->name('tickets.view');
        Route::get('convert/{ticket}', 'TicketCustomController@convert')->name('tickets.convert')->middleware('can:tasks_create');
        Route::get('status/{ticket}/{status}', 'TicketCustomController@status')->name('tickets.status');
        Route::post('ajaxfields', 'TicketCustomController@ajaxFields')->name('tickets.ajaxfields');
        Route::post('lock', 'TicketCustomController@lock')->name('tickets.lock');
        Route::get('feedback/{ticket}', 'FeedbackController@feedback')->name('tickets.feedback')->middleware('signed');
        Route::post('rating/{ticket}', 'FeedbackController@rating')->name('tickets.rating')->middleware('signed');
        Route::get('reviews/{ticket}', 'TicketCustomController@reviews')->name('tickets.reviews');
        Route::post('create-task/{ticket}', 'TicketCustomController@createTask')->name('tickets.task.create')->middleware('can:tasks_create');
        ;
    }
);
