<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 使用Cart控制器的方法
use App\Http\Controllers\Home\CartController;
// 使用banners控制器的方法
use App\Models\Banners;
// 使用blog控制器的方法
use App\Models\Blog;
// 使用blog控制器的方法
use App\Models\Advert;

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
        





        //
        $banners = Banners::all();
        $blog = Blog::all();
        $advert = Advert::all();



        //取得活动内容
        $activity_data_four = GetdateController::getActivity(4);
      
        // 渲染 商城首页
        return view('/home/index/index',['countCart'=>$countCart,
                                         'cate_data'=>$cate_data,
                                         'rec_data'=>$rec_data_goods,
                                         'banners'=>$banners,
                                         'blog'=>$blog,
                                         'advert'=>$advert,
                                         'activity_data'=>$activity_data_four,
                                        ]);
    }
}
