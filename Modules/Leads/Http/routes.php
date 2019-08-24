<?php


Route::group([
    'middleware' => 'web',
    'prefix'     => 'leads',
    'namespace'  => 'Modules\Leads\Http\Controllers'
], function () {

    Route::get('/', 'LeadCustomController@index')->name('leads.index')->middleware('can:menu_leads');
    Route::get('/converted', 'LeadCustomController@getConverted')->name('leads.converted');
    Route::get('/create', 'LeadCustomController@create')->name('leads.create')->middleware('can:leads_create');
    Route::patch('/update-stage', 'LeadCustomController@updateStage')->name('leads.update-stage')->middleware('can:leads_update');

    Route::get('/view/{lead}/{tab?}/{option?}', 'LeadCustomController@view')->name('leads.view');
    Route::get('/delete/{lead}', 'LeadCustomController@delete')->name('leads.delete')->middleware('can:leads_delete');

    Route::get('/next-stage/{lead}', 'LeadCustomController@nextStage')->name('leads.nextstage')->middleware('can:leads_update');
    Route::get('/edit/{lead}', 'LeadCustomController@edit')->name('leads.edit')->middleware('can:leads_update');


    Route::post('bulk-edit', 'LeadCustomController@bulkEdit')->name('leads.bulkEdit');
    Route::get('bulk-edit-values', 'LeadCustomController@getEditValues')->name('leads.getEditValues');
    Route::get('all-leads-number', 'LeadCustomController@leadsNumber')->name('leads.leadsAllNumber');

    Route::post('bulk-edit-check', 'LeadCustomController@bulkEditCheck')->name('leads.bulkEditCheck');
    Route::post('bulk-post-edit', 'LeadCustomController@editLeads')->name('leads.postEdit');

    Route::post('bulk-delete', 'LeadCustomController@bulkDelete')->name('leads.bulk.delete')->middleware('can:leads_delete');
    Route::post('bulk-email', 'LeadCustomController@bulkEmail')->name('leads.bulk.email')->middleware('can:leads_update');
    Route::post('bulk-send', 'LeadCustomController@sendBulk')->name('leads.bulk.send');

    Route::get('/import', 'LeadCustomController@import')->name('leads.import')->middleware('can:leads_create');
    Route::get('import/callback', 'LeadCustomController@importGoogleContacts')->name('leads.import.callback')->middleware('can:leads_create');
    Route::get('/export', 'LeadCustomController@export')->name('leads.export')->middleware('can:menu_leads');
    Route::post('csvmap', 'LeadCustomController@parseImport')->name('leads.csvmap')->middleware('can:leads_create');
    Route::post('csvprocess', 'LeadCustomController@processImport')->name('leads.csvprocess')->middleware('can:leads_create');

    Route::get('/data', 'LeadCustomController@tableData')->name('leads.data')->middleware('can:menu_leads');
    Route::get('/data-converted', 'LeadCustomController@tableDataConverted')->name('leads.converted')->middleware('can:menu_leads');

    Route::get('/convert/{lead}', 'LeadCustomController@convert')->name('leads.convert')->middleware('can:deals_create');

    Route::get('/consent/{lead}', 'LeadCustomController@sendConsent')->name('leads.consent')->middleware('can:leads_create');
    Route::get('/consent-accept/{token}', 'LeadConsentController@accept')->name('leads.consent.accept');
    Route::get('/consent-decline/{token}', 'LeadConsentController@decline')->name('leads.consent.decline');

    Route::post('/email-delete', 'LeadCustomController@ajaxDeleteMail')->name('leads.email.delete');
    Route::post('/email/{lead}', 'LeadCustomController@email')->name('leads.email');
    Route::post('/emails/reply', 'LeadCustomController@replyEmail')->name('leads.emailReply');
});
