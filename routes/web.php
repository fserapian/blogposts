<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/secret', 'HomeController@secret')
    ->name('secret')
    ->middleware('can:home.secret');

Route::get('/', 'HomeController@home')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::resource('posts', 'PostController');

Route::post('/posts/{post}/comments', 'PostCommentController@store')
    ->name('posts.comments.store');

Route::get('/posts/tag/{tag}', 'PostTagController@index')->name('posts.tags.index');

Auth::routes();
