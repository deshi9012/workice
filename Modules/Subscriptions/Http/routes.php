<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'subscriptions', 'namespace' => 'Modules\Subscriptions\Http\Controllers'],
    function () {
        Route::get('/', 'SubscriptionsController@index')->name('subscriptions.index');
        Route::get('admin-data', 'AdminSubscriptionController@tableData')->name('subscriptions.admin.data')->middleware('can:menu_subscriptions');
        Route::get('client-data', 'ClientSubscriptionController@tableData')->name('subscriptions.client.data')->middleware('can:menu_subscriptions');
        Route::get('admin-plans', 'AdminSubscriptionController@plansData')->name('plans.data')->middleware('can:menu_subscriptions');

        Route::get('plans', 'PlansController@plans')->name('plans.index');
        Route::get('plans/{plan}', 'PlansController@edit')->name('plans.edit');
        Route::get('delete-plan/{plan}', 'PlansController@delete')->name('plans.delete');
        Route::get('create', 'PlansController@create')->name('plans.create')->middleware('can:subscriptions_create');
        Route::get('send/{plan}', 'PlansController@send')->name('plans.send');

        Route::get('subscribe/{plan}', 'SubscriptionsController@subscribe')->name('subscriptions.subscribe');
        Route::get('cancel/{plan}', 'SubscriptionsController@cancel')->name('subscriptions.cancel');
        Route::get('activate/{plan}', 'SubscriptionsController@activate')->name('subscriptions.activate');
        Route::post('subscribe', 'SubscriptionsController@process')->name('subscriptions.process');
        Route::post('deactivate', 'SubscriptionsController@deactivate')->name('subscriptions.deactivate');

        Route::get('invoices', 'SubscriptionsController@invoices')->name('subscriptions.invoices')->middleware(['demo']);

        Route::get('admin-cancel/{id}', 'SubscriptionsController@adminCancel')->name('subscriptions.admin.cancel');
        Route::get('admin-activate/{id}', 'SubscriptionsController@adminActivate')->name('subscriptions.admin.activate');
        Route::post('admin-deactivate', 'SubscriptionsController@adminDeactivate')->name('subscriptions.admin.deactivate')->middleware('demo');
    }
);
