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
Route::get('/', '\HappyFeet\Http\Controllers\Frontend\Auth\RegisterController@showRegisterForm')->name('register-insert-identification');
Route::post('/', '\HappyFeet\Http\Controllers\Frontend\Auth\RegisterController@verifyForm')->name('regiser-verify-identification');
Route::get('/register','\HappyFeet\Http\Controllers\Frontend\Auth\RegisterController@wizard')->name('register-wizard');
Route::post('/register','\HappyFeet\Http\Controllers\Frontend\Auth\RegisterController@processWizard')->name('register-wizard');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
