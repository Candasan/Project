<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('menu', function () {
    return view('menu');
});

Route::get('masuk', function () {
    return view('masuk');
});

Route::get('daftar', function () {
    return view('daftar');
});

Route::get('/tambah-blog', 'BlogController@tambahblog');

Route::get('/data-blog', 'BlogController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
