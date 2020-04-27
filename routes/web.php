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

// Authentication
Route::get('login', 'Auth\LoginController@show');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@show');
Route::put('register', 'Auth\RegisterController@register');
Route::get('admin/login', 'Auth\LoginController@showAdmin');
Route::post('admin/login', 'Auth\LoginController@loginAdmin');
Route::get('admin/logout', 'Auth\LoginController@logoutAdmin')->name('logoutAdmin');

// User
Route::get('user/{username}', 'UserController@show')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$');
Route::get('user/{username}/offers', 'UserController@showOffers')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$');
Route::get('user/purchases', 'UserController@showPurchases');
Route::get('user/reports', 'UserController@showReports');
Route::post('user', 'UserController@update');
Route::delete('user', 'UserController@delete');
Route::delete('user/image', 'UserController@deleteImage');
Route::get('/api/admin/user', 'UserController@adminGet');
Route::get('/admin/user', 'UserController@adminShow');
Route::post('/admin/user/{id}', 'UserController@adminUpdate');

// Products
Route::get('/', 'HomepageController@show'); //TODO: passar para ProductController
Route::get('/search', 'ProductController@explore');
Route::get('/api/product', 'ProductController@get');
Route::get('/product/{id}/{platform}', 'ProductController@show');
Route::get('/api/product/{id}/{platform}/offers', 'ProductController@offers');
Route::get('/admin/product', 'ProductController@adminShow');
Route::put('/admin/product', 'ProductController@adminAdd');
Route::get('/api/admin/product', 'ProductController@adminGet');
Route::get('/admin/product/form', 'ProductController@adminForm');
Route::get('/admin/product/{id}', 'ProductController@adminUpdateView');
Route::post('/admin/product/{id}', 'ProductController@adminUpdate');
Route::delete('/admin/product/{id}', 'ProductController@adminDelete');

// Categories
Route::get('/api/admin/category', 'CategoryController@adminGet');
Route::get('/admin/category', 'CategoryController@adminShow');
Route::put('/admin/category', 'CategoryController@adminAdd');
Route::post('/admin/category/{id}', 'CategoryController@adminUpdate');
Route::delete('/admin/category/{id}', 'CategoryController@adminDelete');

// Genres
Route::get('/api/admin/genre', 'GenreController@adminGet');
Route::get('/admin/genre', 'GenreController@adminShow');
Route::put('/admin/genre', 'GenreController@adminAdd');
Route::post('/admin/genre/{id}', 'GenreController@adminUpdate');
Route::delete('/admin/genre/{id}', 'GenreController@adminDelete');

// Platforms
Route::get('/api/admin/platform', 'PlatformController@adminGet');
Route::get('/admin/platform', 'PlatformController@adminShow');
Route::put('/admin/platform', 'PlatformController@adminAdd');
Route::post('/admin/platform/{id}', 'PlatformController@adminUpdate');
Route::delete('/admin/platform/{id}', 'PlatformController@adminDelete');

// Cart
Route::get('/cart', 'CartController@show');
Route::put('/cart', 'CartController@add');
Route::delete('/cart/{id}', 'CartController@delete');
Route::get('/cart/checkout', 'CartController@showProduct');
Route::put('/cart/checkout', 'CartController@offers');

// Offers
Route::get('/offer', 'OfferController@show');
Route::put('/offer', 'OfferController@add');
Route::get('/offer/{id}', 'OfferController@showOffer');
Route::post('/offer/{id}', 'OfferController@update');
Route::delete('/offer/{id}', 'OfferController@delete');

// Discounts
Route::get('/api/offer/{id}/discount', 'DiscountController@get');
Route::put('/offer/{id}/discount', 'DiscountController@add');
Route::post('/offer/{offerId}/discount/{discountId}', 'DiscountController@update');
Route::delete('/offer/{offerId}/discount/{discountId}', 'DiscountController@delete');

// Keys
Route::get('/api/offer/{id}/key', 'KeyController@get');
Route::put('/offer/{id}/key', 'KeyController@add');
Route::post('/offer/{offerId}/key/{keyId}', 'KeyController@update');
Route::delete('/offer/{offerId}/key/{keyId}', 'KeyController@delete');
Route::put('/key/{id}/feedback', 'KeyController@feedback');
Route::put('/key/{id}/report', 'KeyController@report');

// Feedback
Route::get('/api/user/{username}/feedback', 'FeedbackController@get');
Route::get('/api/admin/feedback', 'FeedbackController@adminGet');
Route::get('/admin/feedback', 'FeedbackController@adminShow');
Route::delete('/admin/feedback/{id}', 'FeedbackController@adminDelete');

// Reports
Route::get('/report/{id}', 'ReportController@show');
Route::put('/report/{id}', 'ReportController@message');
Route::get('/api/admin/report', 'ReportController@adminGet');
Route::get('/admin/report', 'ReportController@adminShow');
Route::get('/admin/report/{id}', 'ReportController@showAdmin');
Route::put('/admin/report/{id}', 'ReportController@messageAdmin');

// Transactions
Route::get('/api/admin/transaction', 'TransactionController@adminGet');
Route::get('/admin/transaction', 'TransactionController@adminShow');

// Admin
Route::get('/admin', 'AdminController@show');

// FAQ
Route::get('/faq', 'FAQController@show');
Route::get('/api/admin/faq', 'FAQController@adminGet');
Route::get('/admin/faq', 'FAQController@adminShow');
Route::put('/admin/faq', 'FAQController@adminAdd');
Route::post('/admin/faq/{id}', 'FAQController@adminUpdate');
Route::delete('/admin/faq/{id}', 'FAQController@adminDelete');
