<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});*/

Route::group(['middleware' => 'api'], function() {
	// 認証が不要
	Route::post('authenticate',  'AuthenticateController@authenticate');
	Route::post('register', 'AuthenticateController@register');
	Route::get('schedule', 'ScheduleController@list');
	// 認証が必要
	Route::group(['middleware' => 'jwt.auth'], function() {
		Route::get('me',  'AuthenticateController@getCurrentUser');
		Route::post('ics/register', 'IcsController@register');
		Route::get('ics/get', 'IcsController@get');
	});

});
