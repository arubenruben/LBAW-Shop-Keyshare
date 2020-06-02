<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication
Auth::routes();
Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('loginGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

// User
Route::get('user/purchases', 'UserController@showPurchases')->name('userPurchases');
Route::get('user/reports', 'UserController@showReports')->name('userReports');
Route::delete('user/image', 'UserController@deleteImage')->name('deleteProfilePicture');
Route::put('user/appeal', 'BanAppealController@appeal')->name('appeal');
Route::get('user/{username}', 'UserController@show')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$')->name('profile');
Route::get('user/{username}/offers', 'UserController@showOffers')->where('username', '^(?!(reports|purchases)$)[a-z A-Z0-9\s]+$')->name('userOffers');
Route::post('user', 'UserController@update');
Route::delete('user', 'UserController@delete');

// Products
Route::get('/', 'ProductController@home')->name('home');                                       // Homepage
Route::get('/search', 'ProductController@search')->name('search');                             // Products list
Route::get('/api/product', 'ProductController@get');                                                 // Products list
Route::get('/api/product/sort', 'ProductController@sort');                                           // Products list
Route::get('product/{productName}/{platformName}', 'ProductController@show')->name('product'); // Products page

// Cart
Route::get('/cart', 'CartController@show')->name('showCart');
Route::put('/cart', 'CartController@add');
Route::get('/cart/checkout', 'CartController@checkout')->name('checkoutInit');
Route::put('/cart/checkout', 'CartController@finishCheckout');
Route::get('api/getCartTotalPrice', 'CartController@getCartTotalPrice');
Route::delete('/cart/{id}', 'CartController@delete');

// Offers
Route::get('offer', 'OfferController@show');
Route::put('offer', 'OfferController@add')->name('addOffer');
Route::get('offer/{id}', 'OfferController@showOffer');
Route::post('offer/{id}', 'OfferController@update')->name('editOffer');
Route::delete('offer/{id}', 'OfferController@delete')->name('deleteOffer');
Route::get('api/offer/{id}/key', 'OfferController@getKeys');
Route::put('offer/{id}/key', 'OfferController@addKey');
Route::get('api/offer/{id}/discount', 'OfferController@getDiscounts');
Route::put('offer/{id}/discount', 'OfferController@addDiscount');

// Discounts
Route::post('/discount/{discountId}', 'DiscountController@update');
Route::delete('/discount/{discountId}', 'DiscountController@delete');

// Keys
Route::post('/key/{id}', 'KeyController@update')->name('keyUpdate');
Route::delete('/key/{id}', 'KeyController@delete')->name('keyDelete');
Route::get('/api/key/{id}', 'KeyController@get')->name('key');
Route::put('/key/{id}/feedback', 'KeyController@feedback');
Route::get('/key/{id}/feedback', 'KeyController@view')->name('feedback');
Route::put('/key/{id}/report', 'KeyController@report')->name('report');

// Feedback
Route::get('/api/user/{username}/feedback', 'FeedbackController@get');

// Reports
Route::get('/report/{id}', 'ReportController@show')->name('showReport');

// FAQ
Route::get('/faq', 'FAQController@show')->name('faq');

// Static
Route::get('/about', function () {
    return view('pages.static.about', ['breadcrumbs' => ['About Us' => url("/about")]]);
})->name('about');

Route::get('/contact', function () {
    return view('pages.static.contact', ['breadcrumbs' => ['Contact Us' => url("/contact")]]);
})->name('contact');