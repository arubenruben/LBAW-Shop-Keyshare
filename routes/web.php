<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication
Auth::routes();
Route::get('admin/login', 'Auth\LoginController@showAdmin');
Route::post('admin/login', 'Auth\LoginController@loginAdmin');
Route::get('admin/logout', 'Auth\LoginController@logoutAdmin')->name('logoutAdmin');
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('loginGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

// User
Route::get('user/{username}', 'UserController@show')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$')->name('profile');
Route::get('user/{username}/offers', 'UserController@showOffers')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$');
Route::get('user/purchases', 'UserController@showPurchases');
Route::get('user/reports', 'UserController@showReports');
Route::post('user', 'UserController@update');
Route::delete('user', 'UserController@delete');
Route::delete('user/image', 'UserController@deleteImage')->name('deleteProfilePicture');

// Products
Route::get('/', 'ProductController@home');
Route::get('/search', 'ProductController@search')->name('search');
Route::get('/api/product', 'ProductController@get');
Route::get('/query', 'ProductController@inputSearch')->name('query');
Route::get('/api/product/sort', 'ProductController@sort');
Route::get('product/{productName}/{platformName}', 'ProductController@show')->name('product');

// Cart
Route::get('/cart', 'CartController@show');
Route::put('/cart', 'CartController@add');
Route::delete('/cart/{id}', 'CartController@delete');
Route::get('/cart/checkout', 'CartController@checkout');
Route::put('/cart/checkout', 'CartController@finishCheckout');
Route::get('api/getCartTotalPrice', 'CartController@getCartTotalPrice');


// Offers
Route::get('offer', 'OfferController@show');
Route::put('offer', 'OfferController@add');
Route::get('offer/{id}', 'OfferController@showOffer');
Route::post('offer/{id}', 'OfferController@update');
Route::delete('offer/{id}', 'OfferController@delete');
Route::get('api/offer/{id}/key', 'OfferController@getKeys');
Route::put('offer/{id}/key', 'OfferController@addKey');
Route::get('api/offer/{id}/discount', 'OfferController@getDiscounts');
Route::put('offer/{id}/discount', 'OfferController@addDiscount');


// Discounts
Route::post('/discount/{discountId}', 'DiscountController@update');
Route::delete('/discount/{discountId}', 'DiscountController@delete');

// Keys
Route::post('/key/{keyId}', 'KeyController@update');
Route::delete('/key/{keyId}', 'KeyController@delete');
Route::put('/key/{id}/feedback', 'KeyController@add');
Route::get('/key/{id}/feedback', 'KeyController@view');
Route::put('/key/{KeyId}/report', 'KeyController@report');
Route::get('/api/key/{keyId}', 'KeyController@get');

// Feedback
Route::get('/api/user/{username}/feedback', 'FeedbackController@get');

// Reports
Route::get('/report/{id}', 'ReportController@show');
Route::put('/report/{id}', 'ReportController@message');

// FAQ
Route::get('/faq', 'FAQController@show',['breadcrumbs' => ['Faq' => url("/faq")]]);

// Static
Route::get('/about', function () {
    return view('pages.static.about', ['breadcrumbs' => ['About Us' => url("/about")]]);
});
Route::get('/contact', function () {
    return view('pages.static.contact', ['breadcrumbs' => ['About Us' => url("/about")]]);
});

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