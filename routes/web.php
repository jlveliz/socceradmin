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
Route::get('/', 'Frontend\Auth\RegisterController@showRegisterForm')->name('register-insert-identification');
Route::post('/', 'Frontend\Auth\RegisterController@verifyForm')->name('regiser-verify-identification');
Route::get('/register','Frontend\Auth\RegisterController@wizard')->name('register-wizard');
Route::post('/register','Frontend\Auth\RegisterController@processWizard')->name('register-wizard');


Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('backend')->group(function(){
	Route::get('/','Backend\Auth\LoginController@showLoginForm');
	Route::post('/login','Backend\Auth\LoginController@login')->name('backend-login');

	Route::get('/dashboard','Backend\Dashboard\DashboardController@showDash');
});