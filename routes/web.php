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

// Products
Route::get('product/{productId}/{platform}', 'ProductController@show');


Route::get('/', 'HomepageController@show');

// Authentication
Auth::routes();

// User
Route::get('user/{username}', 'UserController@show')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$');
Route::get('user/{username}/offers', 'UserController@showOffers')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$');
Route::get('user/purchases', 'UserController@showPurchases');
Route::get('user/reports', 'UserController@showReports');
Route::post('user', 'UserController@update');
Route::delete('user', 'UserController@delete');
Route::delete('user/image', 'UserController@deleteImage');
Route::delete('/user/offer/{idOffer}', 'OfferController@delete');



//Static Pages

Route::get('/home', 'HomeController@index')->name('home');
