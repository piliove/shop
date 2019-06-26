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
//Cate分类
use App\Models\Cates;
//用户详情
use App\Models\UserInfos;
use DB;

class IndexController extends Controller
{
    /**
     * 显示首页
     */
    public function index()
    {
        if (session('IndexUser')) {
            $id = session('IndexUser')->uid;
            //获取用户信息
            $user = DB::table('user_info as i')
                ->join('users as u', 'i.uid', 'u.id')
                ->where('i.uid',$id)
                ->first();
            //获取会员等级
            $member = DB::table('member')->where('uid', $id)->first();
        } else {
            $user = null;
            $member = null;
        }


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

        //首页商品
        $goods_pid = Cates::where('pid', 0)->get();
        //首页商品
        foreach ($goods_pid as $k => $v) {
            $goods_pid[$k]->sub = DB::table('cates')->where('pid', $v->id)->get();
            foreach ($goods_pid[$k]->sub as $kk => $vv) {
                $goods_pid[$k]->sub[$kk]->sub =
                    DB::table('cates as c')
                        ->join('goods as g', 'c.id', 'g.cid')
                        ->where('pid', $vv->id)
                        ->orderBy('pageview', 'desc')
                        ->limit(8)
                        ->get();
            }
        }

        // 渲染 商城首页
        return view('/home/index/index', ['countCart' => $countCart,
            'cate_data' => $cate_data,
            'rec_data' => $rec_data_goods,
            'banners' => $banners,
            'blog' => $blog,
            'advert' => $advert,
            'activity_data' => $activity_data_four,
            'goods_pid' => $goods_pid,
            'user' => $user,
            'member' => $member
        ]);
    }
}
