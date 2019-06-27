<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'],
    function () {
        Route::get('/', 'UserCustomController@index')->name('users.index')->middleware('can:menu_users');

        Route::get('edit/{user}', 'UserCustomController@edit')->name('users.edit')->middleware('can:users_update');
        Route::get('permissions/{user}', 'UserCustomController@permissions')->name('users.permissions')->middleware('can:users_update');
        Route::post('permissions/{user}', 'UserCustomController@changePermission')->name('users.changePermission')->middleware('can:users_update');

        Route::get('permissions', 'PermController@index')->name('users.perm')->middleware('can:roles_create');
        Route::get('create-permission', 'PermController@create')->name('users.perm.create')->middleware('can:roles_create');
        Route::post('save-permission', 'PermController@save')->name('users.perm.save')->middleware(['can:roles_create', 'demo']);
        Route::get('edit-permission/{perm}', 'PermController@edit')->name('users.perm.edit')->middleware('can:roles_create');
        Route::put('edit-permission/{perm}', 'PermController@update')->name('users.perm.update')->middleware(['can:roles_create', 'demo']);
        Route::get('delete-permission/{perm}', 'PermController@delete')->name('users.perm.delete')->middleware(['can:roles_create']);
        Route::delete('destroy-permission/{perm}', 'PermController@destroy')->name('users.perm.destroy')->middleware(['can:roles_create', 'demo']);

        Route::get('roles', 'RoleController@index')->name('users.roles')->middleware('can:roles_create');
        Route::get('create-role', 'RoleController@create')->name('users.roles.create')->middleware('can:roles_create');
        Route::get('edit-role/{role}', 'RoleController@edit')->name('users.roles.edit')->middleware('can:roles_update');
        Route::get('role-permission/{role}', 'RoleController@permission')->name('users.roles.permission')->middleware('can:roles_update');
        Route::post('role-permission/{role}', 'RoleController@changePermission')->name('users.roles.changePerm')->middleware(['can:roles_update', 'demo']);
        Route::get('delete-role/{role}', 'RoleController@delete')->name('users.roles.delete')->middleware('can:roles_delete');
        Route::post('roles', 'RoleController@save')->name('roles.save')->middleware(['can:roles_create', 'demo']);
        Route::put('roles/{id}', 'RoleController@update')->name('roles.update')->middleware(['can:roles_update', 'demo']);
        Route::delete('roles/{id}', 'RoleController@destroy')->name('roles.destroy')->middleware(['can:roles_delete', 'demo']);

        Route::get('data', 'UserCustomController@tableData')->name('users.data')->middleware('can:menu_users');
        Route::get('create', 'UserCustomController@create')->name('users.create')->middleware('can:users_create');
        Route::get('view/{user}/{tab?}', 'UserCustomController@view')->name('users.view');
        Route::get('suspend/{user}', 'UserCustomController@suspend')->name('users.suspend')->middleware('can:users_update');
        Route::get('delete/{user}', 'UserCustomController@delete')->name('users.delete')->middleware('can:users_delete');
        Route::post('bulk-delete', 'UserCustomController@bulkDelete')->name('users.bulk.delete')->middleware(['can:users_delete', 'demo']);

        Route::get('export', 'UserCustomController@export')->name('users.export')->middleware(['can:users_create', 'demo']);

        Route::get('profile', 'ProfileCustomController@profile')->name('users.profile');
        Route::get('reminders', 'ProfileCustomController@reminders')->name('users.reminders');
        Route::post('change', 'ProfileCustomController@change')->name('users.change')->middleware(['demo']);

        Route::get('announcements', 'AnnouncementCustomController@index')->name('announcements.index')->middleware(['can:announcements_create']);
        Route::get('announcements/{id}', 'AnnouncementCustomController@edit')->name('announcements.update')->middleware(['can:announcements_update']);

        Route::get('/impersonate/{id}', 'UserCustomController@impersonate')->name('users.impersonate');
        Route::get('/stop', 'UserCustomController@stopImpersonate')->name('users.stopimpersonate');

        Route::get('reauthenticate', 'ReauthenticateController@reauthenticate')->name('users.reauthenticate');
        Route::post('reauthenticate', 'ReauthenticateController@processReauthenticate')->name('users.reauthenticate.process');

        Route::get('/new-token', 'UserCustomController@regenerateKey')->name('users.token');

        Route::get('/pin/{entity}/{module}', 'UserCustomController@pin')->name('users.pin');

        Route::get('gdpr-export', 'UserCustomController@gdprExport')->name('users.gdpr.export');
        Route::get('api-setup', 'ProfileCustomController@apiSetup')->name('users.api');

        Route::get('holiday/{status}', 'UserCustomController@holiday')->name('users.holiday')->middleware(['can:users_update', 'demo']);

        Route::get('2fa/complete/{secret}', 'TwoFactorCustomController@complete')->name('users.2fa.complete')->middleware(['demo']);
        Route::get('2fa/disable', 'TwoFactorCustomController@disable')->name('users.2fa.disable')->middleware(['demo']);
        Route::get('2fa', 'TwoFactorCustomController@twoFactor')->name('users.2fa');

        Route::get('oauth/create-client', 'OauthController@oauthClient')->name('oauth.create.client');
        Route::get('oauth/new-token', 'OauthController@oauthToken')->name('oauth.refresh.token');
        Route::post('oauth/new-token', 'OauthController@tokenRecreate')->name('oauth.recreate.token');
        Route::get('oauth/edit-client/{id}', 'OauthController@oauthUpdateClient')->name('oauth.update.client');
        Route::get('oauth/delete-client/{id}', 'OauthController@oauthDeleteClient')->name('oauth.delete.client')->middleware(['demo']);

        Route::get('notifications/clear', 'NotificationCustomController@clearAlerts')->name('users.notifications.clear');
        Route::get('notifications', 'NotificationCustomController@notifications')->name('users.notifications');
        Route::get('preferences', 'NotificationCustomController@preferences')->name('notifications.preferences');
        Route::post('preferences', 'NotificationCustomController@savePreferences')->name('notifications.preferences.save')->middleware('demo');
    }
);
