<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//REGISTER
// Route::get('/', 'Frontend\Auth\RegisterController@showRegisterForm')->name('register-insert-identification');
// Route::post('/', 'Frontend\Auth\RegisterController@verifyForm')->name('regiser-verify-identification');
// Route::get('/register','Frontend\Auth\RegisterController@wizard')->name('register-wizard');
// Route::post('/register','Frontend\Auth\RegisterController@processWizard')->name('register-wizard');


// Route::get('/home', 'HomeController@index')->name('home');


// Route::prefix('backend')->group(function(){
	// Route::get('/','Backend\Auth\LoginController@showLoginForm')->name('dashboard');
	// Route::post('/login','Backend\Auth\LoginController@login')->name('backend-login');
	// Route::get('/logout','Backend\Auth\LoginController@logout')->name('backend-logout');

	Auth::routes();

	Route::get('/','HomeController@index')->name('home');
	Route::get('/dashboard','HomeController@index')->name('dashboard');


	//modules
	Route::resource('modules','Backend\ModuleController',['except'=>['show']]);
	//Permisos
	Route::resource('permissions','Backend\PermissionController',['except'=>['show']]);
	//Tipos de Permisos
	Route::resource('permission-types','Backend\PermissionTypeController',['except'=>['show']]);
	//Roles
	Route::resource('roles','Backend\RoleController',['except'=>['show']]);

	//Person Type
	Route::resource('ptypes','Backend\PersonTypeController',['except'=>['show']]);

	//Users
	Route::post('users/representants','Backend\UserController@searchRepresentant')->name('users.representants');
	Route::resource('users','Backend\UserController',['except'=>['show']]);

	//Fields
	Route::get('fields/{fieldId}/schedule','Backend\FieldController@getSchedule');
	Route::resource('fields','Backend\FieldController',['except'=>['show']]);

	//Student
	Route::resource('students','Backend\StudentController',['except'=>['show']]);
	
	//Age Ranges
	Route::resource('ageranges','Backend\AgeRangeController',['except'=>['show']]);
	
	//Groups Class
	Route::resource('groupclass','Backend\GroupClassController',['except'=>['show']]);
	Route::resource('fields.groupclass','Backend\GroupClassController',['except'=>['show']]);
	Route::post('groupclass/remove-all','Backend\GroupClassController@removeAllGroupsBySchedule');
	
	//seasons
	Route::resource('seasons','Backend\SeasonController',['except'=>['show']]);

// });

// Route::group(['prefix' => 'admin'], function () {
    // Voyager::routes();
// });
