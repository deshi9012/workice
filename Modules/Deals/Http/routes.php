<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'deals', 'namespace' => 'Modules\Deals\Http\Controllers'],
    function () {
        Route::get('/', 'DealCustomController@index')->name('deals.index')->middleware('can:menu_deals');
        Route::get('data', 'DealCustomController@tableData')->name('deals.data')->middleware('can:menu_deals');
        Route::get('/view/{deal}/{tab?}/{option?}', 'DealCustomController@view')->name('deals.view')->middleware('can:menu_deals');

        Route::get('/export', 'DealCustomController@export')->name('deals.export')->middleware('can:deals_create');

        Route::get('/import', 'DealCustomController@import')->name('deals.import')->middleware('can:deals_create');
        Route::post('csvmap', 'DealCustomController@parseImport')->name('deals.csvmap')->middleware('can:deals_create');
        Route::post('csvprocess', 'DealCustomController@processImport')->name('deals.csvprocess')->middleware('can:deals_create');

        Route::get('create', 'DealCustomController@create')->name('deals.create')->middleware('can:deals_create');

        Route::get('delete/{deal}', 'DealCustomController@delete')->name('deals.delete')->middleware('can:deals_delete');
        Route::post('bulk-delete', 'DealCustomController@bulkDelete')->name('deals.bulk.delete')->middleware('can:deals_delete');

        Route::get('edit/{deal}', 'DealCustomController@edit')->name('deals.edit')->middleware('can:deals_update');
        Route::get('/lost/{deal}', 'DealCustomController@lost')->name('deals.lost')->middleware('can:deals_update');

        Route::get('/won/{deal}', 'DealCustomController@win')->name('deals.win')->middleware('can:deals_update');
        Route::get('/open/{deal}', 'DealCustomController@open')->name('deals.open')->middleware('can:deals_update');

        Route::post('/ajaxstages', 'SetupCustomController@ajaxStages')->name('deals.ajaxStages');
        Route::post('/move-stage', 'SetupCustomController@moveStage')->name('deals.movestage')->middleware('can:deals_update');
    }
);
