<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
// 使用Cart控制器的方法
use App\Http\Controllers\Home\CartController;

/**
 * 商品详情页面
 */
class InfoController extends Controller
{
    // 加载 商品详情页面
    public function index($id)
    {
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        // 获取商品中的指定数据
        $data = Goods::find($id);

        // 渲染商品详情首页
        return view('home.info.index',['data'=>$data,'countCart'=>$countCart]);
    }
}
