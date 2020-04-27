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

// Products
Route::get('/', 'HomepageController@show'); //TODO: passar para ProductController
Route::get('/', 'ProductController@home');
Route::get('/search', 'ProductController@explore');
Route::get('/api/product', 'ProductController@get');
Route::get('/product/{id}/{platform}', 'ProductController@show');
Route::get('/api/product/{id}/{platform}/offers', 'ProductController@offers');

// Cart
Route::get('/cart', 'CartController@show');
Route::put('/cart', 'CartController@add');
Route::delete('/cart/{id}', 'CartController@delete');
Route::get('/cart/checkout', 'CartController@checkout');
Route::put('/cart/checkout', 'CartController@finalizeCheckout');

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
Route::post('/key/{keyId}', 'KeyController@update');
Route::delete('/key/{keyId}', 'KeyController@delete');
Route::put('/key/{id}/feedback', 'KeyController@feedback');
Route::put('/key/{id}/report', 'KeyController@report');

// Feedback
Route::get('/api/user/{username}/feedback', 'FeedbackController@get');

// Reports
Route::get('/report/{id}', 'ReportController@show');
Route::put('/report/{id}', 'ReportController@message');

// FAQ
Route::get('/faq', 'FAQController@show');

// Admin
Route::get('/admin', 'AdminController@show');
Route::get('/admin/product', 'AdminController@productShow');
Route::put('/admin/product', 'AdminController@productAdd');
Route::get('/api/admin/product', 'AdminController@productGet');
Route::get('/admin/product/form', 'AdminController@productForm');
Route::get('/admin/product/{id}', 'AdminController@productUpdateView');
Route::post('/admin/product/{id}', 'AdminController@productUpdate');
Route::delete('/admin/product/{id}', 'AdminController@productDelete');
Route::get('/api/admin/category', 'AdminController@categoryGet');
Route::get('/admin/category', 'AdminController@categoryShow');
Route::put('/admin/category', 'AdminController@categoryAdd');
Route::post('/admin/category/{id}', 'AdminController@categoryUpdate');
Route::delete('/admin/category/{id}', 'AdminController@categoryDelete');
Route::get('/api/admin/genre', 'AdminController@genreGet');
Route::get('/admin/genre', 'AdminController@genreShow');
Route::put('/admin/genre', 'AdminController@genreAdd');
Route::post('/admin/genre/{id}', 'AdminController@genreUpdate');
Route::delete('/admin/genre/{id}', 'AdminController@genreDelete');
Route::get('/api/admin/platform', 'AdminController@platformGet');
Route::get('/admin/platform', 'AdminController@platformShow');
Route::put('/admin/platform', 'AdminController@platformAdd');
Route::post('/admin/platform/{id}', 'AdminController@platformUpdate');
Route::delete('/admin/platform/{id}', 'AdminController@platformDelete');
Route::get('/api/admin/user', 'AdminController@userGet');
Route::get('/admin/user', 'AdminController@userShow');
Route::post('/admin/user/{id}', 'AdminController@userUpdate');
Route::get('/api/admin/report', 'AdminController@reportGet');
Route::get('/admin/report', 'AdminController@reportShow');
Route::get('/admin/report/{id}', 'AdminController@reportShowMessages');
Route::put('/admin/report/{id}', 'AdminController@reportMessage');
Route::get('/api/admin/transaction', 'AdminController@transactionGet');
Route::get('/admin/transaction', 'AdminController@transactionShow');
Route::get('/api/admin/feedback', 'AdminController@feedbackGet');
Route::get('/admin/feedback', 'AdminController@feedbackShow');
Route::delete('/admin/feedback/{id}', 'AdminController@feedbackDelete');
Route::get('/api/admin/faq', 'AdminController@faqGet');
Route::get('/admin/faq', 'AdminController@faqShow');
Route::put('/admin/faq', 'AdminController@faqAdd');
Route::post('/admin/faq/{id}', 'AdminController@faqUpdate');
Route::delete('/admin/faq/{id}', 'AdminController@faqDelete');
