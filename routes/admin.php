<?php 


// Admin
Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login_page');
Route::post('/admin/login', 'Auth\LoginController@login')->name('login');
Route::post('/admin/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin', 'AdminController@show')->name('admin_homepage');
Route::get('/admin/products', 'AdminController@productShow');
Route::get('/admin/product', 'AdminController@productAddForm');
Route::put('/admin/product', 'AdminController@productAdd')->name('product_add')
/*
Route::get('/api/admin/product', 'AdminController@productGet');
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
*/
?>