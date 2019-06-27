<?php

Route::group(
    ['middleware' => 'web', 'prefix' => 'teams', 'namespace' => 'Modules\Teams\Http\Controllers'],
    function () {
        Route::get('remove/{project}/{member}', 'TeamsController@remove')->name('teams.remove')->middleware('can:menu_projects');
        Route::get('manager/{project}/{member}', 'TeamsController@manager')->name('teams.manager')->middleware('can:projects_update');
        Route::post('detach', 'TeamsController@detach')->name('teams.detach');
    }
);
