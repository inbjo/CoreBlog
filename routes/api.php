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
$api = app('Dingo\Api\Routing\Router');


$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['bindings']
], function ($api) {

    $api->post('register', 'AuthorizationsController@register');
    $api->post('login', 'AuthorizationsController@login');
    $api->put('token', 'AuthorizationsController@update');
    $api->delete('token', 'AuthorizationsController@destroy');
    $api->post('reset', 'AuthorizationsController@reset');

    $api->group(['middleware' => 'api.auth'], function ($api) {
        // 当前登录用户信息
        $api->get('userinfo', 'AuthorizationsController@userinfo');
    });

    $api->get('/site', 'SettingsController@index');
    $api->get('/category', 'CategoriesController@index');
    $api->get('/category/{category}', 'CategoriesController@show');
    $api->get('/link', 'LinksController@index');
    $api->get('/search/{keyword}', 'PostsController@search');
    $api->get('/post/recent', 'PostsController@recent');
    $api->get('/post/hot', 'PostsController@hot');
    $api->get('/post', 'PostsController@index');
    $api->get('/post/{post}', 'PostsController@show');
    $api->get('/tag/hot', 'TagsController@hot');
    $api->get('/tag', 'TagsController@index');
    $api->get('/user/{user}', 'UsersController@show');
});

