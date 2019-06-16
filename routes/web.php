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

Route::get('/', function () {
    return view('welcome');
});

//*********************************后台路由******************************

//======================用户管理===================
//文件上传
Route::post('admin/user/updatefile', 'Admin\UserController@updateFile');
//删除用户
Route::get('/admin/user/del', 'Admin\UserController@destroy');
//用户增删改查
Route::resource('admin/user', 'Admin\UserController');

//======================反馈管理===================
//反馈增删改查
Route::resource('admin/feedback', 'Admin\FeedbackController');

//======================轮播图管理===================
// 轮播图 修改 状态
Route::get('/admin/banners/changeStatus','Admin\BannersController@changeStatus');
//轮播图增删改查
Route::resource('/admin/banners','Admin\BannersController');

//======================链接管理===================
//友情链接 增删改查
Route::resource('admin/link', 'Admin\LinkController');

//=======================42-72行=========================





























//=======================72-102行=========================





























//=======================102-132行=========================





























//=======================132-162行=========================









