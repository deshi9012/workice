<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'extras', 'namespace' => 'Modules\Extras\Http\Controllers'], function () {
        Route::post('canned-message', 'ExtrasController@cannedMessage')->name('extras.canned_responses');
        Route::get('user-templates', 'ExtrasController@userTemplates')->name('extras.user.templates');
        Route::get('response-edit/{message}', 'ExtrasController@editResponse')->name('extras.edit.response');

        Route::get('clause-edit/{clause}', 'ExtrasController@editClause')->name('extras.edit.clause');
        Route::get('vault/create/{module}/{id}', 'VaultController@create')->name('extras.vaults.create');
    
        Route::get('vault/edit/{id}', 'VaultController@edit')->name('extras.vaults.edit');
        Route::get('vault/delete/{id}', 'VaultController@delete')->name('extras.vaults.delete');

        Route::get('edit-call/{call}', 'CallController@edit')->name('extras.call.edit');
        Route::get('create-call/{module}/{id}', 'CallController@create')->name('extras.call.create');
    }
);
