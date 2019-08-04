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

// Route::prefix('api',function() {
    
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login','ApiController@login');

Route::get('/ages','ApiController@getAgesRange');
Route::get('/fields/{ageId}/available','ApiController@getFields');

Route::get('groups/{fieldId}/available-schedule','ApiController@getAvailableDayField');
Route::get('groups/{fieldId}/available-hour','ApiController@getAvailableHourDay');
Route::post('register','ApiController@process')->name('register-user-post');

