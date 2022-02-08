<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Route::get('/home', 'Homecontroller@index')->name('home');

Route::get('/ ', 'GuestController@home')->name('home');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/posts', 'HomeController@posts') ->name('posts');

Route::get('/post/create', 'HomeController@create') ->name('create');
Route::post('/post/store', 'HomeController@store') ->name('store');
