<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collects;
use DB;
// 使用Cart控制器的方法
use App\Http\Controllers\Home\CartController;

class CollectController extends Controller
{
    // 执行 移入收藏列表页
    public function add(Request $request)
    {
        // 获得指定商品的id
        $id = $request->input('id',0);

        // 实例化 收藏管理表
        $collects = new Collects;

        // 获取商品表中具体的某一个值
        $data = DB::table('goods')->select('id','gtitle','gdesc','gprice','gprices','gthumb_1')->where('id',$id)->first();
        
        // 插入数据到数据库中
        $collects->ctitle = $data->gtitle;
        $collects->cprice = $data->gprice;
        $collects->cprices = $data->gprices;
        $collects->cthumb = $data->gthumb_1;
        $res = $collects->save();

        // 判断 插入数据库成功与否
        if ($res) {
            echo json_encode(['msg'=>'ok','info'=>'添加成功']);
        } else {
            echo json_encode(['msg'=>'err','info'=>'添加失败']);
        }

    }

    // 加载 收藏管理列表页面
    public function index()
    {
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        // 渲染 收藏列表首页
        return view('home.collect.index',['countCart'=>$countCart]);
    }

}
