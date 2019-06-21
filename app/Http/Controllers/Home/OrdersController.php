<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CartController;
use DB;

class OrdersController extends Controller
{
    // 加载 结算页面
    public function index(Request $request)
    {
        // 获取指定用户的id
        $id = $request->input('id',0);


        // 判断session值是否存在
        if (!empty($_SESSION['cart'])) {
            $data = $_SESSION['cart'];            
        } else {
            $data = [];
        }

        // 获取购物车的商品数量
        $countCart = CartController::countCart();

        // 获取商品总的价格
        $countPrice = CartController::countPrice();

        // 渲染 结算页面
        return view('home.orders.index',['data'=>$data,'countCart'=>$countCart,'countPrice'=>$countPrice]);
    }
}
