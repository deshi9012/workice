<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'items', 'namespace' => 'Modules\Items\Http\Controllers'],
    function () {
        Route::get('/', 'ItemCustomController@index')->name('items.index')->middleware('can:menu_items');
        Route::get('create', 'ItemCustomController@create')->name('items.create')->middleware('can:menu_items');
        Route::get('edit/{item}', 'ItemCustomController@edit')->name('items.edit')->middleware('can:menu_items');
        Route::get('delete/{item}', 'ItemCustomController@delete')->name('items.delete')->middleware('can:menu_items');
        Route::post('autoitems', 'ItemCustomController@autoitems')->name('items.autoitems');
        Route::post('autoitem', 'ItemCustomController@autoitem')->name('items.autoitem');
        Route::post('fromtemplate', 'ItemCustomController@fromTemplate')->name('items.fromtemplate');
        Route::get('insert/{id}/{module}', 'ItemCustomController@insert')->name('items.insert')->middleware('can:menu_items');
        Route::get('expenses/{invoice}', 'ItemCustomController@expenses')->name('items.expenses')->middleware('can:menu_items');
        Route::get('export/{module}', 'ItemCustomController@export')->name('items.export')->middleware('can:menu_items');
        Route::post('bill/expenses', 'ItemCustomController@billExpenses')->name('items.bill.expenses');
        Route::post('reorder', 'ItemCustomController@reOrder')->name('items.reorder')->middleware('can:menu_items');
    }
);
