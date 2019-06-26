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
        if ( session('IndexLogin') == true && $_SESSION['cart'] == true ) {
            // 用户登录,则给用户ID
            $uid = session('IndexUser')->id;
        } else {
            return back();
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
        return view('home.orders.index',['coupon_price'=>$coupon_price,
                                         'coupon'=>$coupon,                                   
                                         'data'=>$data,
                                         'addres'=>$addres,
                                         'countCart'=>$countCart,
                                         'countPrice'=>$countPrice,
                                         'links_data'=>GetdateController::getLink(),
                                        ]);
    }

    // 加载 提交订单页面
    public function pay(Request $request)
    {
        // 获取商品总的价格
        $countPrice = CartController::countPrice();

        // 判断用户登录情况
        if ( session('IndexLogin') == true ) {
            // 用户登录,则给用户ID
            $uid = session('IndexUser')->id;
        } else {
            echo "<script>alert('您还未登录,请先登录');</script>";
            exit;
        }
        
        // 获取表单提交的所有数据
        $data = $request->all();
        
        // 设置一个空的数组
        $datas = [];
        
        // 开启事务处理
        DB::beginTransaction();

        // 插入数据到订单表中
        $datas['order'] = date('ymd', time()) . rand(1000, 10000);
        // $datas['num'] = $data['num'];
        $datas['uid'] = $uid;
        $datas['prices'] = $countPrice;
        $datas['addr'] = $data['aname'].' '.$data['dname'];
        $datas['uname'] = $data['name'];
        $datas['phone'] = $data['aphone'];
        $datas['ctimes'] = date('Y-m-d H:i:s',time());

        // 保存到数据库
        $oid = DB::table('orders')->insertGetId($datas);

        // 插入数据到订单详情表中

        // 将详细信息 压入到订单详情表中
        if($_SESSION['cart']){
            $list = $_SESSION['cart'];

            foreach ($list as $key => $value) {
                $temp['gid'] = $value->id;
                $temp['oid'] = $oid;
                $temp['gname'] = $value->gtitle;
                $temp['price'] = $value->gprices;
                $temp['num'] = $value->num;
                // $temp['xiaoji'] = $countPrice;
                $temp['tupian'] = $value->gthumb_1;
                
                $res = DB::table('orders_info')->insert($temp);

                // 判断成功与否
                if (!$res) {
                    // 为false 返回
                    DB::rollBack();
                }
            }
        }

        // 提交事务
        DB::commit();
     	$_SESSION['cart'] = null;
     	echo "<script>alert('提交订单成功');location.href='/home/ordersinfo/index'</script>";

    }
}
