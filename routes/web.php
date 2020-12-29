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

Route::get('/', 'App\Http\Controllers\WelcomeController@index');
Route::get('/login', 'App\Http\Controllers\WelcomeController@login');
Route::get('/register', 'App\Http\Controllers\WelcomeController@register');
Route::post('/do-register', 'App\Http\Controllers\WelcomeController@do_register');
Route::post('/do-login', 'App\Http\Controllers\WelcomeController@do_login');
Route::get('/do-logout', 'App\Http\Controllers\WelcomeController@do_logout');

Route::get('/login-admin', 'App\Http\Controllers\WelcomeController@login_admin');
Route::post('/do-login-admin', 'App\Http\Controllers\WelcomeController@do_login_admin');

Route::group(['prefix'=>'forum'], function(){
	Route::get('/', 'App\Http\Controllers\ForumController@forum');
	Route::get('/topic/{id}', 'App\Http\Controllers\ForumController@topic');
	Route::post('/reply', 'App\Http\Controllers\ForumController@reply');
	Route::post('/create', 'App\Http\Controllers\ForumController@create');
});

Route::group(['prefix'=>'shop'], function(){
	Route::get('/', 'App\Http\Controllers\ShopController@index');
	Route::get('/payment/{id}', 'App\Http\Controllers\ShopController@payment');
	Route::post('/purchase', 'App\Http\Controllers\ShopController@purchase');
});

Route::group(['prefix'=>'rent'], function(){
	Route::get('/', 'App\Http\Controllers\RentController@index');
	Route::post('/do-rent', 'App\Http\Controllers\RentController@do_rent');
	Route::post('/purchase', 'App\Http\Controllers\RentController@purchase');
});

Route::group(['prefix'=>'admin'], function(){
	Route::get('/', 'App\Http\Controllers\AdminController@index');
	Route::get('/rent/set-status/{status}/{id}', 'App\Http\Controllers\AdminController@set_status');
	Route::post('/rent/approved', 'App\Http\Controllers\AdminController@approved');
});
