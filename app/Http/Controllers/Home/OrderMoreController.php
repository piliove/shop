<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CartController;
use App\Models\Orders;

class OrderMoreController extends Controller
{
    // 加载 订单详情页
    public function index($id)
    {
        // 获取单条订单信息
        $orders = Orders::find($id);

        //通过uid获取订单详情信息
        $ordersinfo = Orders::find($id)->orderinfos;

        // 获取购物车的商品数量
        $countCart = CartController::countCart();

        // 渲染 订单详情页面
        return view('home.ordermore.index',['orders'=>$orders,'ordersinfo'=>$ordersinfo,'countCart'=>$countCart]);
    }
}
