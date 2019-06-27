<?php

Route::group(
    ['middleware' => 'auth:api', 'prefix' => 'api/v1', 'namespace' => 'Modules\Leads\Http\Controllers\Api\v1'],
    function () {
        Route::get('leads/{id}/calls', 'LeadsApiController@calls')->name('leads.api.calls')->middleware('can:menu_leads');
        Route::get('leads/{id}/todos', 'LeadsApiController@todos')->name('leads.api.todos')->middleware('can:menu_leads');
        Route::get('leads/{id}/comments', 'LeadsApiController@comments')->name('leads.api.comments')->middleware('can:menu_leads');
        Route::post('leads/{id}/nextstage', 'LeadsApiController@nextStage')->name('leads.api.next.stage')->middleware('can:leads_update');
        Route::post('leads/{id}/movestage', 'LeadsApiController@moveStage')->name('leads.api.movestage')->middleware('can:leads_update');
        Route::post('leads/{id}/convert', 'LeadsApiController@convert')->name('leads.api.convert')->middleware('can:deals_create');
        Route::get('leads', 'LeadsApiController@index')->name('leads.api.index')->middleware('can:menu_leads');
        Route::get('leads/{id}', 'LeadsApiController@show')->name('leads.api.show')->middleware('can:menu_leads');
        Route::post('leads', 'LeadsApiController@save')->name('leads.api.save')->middleware('can:leads_create');
        Route::put('leads/{id}', 'LeadsApiController@update')->name('leads.api.update')->middleware('can:leads_update');
        Route::delete('leads/{id}', 'LeadsApiController@delete')->name('leads.api.delete')->middleware('can:leads_delete');
    }
);
