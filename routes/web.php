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
//接收修改用户传值
Route::post('/admin/user/update','Admin\UserController@update');
//用户增删改查
Route::resource('/admin/user', 'Admin\UserController');

//======================反馈管理===================
//反馈增删改查
Route::resource('/admin/feedback', 'Admin\FeedbackController');

//======================轮播图管理===================
// 轮播图 修改 状态
Route::get('/admin/banners/changeStatus','Admin\BannersController@changeStatus');
//轮播图增删改查
Route::resource('/admin/banners','Admin\BannersController');

//=======================广告管理========================
// 轮播图 修改 状态
Route::get('/admin/advert/changeStatus', 'Admin\AdvertController@changeStatus');
//广告增删改查
Route::resource('/admin/advert', 'Admin\AdvertController');

//======================链接管理===================
//友情链接 改变状态
Route::get('/admin/changelinkmsg', 'Admin\LinkController@change');
//友情链接 增删改查
Route::resource('admin/link', 'Admin\LinkController');

//=======================A=========================





























//=======================B=========================
//分类消息提醒
Route::get('/admin/changecatemsg','Admin\CateController@change');
//分类管理 
Route::resource('/admin/cate', 'Admin\CateController');

//活动头像异步传输
Route::post('/admin/getprofile', 'Admin\ActivityController@getProfile');
//后台 活动管理
Route::resource('/admin/activity', 'Admin\ActivityController');
//后台 活动消息转变提醒
Route::get('/admin/changeactivitymsg','Admin\ActivityController@change');


























//=======================C=========================





























//=======================D=========================
//======================优惠券管理===================
//接收修改优惠券的值
Route::post('/admin/coupon/update','Admin\CouponController@update');
//优惠券 增删改查
Route::resource('admin/coupon', 'Admin\CouponController');








