<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Expenses\Http\Controllers\Api\v1'], function () {
        Route::get('expenses', 'ExpensesApiController@index')->name('expenses.api.index')->middleware('can:menu_expenses');
        Route::get('expenses/{id}', 'ExpensesApiController@show')->name('expenses.api.show')->middleware('can:menu_expenses');
        Route::get('expenses/{id}/comments', 'ExpensesApiController@comments')->name('expenses.api.comments')->middleware('can:menu_expenses');
        Route::post('expenses', 'ExpensesApiController@save')->name('expenses.api.save')->middleware('can:expenses_create');
        Route::post('expenses/{id}/copy', 'ExpensesApiController@copy')->name('expenses.api.copy')->middleware('can:expenses_create');
        Route::put('expenses/{id}', 'ExpensesApiController@update')->name('expenses.api.update')->middleware('can:expenses_update');
        Route::delete('expenses/{id}', 'ExpensesApiController@delete')->name('expenses.api.delete')->middleware('can:expenses_delete');
    }
);
