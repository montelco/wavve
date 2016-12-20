<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/why-us', function () {
    return view('why');
});

Route::get('/what', function () {
    return view('what');
});

Route::get('/dashboard', 'PassesController@dash');

Route::get('/business/{username}/', 'PublicAcessController@getWalletCompiledPass');

Route::get('{account_id}/{beacon_id}/{lat},{lon}/payload.json', 'PublicAcessController@fetchBeaconPayload');

Route::get('/{user_id}/{hardware_id}/{lat},{lon}/payload.json', 'PublicAcessController@fetchBeaconPayload');

/*
 *	Passes Router
 */

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('settings', function () {
        return view('account.settings');
    });

    Route::get('help', function () {
        return view('editor.pass-help');
    });

    Route::group(['prefix' => 'passes'], function () {
        Route::get('/activity-feed', 'PassesController@feed');

        Route::get('analytics', 'PassesController@analytics');

        Route::get('graphic', 'PassesController@displayAreaChart');

        Route::get('all', 'PassesController@displayTotalsforPasses');

        /*
         *  Edit an existing pass in its given template editor.
         */

        Route::get('edit-existing/{id}', function (Wavvve\Pass $id) {
            if ($id->user_id === Auth::user()->id) {
                return view('editor.existing.design-'.$id->template_number)->with('targetPass', $id);
            } else {
                return redirect()->route('manage');
            }
        });

        Route::get('editor', function () {
            return view('editor.pass-editor');
        });

        /*
         *  Create a new pass using a given template.
         */

        Route::get('editor/{template}', function ($template) {
            return view('editor.templates.design-'.$template);
        });

        Route::get('manage', 'PassesController@index');

        Route::get('map', function () {
            return view('editor.pass-map');
        });

        Route::post('/post', 'PassesController@create');
        Route::post('/post/update', 'PassesController@edit');
        Route::get('/post/delete/{id}', 'PassesController@delete');

        Route::get('/publish/{id}', 'PassesController@getPublish');
        Route::post('/publish/{id}', 'PassesController@setPublish');

        Route::get('scheduler', 'PassesController@index');

        Route::get('website', 'UsersController@getWebsite');
    });
});

Route::get('/{uuid}', ['uses' => 'PublicAcessController@pubAccess']);