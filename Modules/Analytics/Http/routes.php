<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'analytics', 'namespace' => 'Modules\Analytics\Http\Controllers'],
    function () {
        Route::get('/', 'AnalyticsController@index')->name('reports.index')->middleware('can:menu_reports');
        Route::get('view/{type}', 'AnalyticsController@view')->name('reports.view')->middleware('can:menu_reports');
        Route::post('filter/deals', 'AjaxReportsController@deals')->name('reports.deals.filter')->middleware('can:menu_reports');
        Route::post('filter/leads', 'AjaxReportsController@leads')->name('reports.leads.filter')->middleware('can:menu_reports');
        Route::post('filter/invoices', 'AjaxReportsController@invoices')->name('reports.invoices.filter')->middleware('can:menu_reports');
        Route::post('filter/expenses', 'AjaxReportsController@expenses')->name('reports.expenses.filter')->middleware('can:menu_reports');
        Route::post('filter/payments', 'AjaxReportsController@payments')->name('reports.payments.filter')->middleware('can:menu_reports');
        Route::post('filter/estimates', 'AjaxReportsController@estimates')->name('reports.estimates.filter')->middleware('can:menu_reports');
        Route::post('filter/credits', 'AjaxReportsController@credits')->name('reports.credits.filter')->middleware('can:menu_reports');
        Route::post('filter/projects', 'AjaxReportsController@projects')->name('reports.projects.filter')->middleware('can:menu_reports');
        Route::post('filter/tasks', 'AjaxReportsController@tasks')->name('reports.tasks.filter')->middleware('can:menu_reports');
        Route::post('filter/timesheets', 'AjaxReportsController@timesheets')->name('reports.timesheets.filter')->middleware('can:menu_reports');
        Route::post('filter/tickets', 'AjaxReportsController@tickets')->name('reports.tickets.filter')->middleware('can:menu_reports');
        Route::post('filter/agents', 'AjaxReportsController@agents')->name('reports.agents.filter')->middleware('can:menu_reports');
        Route::post('filter/feedback', 'AjaxReportsController@happiness')->name('reports.happiness.filter')->middleware('can:menu_reports');
    }
);
