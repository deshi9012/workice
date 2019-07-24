<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'calendar', 'namespace' => 'Modules\Calendar\Http\Controllers'],
    function () {
        Route::get('create/{module}/{id?}', 'CalendarCustomController@create')->name('calendar.create')->middleware('can:events_create');
        Route::get('reminder/{module}/{id}', 'CalendarCustomController@reminder')->name('calendar.reminder')->middleware('can:reminders_create');

        Route::get('view/{entity}/{module}', 'CalendarCustomController@view')->name('calendar.view');
        Route::get('edit/{event}', 'CalendarCustomController@edit')->name('calendar.edit')->middleware('can:events_update');

        Route::get('feed/{token}', 'FeedController@feed')->name('calendar.feed');
        Route::get('ical', 'CalendarCustomController@ical')->name('calendar.ical');
        Route::get('appointments', 'CalendarCustomController@appointments')->name('calendar.appointments')->middleware('can:menu_calendar');
        Route::get('appointments/create/{lead_id?}', 'CalendarCustomController@createAppointment')->name('calendar.create.appointment')->middleware('can:menu_calendar');
        Route::get('appointments/edit/{id}', 'CalendarCustomController@editAppointment')->name('calendar.edit.appointment')->middleware('can:menu_calendar');
        Route::get('appointments/view/{id}', 'CalendarCustomController@viewAppointment')->name('calendar.view.appointment')->middleware('can:menu_calendar');

        Route::get('download', 'CalendarCustomController@download')->name('calendar.download');

        Route::get('todos', 'CalendarCustomController@todos')->name('calendar.todos');
        Route::get('appointment/{token}', 'SharedAppointmentController@show')->name('calendar.appointment.public');
        Route::get('/', 'CalendarCustomController@index')->name('calendar.index')->middleware('can:menu_calendar');
    }
);
