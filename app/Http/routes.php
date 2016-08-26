<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/why-us', function () {
    return view('why');
});

Route::get('/dashboard', 'PassesController@dash');

// Route::get('/testing', function(){
//     $data = [
//         'title' => 'Testing 1,2,3',
//         'content' => 'This is a test email to ensure that mail can be sent through the Laravel application.'
//     ];
//     Mail::send('emails.sample', $data, function($message)
//     {
//         $message->to('cmonteleoneh@gmail.com', 'Cory')->subject('Testing 1,2,3');
//     });
//     return dd();
// });


Route::get('/{user_id}/{hardware_id}/{lat},{lon}/payload.json', 'PublicAcessController@fetchBeaconPayload');


/*
 *	Passes Router
 */

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('settings', function () {
        return view('account.settings');
    });

    Route::group(['prefix' => 'passes'], function () {
        Route::get('editor', function () {
            return view('editor.pass-editor');
        });

        /*
         *  Create a new pass using a given template.
         */

        Route::get('editor/{template}', function ($template) {
            return view('editor.templates.design-'.$template);
        });

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


        Route::post('/post', 'PassesController@create');
        Route::post('/post/update', 'PassesController@edit');
        Route::get('/post/delete/{id}', 'PassesController@delete');


        Route::get('/activity-feed', 'PassesController@feed');

        Route::get('analytics', function () {
            return view('editor.pass-analytics');
        });
        Route::get('manage', [
            'as' => 'manage',
            'uses' => 'PassesController@index',
        ]);
        Route::get('map', function () {
            return view('editor.pass-map');
        });
    });
});

Route::get('/{uuid}', ['uses' => 'PublicAcessController@pubAccess']);
