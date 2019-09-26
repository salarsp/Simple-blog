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

use Illuminate\Support\Facades\Route;

Route::get('/', 'MainController@index');

Route::resource('posts', 'PostController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Single post route
Route::get('/post/{id}', 'MainController@post');
//Admin panel
Route::get('/admin', 'MainController@admin')->middleware(['auth','admin'])->name('admin');
Route::resource('admin/posts', 'PostController')->middleware(['auth','admin']);
Route::resource('admin/comments', 'CommentController')->middleware(['auth','admin']);
// Adding Comment
Route::post('/send-comment', 'MainController@add')->middleware('auth')->name('new_comment');
