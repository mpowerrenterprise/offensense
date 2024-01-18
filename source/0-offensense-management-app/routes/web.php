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

Route::get('/',"MainController@viewAuthentication");

Route::post('/login',"MainController@loginProcess")->name('login');

Route::get('/logout',"MainController@logoutProcess")->name('logout');

Route::get('/dashboard',"MainController@viewDashbard");

Route::get('/dataset',"MainController@viewDataset");

Route::get('/delete_word/{autoid}',"MainController@deleteWord");

Route::get('/add_word/{word}',"MainController@addWord");

