<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','Homecontroller@index');
Route::get('/film/{slug_id}','Homecontroller@single') -> name("Single");
Route::get('/filter','Homecontroller@filtermovie');
Route::get('/genre/{genre}','Homecontroller@genremovie');
Route::get('/country/{country}','Homecontroller@countrymovie');
Route::get('/year/{year}','Homecontroller@yearmovie');
Route::get('/popular','Homecontroller@popularmovie');
Route::get('/rating','Homecontroller@ratingmovie');
Route::get('/search','Homecontroller@searchmovie');
Route::get('/featured','Homecontroller@featuredmovie');
Route::get('/latest-upload','Homecontroller@latestuploadmovie');
Route::get('/dmca','Homecontroller@dmcapage');
Route::get('/request','Homecontroller@requestpage');
Route::get('/sitemap','Homecontroller@sitemapgenerate');

Route::get('/allmovie','Homecontroller@allmoviemobile');
Route::get('/filter_mobile','Homecontroller@filteringmoviemobile');

Route::post('/request','Homecontroller@storerequest');

Route::get('/dev-admin', 'Admincontroller@index') -> middleware('authadmin');
Route::get('/dev-admin/dashboard','Admincontroller@allmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/movie','Admincontroller@allmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/new-movie','Admincontroller@newmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/edit-movie/{id}','Admincontroller@editmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/best-movie','Admincontroller@bestmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/coming-soon-movie','Admincontroller@comingsoon') -> middleware('is_admin_login');
Route::get('/dev-admin/destroy/{id}','Admincontroller@destroy') -> middleware('is_admin_login');
Route::get('/dev-admin/logout/','Authcontroller@logout');
Route::get('/dev-admin/store-best-movie/{id}','Admincontroller@storebestmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/delete-best-movie/{id}','Admincontroller@destroybestmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/store-coming-soon-movie/{id}','Admincontroller@storecomingsoonmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/delete-coming-soon-movie/{id}','Admincontroller@destroycomingsoonmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/request-movie','Admincontroller@allrequest') -> middleware('is_admin_login');
Route::get('/dev-admin/open-request-movie/{id}','Admincontroller@openrequestmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/mark-request-movie/{id}','Admincontroller@markrequestmovie') -> middleware('is_admin_login');
Route::get('/dev-admin/delete-request-movie/{id}','Admincontroller@destroyrequestmovie') -> middleware('is_admin_login');

Route::get('/dev-admin/user','Admincontroller@alluser') -> middleware('is_admin_login');
Route::get('/dev-admin/new-user','Admincontroller@newuser') -> middleware('is_admin_login');
Route::get('/dev-admin/edit-user/{id}','Admincontroller@edituser') -> middleware('is_admin_login');
Route::get('/dev-admin/destroy/user/{id}','Admincontroller@destroyuser') -> middleware('is_admin_login');
Route::get('/dev-admin/import','Admincontroller@importmovie') -> middleware('is_admin_login');

Route::get('/dev-admin/social-profiles','Admincontroller@settingsocial') -> middleware('is_admin_login');

Route::post('/dev-admin/login','Authcontroller@login');
Route::post('/dev-admin/bulk-movie','Admincontroller@bulkmovie');
Route::post('/dev-admin/bulk-user','Admincontroller@bulkuser');
Route::post('/dev-admin/post-new-user','Admincontroller@storenewuser') -> middleware('is_admin_login');
Route::post('/dev-admin/post-edit-user/{id}','Admincontroller@updateuser') -> middleware('is_admin_login');
Route::post('/dev-admin/post-new-movie','Admincontroller@storenewmovie') -> middleware('is_admin_login');
Route::post('/dev-admin/post-edit-movie/{id}','Admincontroller@updatemovie') -> middleware('is_admin_login');
Route::post('/dev-admin/post-edit-social-profiles','Admincontroller@updatesocial') -> middleware('is_admin_login');
Route::post('/dev-admin/import','Admincontroller@storeImportMovieData') -> middleware('is_admin_login');

Route::get('/dev-admin/client-sync','Admincontroller@clientsync');