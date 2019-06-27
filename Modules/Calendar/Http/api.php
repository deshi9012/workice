<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Calendar\Http\Controllers\Api\v1'], function () {
        Route::post('reminders', 'RemindersApiController@save')->name('reminders.api.save')->middleware('can:reminders_create');

        Route::post('events', 'EventsApiController@save')->name('events.api.save')->middleware('can:events_create');
        Route::put('events/{id}', 'EventsApiController@update')->name('events.api.update')->middleware('can:events_update');

        Route::post('appointments', 'AppointmentApiController@save')->name('appointments.api.save')->middleware('can:reminders_create');
        Route::put('appointments/{id}', 'AppointmentApiController@update')->name('appointments.api.update')->middleware('can:reminders_create');
    }
);
