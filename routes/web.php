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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', 'PostController@index')->name('posts.home');
// Route::get('/post', 'PostController@show')->name('post.show');
Route::resource('post','PostController');
Route::resource('comment','CommentController');

Auth::routes();


Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts','PostController');
});
