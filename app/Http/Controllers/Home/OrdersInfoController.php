<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CartController;
use App\Models\Orders;
use App\Models\OrderInfos;
use DB;

class OrdersInfoController extends Controller
{
    // 加载 订单页界面
    public function index()
    {
        // 获取购物车的商品数量
        $countCart = CartController::countCart();

        // 用户登录,则给用户ID
        $uid = session('IndexUser')->id;

        // 获取所有订单数据
        $orders = Orders::all();

        $id = 0;
        if ( !empty($uid) && !empty($orders) ) {
            foreach ($orders as $k => $v) {
                $id = $v->id;
            }
        } else {
            $id = 0;
        }

        // 获取单条订单信息
        $orders = Orders::find($id);

        //通过uid获取订单详情信息
        $ordersinfo = Orders::find($id)->orderinfos;

        // 获取订单详情数据 即商品的信息
        // $ordersinfo = DB::table('orders_info')->get();

        // 渲染 订单主页面
        return view('/home/ordersinfo/index',['orders'=>$orders,
                                              'ordersinfo'=>$ordersinfo,
                                              'countCart'=>$countCart,
                                              'links_data'=>GetdateController::getLink(),
                                             ]);
    }

    // 删除指定的一条订单
    public function del(Request $request)
    {   
        // 获取指定的订单id
        $id = $request->input('id',0);

        // 查询id对应订单
        $orders = Orders::find($id);

        // 执行删除操作
        $orders = Orders::destroy($id);
        $orders_info = DB::table('orders_info')->where('oid', $id)->delete();
        
        // 判断删除是否成功
        if ($orders && $orders_info) {
            echo '删除成功';
        } else {
            echo '删除失败';
        }

    }
}
