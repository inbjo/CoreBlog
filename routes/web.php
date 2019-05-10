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

Route::get('/', 'PagesController@index')->name('index');


Route::get('/post/{post}/{slug?}', 'FrontController@post')->name('post.show');
Route::get('/post/create', 'FrontController@create')->name('post.create');
Route::get('/at','FrontController@at')->name('users.at');
Route::get('/author/{user}', 'FrontController@author')->name('author.show');
Route::get('/tag/{tag}', 'FrontController@tag')->name('tag.show');
Route::get('/category/{category}', 'FrontController@category')->name('category.show');
Route::get('/tags', 'FrontController@tags')->name('tags');
Route::get('/search/{keyword}', 'FrontController@search')->name('search');

Auth::routes(['verify' => true]);


