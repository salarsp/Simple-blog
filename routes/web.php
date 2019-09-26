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

Route::get('/', 'MainController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Single post route
Route::get('/post/{id}', 'MainController@post');
// Adding Comment
Route::get('/send-comment', 'MainController@add')->middleware('auth')->name('new_comment');
