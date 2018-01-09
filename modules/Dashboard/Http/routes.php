<?php

Route::group([
    'middleware' => 'web',
    'prefix' => 'dashboard',
    'namespace' => 'Modules\Dashboard\Http\Controllers'
], function()
{
    // Global Patterns
    Route::pattern('id', '[0-9]+');
    Route::pattern('_token', '[\w\d]+');
//
//	Route::get('/', 'DashboardController@index');
//
    Route::group(['prefix' => 'surveys'], function () {
        Route::get('{survey_id}/prepare/{order_id?}',
            ['as' => 'dashboard.surveys.prepare', 'uses' => 'SurveysController@prepare']);
        Route::post('{survey_id}/submit/{order_id?}',
            ['as' => 'dashboard.surveys.submit', 'uses' => 'SurveysController@submit']);
    });
    
    
});