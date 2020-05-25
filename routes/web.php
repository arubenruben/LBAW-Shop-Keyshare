<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication
Auth::routes();
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
Route::post('/key/{id}', 'KeyController@update');
Route::delete('/key/{id}', 'KeyController@delete');
Route::put('/key/{id}/feedback', 'KeyController@add');
Route::get('/key/{id}/feedback', 'KeyController@view');
Route::put('/key/{id}/report', 'KeyController@report');
Route::get('/api/key/{id}', 'KeyController@get');

// Feedback
Route::get('/api/user/{username}/feedback', 'FeedbackController@get');

// Reports
Route::get('/report/{id}', 'ReportController@show');
Route::put('/report/{id}', 'ReportController@message');

// FAQ
Route::get('/faq', 'FAQController@show');

/*
// Static
Route::get('/about', function () {
    return view('pages.static.about', ['breadcrumbs' => ['About Us' => url("/about")]]);
});

Route::get('/contact', function () {
    return view('pages.static.contact', ['breadcrumbs' => ['Contact Us' => url("/contact")]]);
});*/