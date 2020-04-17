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

Route::get('/', 'Auth\LoginController@home');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::put('register', 'Auth\RegisterController@register');

// User
Route::get('user/{id}', 'UserController@show');
Route::delete('user/{id}', 'UserController@delete');
Route::get('user/{id}/purchase', 'UserController@showPurchases');
Route::get('user/{id}/offer', 'UserController@showOffers');
Route::get('user/{id}/report', 'UserController@showReports');
Route::post('user/{id}/description', 'UserController@updateDescription');
Route::post('user/{id}/password', 'UserController@updatePassword');
Route::post('user/{id}/image', 'UserController@updateImage');
Route::delete('user/{id}/image', 'UserController@deleteImage');
Route::post('user/{id}/email', 'UserController@updateEmail');
Route::post('user/{id}/paypal', 'UserController@updatePayPal');

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

