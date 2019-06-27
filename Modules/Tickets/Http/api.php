<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Tickets\Http\Controllers\Api\v1'],
    function () {
        Route::get('tickets', 'TicketsApiController@index')->name('tickets.api.index')->middleware('can:menu_tickets');
        Route::get('tickets/{id}/comments', 'TicketsApiController@comments')->name('tickets.api.comments')->middleware('can:menu_tickets');
        Route::get('tickets/{id}', 'TicketsApiController@show')->name('tickets.api.show')->middleware('can:menu_tickets');
        Route::post('tickets/{id}/status', 'TicketsApiController@status')->name('tickets.api.status')->middleware('can:menu_tickets');
        Route::put('tickets/{id}', 'TicketsApiController@update')->name('tickets.api.update')->middleware('can:menu_tickets');
        Route::delete('tickets/{id}', 'TicketsApiController@delete')->name('tickets.api.delete')->middleware('can:menu_tickets');
        Route::post('tickets', 'TicketsApiController@save')->name('tickets.api.save')->middleware('can:tickets_create');
    }
);
