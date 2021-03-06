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



/*
	LAYOUTS
*/
Route::get('compact',function(){
	session(['layout' => 'compact']);
	return back();
})->name('compact');

Route::get('horizontal',function(){
	session(['layout' => 'compact']);
	return back();
})->name('horizontal');

Route::get('normal',function(){
	session(['layout' => 'normal']);
	return back();
})->name('normal');

Route::get('horizontal',function(){
	session(['layout' => 'horizontal']);
	return back();
})->name('horizontal');

Route::get('color-blue',function(){
	session(['color' => 'blue']);
	return back();
})->name('blue');

Route::get('color-purple',function(){
	session(['color' => 'purple']);
	return back();
})->name('purple');



//LAYOUTS
//Backend
Auth::routes();

Route::get('/','Backend\DashboardController@showDash')->name('home');
Route::prefix('dashboard')->group(function(){
	Route::get('/','Backend\DashboardController@showDash')->name('dashboard');
	Route::get('get-schedules','Backend\DashboardController@loadAssistance');
});


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
Route::resource('fields','Backend\FieldController');

//ftypes
Route::resource('ftypes','Backend\FieldTypeController',['except'=>['show']]);

//Student
Route::resource('students','Backend\StudentController',['except'=>['show']]);

//Age Ranges
Route::resource('ageranges','Backend\AgeRangeController',['except'=>['show']]);

//Groups Class
Route::resource('groupclass','Backend\GroupClassController',['except'=>['show']]);
Route::resource('fields.groupclass','Backend\GroupClassController',['except'=>['show']]);
Route::post('groupclass/remove-all','Backend\GroupClassController@removeAllGroupsBySchedule');

//seasons
Route::get('seasons/get-current-duration-season','Backend\SeasonController@getDurationSeason');
Route::resource('seasons','Backend\SeasonController',['except'=>['show']]);

//Assitance
Route::resource('assistances','Backend\AssistanceController',['except'=>['show','create','edit','update']]);

//Coachs
Route::resource('coachs','Backend\CoachController',['except' => ['show']]);
Route::get('coachs-assistances/schedule','Backend\AssistanceCoachController@loadDaysMonth');
Route::resource('coachs-assistances','Backend\AssistanceCoachController',['only'=>['index','store','update']]);

