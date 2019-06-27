<?php

Route::group(
    ['middleware' => ['web', 'installed'], 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function () {
        Route::get('/{dashboard?}', 'HomeController@index')->name('dashboard.index');
    }
);
