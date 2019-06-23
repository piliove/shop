<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CartController;
use App\Models\Orders;
use DB;

class OrdersController extends Controller
{
    // 加载 结算页面
    public function index(Request $request)
    {
        // 判断用户登录情况
        if ( session('IndexLogin') == true ) {
            // 用户登录,则给用户ID
            $uid = session('IndexUser')->id;
        } else {
            echo "您还未登录,请先登录";
            exit;
        }

        // 获取指定用户添加的地址数据
        $addres = DB::table('addres')->where('uid',$uid)->get();

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

        // 获取购物券的数据
        $coupon = DB::table('coupon')->where('uid',$uid)->get();

        // 获取购物券的价格
        $coupon_price = DB::table('coupon')->first();
        $coupon_price = $coupon_price->cprice;

        // 渲染 结算页面
        return view('home.orders.index',['coupon_price'=>$coupon_price,'coupon'=>$coupon,'addres'=>$addres,'data'=>$data,'countCart'=>$countCart,'countPrice'=>$countPrice]);
    }

    // 加载 提交订单页面
    public function pay(Request $request)
    {
        // 判断用户登录情况
        if ( session('IndexLogin') == true ) {
            // 用户登录,则给用户ID
            $uid = session('IndexUser')->id;
        } else {
            echo "<script>alert('您还未登录,请先登录');location.href="/";</script>";
            exit;
        }

        // 获取表单提交的所有数据
        $data = $request->all();

        // 实例化 订单表
        $orders = new Orders;
        
        // 插入数据到数据中
        $orders->number = date('ymd', time()) . rand(1000, 10000);
        $orders->count = $data['price'];
        $orders->oaddr = $data['aname'].' '.$data['dname'];
        $orders->uid   = $uid;
        $orders->paystatus = 1;
        $orders->gtitle = $data['gtitle'];
        $orders->gprices = $data['gprices'];
        $orders->gnum   = $data['gnum'];
        $orders->name = $data['name'];
        $orders->aphone = $data['aphone'];

        // 保存到数据库
        $res = $orders->save();

        // 判断成功与否
        if ($res) {
            return redirect('/home/ordersinfo/index');
        } else {
            return back();
        }

    }
}
