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
    public function index($id)
    {
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        // 获取商品中的指定数据
        $data = Goods::find($id);

        self::footprints($id,3);
        // 渲染商品详情首页
        return view('home.info.index',['data'=>$data,'countCart'=>$countCart]);
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
    }
}
