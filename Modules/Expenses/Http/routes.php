<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'expenses', 'namespace' => 'Modules\Expenses\Http\Controllers'],
    function () {
        Route::get('/', 'ExpenseCustomController@index')->name('expenses.index')->middleware('can:menu_expenses');
        Route::get('data', 'ExpenseCustomController@tableData')->name('expenses.data')->middleware('can:menu_expenses');
        Route::get('create/{project?}', 'ExpenseCustomController@create')->name('expenses.create')->middleware('can:expenses_create');
        Route::get('view/{expense}', 'ExpenseCustomController@view')->name('expenses.view')->middleware('can:view,expense');
        Route::get('hide/{expense}', 'ExpenseCustomController@hide')->name('expenses.hide')->middleware('can:expenses_update');
        Route::get('show/{expense}', 'ExpenseCustomController@show')->name('expenses.show')->middleware('can:expenses_update');
        Route::get('edit/{expense}', 'ExpenseCustomController@edit')->name('expenses.edit')->middleware('can:expenses_update');
        Route::get('copy/{expense}', 'ExpenseCustomController@copy')->name('expenses.copy')->middleware('can:expenses_create');
        Route::get('import', 'ExpenseCustomController@import')->name('expenses.import')->middleware('can:expenses_create');
        Route::post('csvmap', 'ExpenseCustomController@parseImport')->name('expenses.csvmap')->middleware('can:expenses_create');
        Route::post('csvprocess', 'ExpenseCustomController@processImport')->name('expenses.csvprocess')->middleware('can:expenses_create');
        Route::get('export', 'ExpenseCustomController@export')->name('expenses.export');
        Route::get('delete/{expense}', 'ExpenseCustomController@delete')->name('expenses.delete')->middleware('can:expenses_delete');
        Route::get('show-categories', 'SetupController@showCategory')->name('expenses.category.show');
        Route::post('save-category', 'SetupController@saveCategory')->name('expenses.category.save');
        Route::get('edit-category/{id}', 'SetupController@editCategory')->name('expenses.category.edit');
        Route::put('update-category/{id}', 'SetupController@updateCategory')->name('expenses.category.update');
        Route::post('delete-category', 'SetupController@destroyCategory')->name('expenses.category.destroy');
        Route::post('bulk-bill', 'ExpenseCustomController@bulkBill')->name('expenses.bulk.bill')->middleware('can:expenses_update');
        Route::post('bulk-delete', 'ExpenseCustomController@bulkDelete')->name('expenses.bulk.delete')->middleware('can:expenses_delete');
    }
);
