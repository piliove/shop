<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Footprint;
// 使用Cart控制器的方法
use DB;
use App\Http\Controllers\Home\CartController;


/**
 * 商品详情页面
 */
class InfoController extends Controller
{
    // 加载 商品详情页面
    public function index(Request $request, $id)
    {
        
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();


        // 获取商品中的指定数据
        $data = Goods::find($id);

        \Cookie::queue($id,'infos', 60 * 12);
        if (\Cookie::get($id) !== 'infos') {
            DB::update('update goods set pageview=pageview+1 where id='.$id);
        }

        // 获取指定的用户id
        // $id = $request->input('id',0);

        // 判断用户登录情况
        if (session('IndexLogin') == true) {
            // 用户登录,则给用户ID
            $id = session('IndexUser')->uid;
        } else {
            // 未登录 ID为0
            $id = 0;
        }
        // dd($id);


        // 渲染商品详情首页
        return view('home.info.index',['id'=>$id,
                                       'data'=>$data,
                                       'countCart'=>$countCart,
                                       'links_data'=>GetdateController::getLink(),
                                       ]);
    }

    public function footprints($id,$uid)
    {
       $ids_all = self::goodnum($uid);
       // dump($ids_all);
        if(!in_array($id,$ids_all)){
            DB::table('footprint')->insert(['gid'=>$id,'uid'=>$uid]);
        }
    }

    public function goodnum($uid)
    {
      $ids = DB::table('footprint')->where('uid',$uid)->get();

        $ids_all = [];
        foreach ($ids as $key => $value) {
            $ids_all[] = $value->gid;
        }
        return $ids_all;
        // 渲染商品详情首页
        return view('home.info.index', ['id' => $id, 
                                        'data' => $data, 
                                        'countCart' => $countCart,
                                        
                                        ]);
    }
}
