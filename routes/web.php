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



//*********************************前台路由******************************
//=================前台注册(手机号/邮箱)=====================
//首页
Route::get('/index/index', 'Home\IndexController@index');
Route::get('/', 'Home\IndexController@index');
//注册
Route::get('/reg', 'Home\RegController@index');
//返回验证码
Route::post('/reg/upphone', 'Home\RegController@upPhone');
//接收手机注册表单值
Route::post('reg/regphone', 'Home\RegController@regPhone');
//接收邮箱注册表单值
Route::post('reg/upemail', 'Home\RegController@upEmail');
//邮箱激活页面
Route::get('/reg/email/{id}/{token}/{uname}', 'Home\RegController@email');
//登录页面
Route::get('/login', 'Home\LoginController@login');
//接收登录信息
Route::post('/login/dologin', 'Home\LoginController@doLogin');

//=================前台搜索列表=====================
// 搜索列表页
Route::get('/home/search/index', 'Home\SearchController@index');

//=================前台商品详情页面=====================
// 商品详情页
Route::get('/home/info/index/{id}', 'Home\InfoController@index');
// 商品详情验证
Route::get('home/info/index', 'Home\InfoController@index');

//=================前台优惠券页面=====================
// 领取 商品优惠券页
Route::get('/home/coupon/add', 'Home\CouponController@add');
// 商品优惠券页
Route::get('/home/coupon/index', 'Home\CouponController@index');

//=================前台收藏管理页面=====================
// 移入 收藏列表页
Route::get('/home/collect/add', 'Home\CollectController@add');
// 收藏列表页
Route::get('/home/collect/index', 'Home\CollectController@index');

//=================前台购物车页面=====================
// 执行 添加到购物车操作
Route::get('/home/cart/add', 'Home\CartController@add');
// 显示 购物车页面
Route::get('/home/cart/index', 'Home\CartController@index');
// 执行 添加商品数量
Route::get('/home/cart/addnum', 'Home\CartController@addNum');
// 执行 减少商品数量
Route::get('/home/cart/descnum', 'Home\CartController@descNum');
// 执行 删除商品
Route::get('/home/cart/delete', 'Home\CartController@delete');

//=================前台结算页面=====================
// 显示 商品结算页面
Route::get('/home/orders/index', 'Home\OrdersController@index');
// 执行 提交订单
Route::post('/home/orders/pay', 'Home\OrdersController@pay');

// 前台 修改 默认地址
Route::get('/home/addres/changeStatus', 'Home\AddresController@changeStatus');
//接收修改商品传值
Route::post('/home/addres/update','Home\AddresController@update');
// 前台删除用户
Route::get('home/addres/del', 'Home\AddresController@destroy');
// 前台地址
Route::resource('home/addres', 'Home\AddresController');

//=================前台个人中心页面=====================
// 显示 个人中心页面
Route::get('/home/person/index', 'Home\PersonController@index');



//*********************************后台路由******************************
//======================登陆管理===================
// 显示登陆页面
Route::get('/admin/login', 'Admin\LoginController@login');
Route::get('/admin', 'Admin\LoginController@login');
// 接收登录表单传值
Route::post('/admin/dologin', 'Admin\LoginController@doLogin');
// 退出登录
Route::get('/admin/logout', 'Admin\LoginController@logout');

// 中间件
// Route::group(['middleware' => ['AdminLogin', 'RolesUser']], function () {
// rbac错误页面
Route::get('/admin/rbac','Admin\LoginController@rbac');
// 个人中心
Route::get('/admin/center/{id}/{token}', 'Admin\LoginController@center');
// 接收个人中心传值
Route::post('/admin/center/update/{id}', 'Admin\LoginController@update');
//======================用户管理===================
// 用户文件上传
Route::post('admin/user/updatefile', 'Admin\UserController@updateFile');
// 删除用户
Route::get('/admin/user/del', 'Admin\UserController@destroy');
// 接收修改用户传值
Route::post('/admin/user/update', 'Admin\UserController@update');
// 修改密码
Route::get('/admin/user/upwd', 'Admin\UserController@upwd');
// 接收修改密码值
Route::post('/admin/user/upwd/cpwd', 'Admin\UserController@cpwd');
// 用户增删改查
Route::resource('/admin/user', 'Admin\UserController');
// 管理员文件上传
Route::post('/admin/admin/updatefile', 'Admin\AdminUserController@updateFile');
// 删除管理员
Route::get('/admin/admin/del', 'Admin\AdminUserController@destroy');
// 后台管理员
Route::resource('/admin/admin', 'Admin\AdminUserController');
// 删除角色
Route::get('/admin/nodes/del', 'Admin\NodesController@destroy');
// 角色权限
Route::resource('/admin/nodes', 'Admin\NodesController');
// 删除控制器
Route::get('/admin/roles/del', 'Admin\RolesController@destroy');
// 控制器列表
Route::resource('/admin/roles', 'Admin\RolesController');

//======================反馈管理===================
// 反馈增删改查
Route::resource('/admin/feedback', 'Admin\FeedbackController');

//======================轮播图管理===================
//文件上传
Route::post('admin/banners/updatefile', 'Admin\BannersController@updateFile');
// 轮播图 修改 状态
Route::get('/admin/banners/changeStatus','Admin\BannersController@changeStatus');
// 轮播图 删除
Route::get('admin/banners/del', 'Admin\BannersController@destroy');
// 轮播图 修改 
Route::post('/admin/banners/update', 'Admin\BannersController@update');
// 轮播图增删改查
Route::resource('/admin/banners','Admin\BannersController');

//=======================广告管理========================
//文件上传
Route::post('admin/advert/updatefile', 'Admin\AdvertController@updateFile');
// 删除用户
Route::get('admin/advert/del', 'Admin\AdvertController@destroy');
// 广告 修改 状态
Route::get('/admin/advert/changeStatus', 'Admin\AdvertController@changeStatus');
// 广告 修改 
Route::post('/admin/advert/update', 'Admin\AdvertController@update');
//广告增删改查
Route::resource('/admin/advert', 'Admin\AdvertController');

//======================链接管理===================
//友情链接 改变状态
Route::get('/admin/changelinkmsg', 'Admin\LinkController@change');
//友情链接 增删改查
Route::resource('admin/link', 'Admin\LinkController');

//======================地址管理========================

//======================删除地址=========================
Route::get('admin/addres/del', 'Admin\AddresController@destroy');
// 后台地址
Route::resource('admin/addres', 'Admin\AddresController');

//=======================后台新闻管理======================
// 广告 修改 
Route::post('/admin/blog/update', 'Admin\BlogController@update');
// 删除用户
Route::get('admin/blog/del', 'Admin\BlogController@destroy');
//文件上传
Route::post('admin/blog/updatefile', 'Admin\BlogController@updateFile');
// 新闻
Route::resource('admin/blog', 'Admin\BlogController');

























//=======================B=========================
//分类消息提醒
Route::get('/admin/changecatemsg','Admin\CateController@change');
//分类管理 
Route::resource('/admin/cate', 'Admin\CateController');

//活动商品详情
Route::get('/admin/activity/actgoods', 'Admin\ActivityController@actGoods');
//活动商品 取消资格
Route::post('/admin/activity/delactgoods', 'Admin\ActivityController@delactGoods');
//活动商品 添加资格 页面
Route::get('/admin/activity/createactgoods', 'Admin\ActivityController@createActGoods');
//活动商品 添加
Route::get('/admin/activity/addactgoods', 'Admin\ActivityController@addActGoods');
//活动头像异步传输
Route::post('/admin/getprofile', 'Admin\ActivityController@getProfile');
//后台 活动消息转变提醒
Route::get('/admin/changeactivitymsg', 'Admin\ActivityController@change');
//后台 活动管理
Route::resource('/admin/activity', 'Admin\ActivityController');


//后台 商品改变推荐位
Route::get('/admin/recommendchange', 'Admin\GoodsController@changerec');

//后台 网站配置
Route::get('/admin/website', 'Admin\WebsiteController@index');
//后台 文件修改
Route::post('/admin/website/update', 'Admin\WebsiteController@update');
//后台 改变信息
Route::get('/admin/changesitemsg', 'Admin\WebsiteController@change');





























//=======================C=========================




























//=======================D=========================
//======================优惠券管理===================
//接收修改优惠券的值
Route::post('/admin/coupon/update','Admin\CouponController@update');
//优惠券 增删改查
Route::resource('admin/coupon', 'Admin\CouponController');

//======================商家管理===================
//接收修改商家的值
Route::post('/admin/business/update','Admin\BusinessController@update');
// 商家 增删改查
Route::resource('admin/business','Admin\BusinessController');

//======================商品管理===================
//接收修改商品传值
Route::post('/admin/goods/update','Admin\GoodsController@update');
//文件上传
Route::post('/admin/goods/updatefile', 'Admin\GoodsController@updateFile');
// 商品 增删改查
Route::resource('admin/goods','Admin\GoodsController');




// });