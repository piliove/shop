<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CartController;

class OrdersInfoController extends Controller
{
    // 加载 订单页界面
    public function index()
    {
        // 获取购物车的商品数量
        $countCart = CartController::countCart();

        // 渲染 订单主页面
        return view('/home/ordersinfo/index',['countCart'=>$countCart]);
    }
}
