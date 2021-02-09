<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/','PostController@index')->name('home');
Route::get('/contact','ContactController@show')->name('contacts.single');
Route::post('/contact','ContactController@store')->name('contacts.store');
Route::get('/article/{slug}','PostController@show')->name('posts.single');
Route::get('/category/{slug}','CategoryController@show')->name('categories.single');
Route::get('/tag/{slug}','TagController@show')->name('tags.single');
Route::get('/search','SearchController@index')->name('search');
Route::post('/subscription','SubscriptionsController@store')->name('subscription.store');
Route::post('/message','MessageController@store')->name('message.store');



Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'admin'], function (){
    Route::get('/','MainController@index')->name('admin.index');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/tags', 'TagController');
    Route::resource('/posts', 'PostController');
    Route::resource('/subscriptions','SubscriptionController');
    Route::resource('/users','UserController');
    Route::resource('/contacts','ContactController');
});

Route::group(['middleware'=>'guest'], function (){
    Route::get('/register','UserController@create')->name('register.create');
    Route::post('/register','UserController@store')->name('register.store');
    Route::get('/login','UserController@loginForm')->name('login.create');
    Route::post('/login','UserController@login')->name('login');
});

Route::group(['middleware'=>'auth'], function (){
    Route::get('/logout','UserController@logout')->name('logout');
    Route::get('/profile','UserProfile@show')->name('user.profile');
    Route::post('/profile','UserProfile@show')->name('user.profile');
    Route::post('/profile','UserProfile@update')->name('user.update');
});



