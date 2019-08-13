<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/site', 'Api\SettingsController@index');
Route::resource('/category', 'Api\CategoriesController');
Route::resource('/comment', 'Api\CommentsController');
Route::resource('/link', 'Api\LinksController');
Route::get('/search/{keyword}', 'Api\PostsController@search');
Route::get('/post/recent', 'Api\PostsController@recent');
Route::get('/post/hot', 'Api\PostsController@hot');
Route::resource('/post', 'Api\PostsController');
Route::get('/tag/hot', 'Api\TagsController@hot');
Route::resource('/tag', 'Api\TagsController');
Route::resource('/user', 'Api\UsersController');
