<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 使用Cart控制器的方法
use App\Http\Controllers\Home\CartController;

class IndexController extends Controller
{
    /**
     * 显示首页
     */
    public function index()
    {
        
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        //取得分类
        $cate_data = GetdateController::getCate();
        
        //取得推荐商品
        $rec_data_goods = GetdateController::getRec();
      
        // 渲染 商城首页
        return view('/home/index/index',['countCart'=>$countCart, 'cate_data'=>$cate_data, 'rec_data'=>$rec_data_goods]);
    }
}
