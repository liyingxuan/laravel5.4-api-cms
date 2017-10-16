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

/**
 * 登陆/登出
 */
//Route::group(['namespace' => 'Auth'], function () {
//    Route::get('login', 'AuthController@getLogin');
//    Route::post('login', 'AuthController@postLogin');
//    Route::get('logout', 'AuthController@getLogout');
//
//    Route::group(['prefix' => 'auth'], function () {
//        Route::get('login', 'AuthController@getLogin');
//        Route::post('login', 'AuthController@postLogin');
//        Route::get('logout', 'AuthController@getLogout');
//    });
//});

/**
 * 后台管理 : 首页 | 用户管理 | 菜单管理 | 角色管理 | 权限管理
 */
Route::group(['prefix' => 'cms', 'namespace' => 'Backend', 'middleware' => ['auth', 'Entrust']], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);
});

Route::group(['prefix' => 'cms'], function () {
    Auth::routes();
});

