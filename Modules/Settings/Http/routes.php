<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'settings', 'namespace' => 'Modules\Settings\Http\Controllers'],
    function () {
        Route::get('locale/{locale}', 'SettingController@index')->name('settings.locale')->middleware('can:settings_update');
        Route::post('menu/reorder', 'SettingController@reorderMenu')->name('menu.reorder')->middleware('can:settings_update');
        Route::post('menu/icon/{module}', 'SettingController@menuIcon')->name('menu.icon')->middleware('can:settings_update');
        Route::post('menu/visible/{module}', 'SettingController@menuVisible')->name('menu.visible')->middleware('can:settings_update');

        Route::post('fields/select', 'FieldsController@selectModule')->name('fields.module')->middleware('can:settings_update');
        Route::post('fields/save', 'FieldsController@save')->name('fields.save')->middleware('can:settings_update');

        Route::get('currencies/create', 'CurrencyController@create')->name('settings.currencies.create')->middleware('can:settings_update');
        Route::post('currencies/save', 'CurrencyController@save')->name('settings.currencies.save')->middleware('can:settings_update');
        Route::get('currencies/edit/{id}', 'CurrencyController@edit')->name('settings.currencies.edit')->middleware('can:settings_update');
        Route::put('currencies/update/{id}', 'CurrencyController@update')->name('settings.currencies.update')->middleware('can:settings_update');
        Route::get('currencies/delete/{id}', 'CurrencyController@delete')->name('settings.currencies.delete')->middleware('can:settings_update');
        Route::delete('currencies/destroy/{id}', 'CurrencyController@destroy')->name('settings.currencies.destroy')->middleware('can:settings_update');

        Route::get('test/mail', 'SettingController@testMail')->name('settings.test.mail')->middleware('can:settings_update');
        Route::post('test/mail', 'SettingController@sendMail')->name('settings.send.mail')->middleware('can:settings_update');

        Route::post('custom/css', 'CssController@customize')->name('settings.custom.css')->middleware(['can:settings_update', 'demo']);

        Route::post('translation/status/{locale}', 'TransController@status')->name('translations.status')->middleware(['can:settings_update', 'demo']);
        Route::get('translation/view/{locale}', 'TransController@view')->name('translations.view')->middleware('can:settings_update');
        Route::get('translation/edit/{locale}/{file}', 'TransController@edit')->name('translations.edit')->middleware('can:settings_update');
        Route::post('translation/save', 'TransController@save')->name('translations.save')->middleware(['can:settings_update', 'demo']);
        Route::get('translation/download', 'TransController@download')->name('translations.download')->middleware('can:settings_update');
        Route::get('translation/upload', 'TransController@upload')->name('translations.upload')->middleware('can:settings_update');
        Route::post('translation/restore', 'TransController@restore')->name('translations.restore')->middleware(['can:settings_update', 'demo']);
        Route::get('language/create', 'TransController@create')->name('languages.create')->middleware('can:settings_update');
        Route::post('language/save', 'TransController@saveLanguage')->name('languages.save')->middleware(['can:settings_update', 'demo']);
        Route::post('language/delete', 'TransController@deleteLanguage')->name('languages.delete')->middleware(['can:settings_update', 'demo']);

        Route::get('translation/mail', 'TransController@mail')->name('translations.mail')->middleware(['can:settings_update', 'demo']);
        Route::get('translation/modify/{locale}', 'TransController@changeMail')->name('translations.mail.change')->middleware(['can:settings_update', 'demo']);
        Route::post('translation/mail/save', 'TransController@saveMail')->name('translations.mail.save')->middleware(['can:settings_update', 'demo']);

        Route::get('import/{type}', 'ImportCustomController@import')->name('settings.import')->middleware(['can:settings_update', 'demo']);
        Route::post('import/process', 'ImportCustomController@importJson')->name('settings.import.fo')->middleware(['can:settings_update', 'demo']);

        Route::get('stages/{module}', 'StagesController@stages')->name('settings.stages.show')->middleware('can:settings_update');
        Route::post('stages/save', 'StagesController@save')->name('settings.stages.save')->middleware('can:settings_update');
        Route::post('stages/order', 'StagesController@order')->name('settings.stages.order')->middleware('can:settings_update');
        Route::get('stages/edit/{id}', 'StagesController@edit')->name('settings.stages.edit')->middleware('can:settings_update');
        Route::put('stages/update/{id}', 'StagesController@update')->name('settings.stages.update')->middleware('can:settings_update');
        Route::post('stages/delete', 'StagesController@delete')->name('settings.stages.delete')->middleware('can:settings_update');

        Route::get('departments', 'DepartmentController@departments')->name('departments.show')->middleware('can:settings_update');
        Route::post('departments/save', 'DepartmentController@save')->name('departments.save')->middleware('can:settings_update');
        Route::get('departments/edit/{id}', 'DepartmentController@edit')->name('departments.edit')->middleware('can:settings_update');
        Route::put('departments/update/{id}', 'DepartmentController@update')->name('departments.update')->middleware('can:settings_update');
        Route::post('departments/delete', 'DepartmentController@delete')->name('departments.delete')->middleware('can:settings_update');

        Route::get('sources', 'SourceController@sources')->name('settings.sources.show')->middleware('can:settings_update');
        Route::post('sources/save', 'SourceController@save')->name('settings.sources.save')->middleware('can:settings_update');
        Route::get('sources/edit/{id}', 'SourceController@edit')->name('settings.sources.edit')->middleware('can:settings_update');
        Route::put('sources/update/{id}', 'SourceController@update')->name('settings.sources.update')->middleware('can:settings_update');
        Route::post('sources/delete', 'SourceController@delete')->name('settings.sources.delete')->middleware('can:settings_update');

        Route::get('pipelines', 'PipelinesController@pipelines')->name('settings.pipelines.show')->middleware('can:settings_update');
        Route::post('pipelines/save', 'PipelinesController@save')->name('settings.pipelines.save')->middleware('can:settings_update');
        Route::get('pipelines/edit/{id}', 'PipelinesController@edit')->name('settings.pipelines.edit')->middleware('can:settings_update');
        Route::put('pipelines/update/{id}', 'PipelinesController@update')->name('settings.pipelines.update')->middleware('can:settings_update');
        Route::post('pipelines/delete', 'PipelinesController@delete')->name('settings.pipelines.delete')->middleware('can:settings_update');
        Route::post('pipelines/order', 'PipelinesController@order')->name('settings.pipelines.order')->middleware('can:settings_update');

        Route::get('statuses', 'StatusController@index')->name('settings.statuses.show')->middleware('can:settings_update');
        Route::post('statuses', 'StatusController@save')->name('settings.statuses.save')->middleware('can:settings_update');
        Route::get('statuses/{id}', 'StatusController@edit')->name('settings.statuses.edit')->middleware('can:settings_update');
        Route::put('statuses/{id}', 'StatusController@update')->name('settings.statuses.update')->middleware('can:settings_update');
        Route::post('statuses/delete', 'StatusController@delete')->name('settings.statuses.delete')->middleware('can:settings_update');

        Route::get('calendars', 'CalendarController@index')->name('settings.calendars.show')->middleware('can:settings_update');
        Route::post('calendars', 'CalendarController@save')->name('settings.calendars.save')->middleware('can:settings_update');
        Route::get('calendars/{id}', 'CalendarController@edit')->name('settings.calendars.edit')->middleware('can:settings_update');
        Route::put('calendars/{id}', 'CalendarController@update')->name('settings.calendars.update')->middleware('can:settings_update');
        Route::post('calendars/delete', 'CalendarController@delete')->name('settings.calendars.delete')->middleware('can:settings_update');

        Route::get('artisan/{key}/{command}', 'CommandsController@run')->name('commands.run')->middleware('demo');
        Route::get('artisan/regenerate', 'CommandsController@regenerateKey')->name('commands.key')->middleware(['can:settings_update', 'demo']);

        Route::get('/{section?}', 'SettingController@index')->name('settings.index')->middleware('can:menu_settings');
        Route::post('{section}', 'SettingController@configure')->name('settings.edit')->middleware(['demo', 'can:settings_update']);
    }
);
