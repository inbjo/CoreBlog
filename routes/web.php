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
Route::get('sitemap.xml', 'PagesController@sitemap')->name('sitemap');
Route::get('rss.xml', 'PagesController@rss')->name('rss');

Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/create', 'PostController@store');
Route::get('/post/{post}', 'PostController@show')->name('post.show');


Route::get('/at','UserController@at')->name('users.at');

Route::get('/user/{user}', 'UserController@show')->name('user.show'); //用户发表的文章

Route::get('/tag/{tag}', 'TagController@show')->name('tag.show'); //标签聚合
Route::get('/tags', 'TagController@index')->name('tags'); //标签云

Route::get('/category/{category}', 'CategoryController@show')->name('category.show'); //分类目录


Route::get('/search/{keyword}', 'PagesController@search')->name('search'); //搜索页面

Auth::routes(['verify' => true]);


Route::resource('comments','CommentsController',['only'=>['store','destroy']])->middleware('auth');


