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

Route::get('/',"Main_Controller@Index_Function");

Route::get('/dataset',"Main_Controller@Word_Dataset");

Route::get('/delete_word/{auto_id}',"Main_Controller@DeleteWord");

Route::get('/add_word/{word}',"Main_Controller@AddWord");

