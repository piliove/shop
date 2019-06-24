<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupons;
// 使用Cart控制器的方法
use App\Http\Controllers\Home\CartController;

class CouponController extends Controller
{
    // 加载 优惠券页面
    public function index()
    {
        // 获取数据库中的所有数据
        $coupons = Coupons::all();

        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        // 渲染 优惠券页面
        return view('home.coupon.index',['coupons'=>$coupons,'countCart'=>$countCart]);
    }

    public function add(Request $request)
    {
        // 判断用户登录情况
        if ( session('IndexLogin') == true ) {
            // 用户登录,则给用户ID
            $uid = session('IndexUser')->id;
        } else {
            echo "您还未登录,请先登录";
            exit;
        }

        // 获取表单传递过来的优惠券id
        $id = $request->input('id',0);
        // 找到指定的优惠券数据
        $coupons = Coupons::find($id);
        //插入uid
        $coupons->uid = $uid;
        // 保存到数据库中
        $res = $coupons->save();

        // 判断是否保存到数据库
        if ($res) {
            echo "领取成功";
        } else {
            echo "领取失败";
        }
        
    }
}
