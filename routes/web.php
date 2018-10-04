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
Route::get('/', '\HappyFeet\Http\Controllers\Frontend\Auth\RegisterController@showRegisterForm')->name('register-show');
Route::post('/', '\HappyFeet\Http\Controllers\Frontend\Auth\RegisterController@verifyForm')->name('register-verify');
Route::get('/register','\HappyFeet\Http\Controllers\Frontend\Auth\RegisterController@wizard')->name('wizard');

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
