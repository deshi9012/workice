<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Creditnotes\Http\Controllers\Api\v1'], function () {
        Route::get('creditnotes/{id}', 'CreditsApiController@show')->name('credits.api.show')->middleware('can:menu_creditnotes');
        Route::get('creditnotes/{id}/items', 'CreditsApiController@items')->name('credits.api.items')->middleware('can:menu_creditnotes');
        Route::get('creditnotes/{id}/comments', 'CreditsApiController@comments')->name('credits.api.comments')->middleware('can:menu_creditnotes');
        Route::get('creditnotes', 'CreditsApiController@index')->name('credits.api.index')->middleware('can:menu_creditnotes');
        Route::post('creditnotes', 'CreditsApiController@save')->name('credits.api.save')->middleware('can:credits_create');
        Route::post('creditnotes/{id}/send', 'CreditsApiController@send')->name('creditnotes.api.send')->middleware('can:credits_send');
        Route::post('creditnotes/use-credits', 'CreditsApiController@useCredits')->name('creditnotes.api.credits')->middleware('can:invoices_update');
        Route::post('creditnotes/delete-credit', 'CreditsApiController@deleteCredit')->name('creditnotes.api.credits.remove')->middleware('can:credits_delete');
        Route::put('creditnotes/{id}', 'CreditsApiController@update')->name('credits.api.update')->middleware('can:credits_update');
        Route::delete('creditnotes/{id}', 'CreditsApiController@delete')->name('credits.api.delete')->middleware('can:credits_delete');
    }
);
