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

Route::get('/', 'PostsController@index')->name('index');
Route::get('manifest.json', 'PagesController@manifest');
Route::get('sitemap.xml', 'PagesController@sitemap')->name('sitemap');
Route::get('feed', 'PagesController@feed')->name('feed');

Route::get('/tag/{tag}', 'TagsController@show')->name('tag.show');
Route::get('/tags', 'TagsController@index')->name('tags');
Route::resource('category', 'CategoriesController');
Route::patch('/post/restore', 'PostsController@restore')->name('post.restore');
Route::post('/post/{post}/unlock', 'PostsController@unlock')->name('post.unlock');
Route::resource('post', 'PostsController');
Route::resource('comment', 'CommentsController', ['only' => ['store', 'destroy']])->middleware('auth');
Route::post('/favorites/comment/{comment}', 'FavoritesController@comment');
Route::post('/favorites/post/{post}', 'FavoritesController@post');
Route::post('/subscribe', 'SubscribesController@store');
Route::get('/search/{keyword}', 'PostsController@search')->name('post.search');

Route::get('upload', 'FilesController@index')->name('upload.index');
Route::post('upload', 'FilesController@store')->name('upload.store');
Route::delete('upload', 'FilesController@destroy')->name('upload.destroy');

Auth::routes(['verify' => true]);
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
Route::post('/at', 'UsersController@index');
Route::get('/user/{user}', 'UsersController@show')->name('user.show');
Route::get('/user/{user}/edit', 'UsersController@edit')->name('user.edit');
Route::put('/user/{user}/edit', 'UsersController@update')->name('user.update');
Route::match(['get', 'put'], '/user/{user}/avatar', 'UsersController@avatar')->name('user.avatar');
Route::match(['get', 'put'], '/user/{user}/password', 'UsersController@password')->name('user.password');
Route::match(['get', 'put'], '/user/{user}/binding', 'UsersController@binding')->name('user.binding');
Route::match(['get', 'put'], '/user/{user}/paycode', 'UsersController@paycode')->name('user.paycode');

Route::resource('link', 'LinksController');
Route::get('setting', 'SettingsController@index')->name('setting.index');
Route::put('setting', 'SettingsController@update')->name('setting.update');
Route::get('/posts', 'PostsController@list')->name('post.manage');
Route::get('clear', 'SettingsController@clear')->name('setting.clear');

Route::post('pay/alipay/create', 'Pay\AlipayController@create');
Route::get('pay/alipay/return', 'Pay\AlipayController@return');
Route::post('pay/alipay/notify', 'Pay\AlipayController@notify');
Route::get('pay/alipay/{order}', 'Pay\AlipayController@pay');
Route::post('pay/wechat/pay', 'Pay\WechatController@pay');
Route::post('pay/wechat/notify', 'Pay\WechatController@notify');
