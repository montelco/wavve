<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/why-us', function(){
			return view('why');
});

Route::get('/dashboard', 'PassesController@dash');
Route::auth();

Route::get('{account_id}/{beacon_id}/{lat},{lon}/payload.json', function(){
	return '74 68 69 72 64 77 61 76 65 2e 6d 65 64 69 61 00 00';
});

/*
 *	Passes Router
 */

Route::group(['middleware' => ['web', 'auth']], function(){

	Route::get('settings', function(){
		return view('account.settings');
	});
	
	Route::group(['prefix' => 'passes'], function() {
		Route::get('editor', function(){
			return view('editor.pass-editor');
		});

		/*
		 *  Create a new pass using a given template.
		 */

		Route::get('editor/{template}', function($template){
			return view('editor.templates.design-'. $template);
		});

		/*
		 *  Edit an existing pass in its given template editor. 
		 */
		
		Route::get('edit-existing/{id}', function(Wavvve\Pass $id){
			if($id->user_id === Auth::user()->id){
				return view('editor.existing.design-'. $id->template_number)->with('targetPass', $id);
			}else{
				return redirect()->route('manage');
			}
		});


		Route::post('/post', 'PassesController@create');
		Route::post('/post/update', 'PassesController@edit');
		Route::get('/post/delete/{id}', 'PassesController@delete');

		Route::get('/activity-feed', 'PassesController@feed');

		Route::get('analytics', function(){
			return view('editor.pass-analytics');
		});
		Route::get('manage', array(
			'as' => 'manage',
			'uses' => 'PassesController@index'
		));
		Route::get('map', function(){
			return view('editor.pass-map');
		});
	});
});

Route::get('/{uuid}', ['uses' => 'PublicAcessController@pubAccess']);