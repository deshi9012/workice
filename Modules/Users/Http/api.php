<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Users\Http\Controllers\Api\v1'], function () {
        Route::get('users/{id}', 'UsersApiController@show')->name('users.api.show')->middleware('can:menu_users');
        Route::get('users', 'UsersApiController@index')->name('users.api.index')->middleware('can:menu_users');
        Route::post('users/{id}/ban', 'UsersApiController@ban')->name('users.api.ban')->middleware(['can:users_update', 'demo']);
        Route::put('users/{id}', 'UsersApiController@update')->name('users.api.update')->middleware(['can:users_update', 'demo']);
        Route::delete('users/{id}', 'UsersApiController@delete')->name('users.api.delete')->middleware('can:users_delete');
        Route::post('users', 'UsersApiController@save')->name('users.api.save')->middleware('can:users_create');

        Route::post('announcements', 'AnnouncementsApiController@save')->name('announcements.api.save')->middleware('can:announcements_create');
        Route::put('announcements/{id}', 'AnnouncementsApiController@update')->name('announcements.api.update')->middleware(['can:announcements_update']);
        Route::delete('announcements/{id}', 'AnnouncementsApiController@delete')->name('announcements.api.delete')->middleware('can:announcements_delete');
    }
);
