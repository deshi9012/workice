<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Clients\Http\Controllers\Api\v1'], function () {
        Route::get('clients/{id}/contacts', 'ClientsApiController@contacts')->middleware('can:menu_clients');
        Route::get('clients/{id}/projects', 'ClientsApiController@projects')->middleware('can:menu_clients');
        Route::get('clients/{id}/invoices', 'ClientsApiController@invoices')->middleware('can:menu_clients');
        Route::get('clients/{id}/estimates', 'ClientsApiController@estimates')->middleware('can:menu_clients');
        Route::get('clients/{id}/payments', 'ClientsApiController@payments')->middleware('can:menu_clients');
        Route::get('clients/{id}/subscriptions', 'ClientsApiController@subscriptions')->middleware('can:menu_subscriptions');
        Route::get('clients/{id}/expenses', 'ClientsApiController@expenses')->middleware('can:menu_clients');
        Route::get('clients/{id}/deals', 'ClientsApiController@deals')->middleware('can:menu_clients');
        Route::get('clients/{id}', 'ClientsApiController@show')->name('clients.api.show')->middleware('can:menu_clients');
        Route::get('clients', 'ClientsApiController@index')->name('clients.api.index')->middleware('can:menu_clients');
        Route::post('clients', 'ClientsApiController@save')->name('clients.api.save')->middleware('can:clients_create');
        Route::put('clients/{id}', 'ClientsApiController@update')->name('clients.api.update')->middleware('can:clients_update');
        Route::delete('clients/{id}', 'ClientsApiController@delete')->name('clients.api.delete')->middleware('can:clients_delete');
    }
);
