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
        //判断是否登录
        if (!session('IndexLogin')) exit('请登录后收藏');
        // 获取指定用户的id
        $uid = session('IndexUser')->uid;

        // 获得指定商品的id
        $id = $request->input('id', 0);
        $collect = DB::table('collects')->where('uid', $uid)->get();
        if (!empty($collect)) {
            foreach ($collect as $k => $v) {
                if ($v->gid == $id) exit('该商品已在收藏列表');
            }
        } else {
            $collect = null;
        }

        // 实例化 收藏管理表
        $collects = new Collects;

        // 获取商品表中具体的某一个值
        $data = DB::table('goods')->select('id', 'gtitle', 'gdesc', 'gprice', 'gprices', 'gthumb_1')->where('id', $id)->first();

        // 插入数据到数据库中
        $collects->uid = $uid;
        $collects->ctitle = $data->gtitle;
        $collects->cprice = $data->gprice;
        $collects->cprices = $data->gprices;
        $collects->cthumb = $data->gthumb_1;
        $collects->gid = $id;
        $res = $collects->save();

        // 判断 插入数据库成功与否
        if ($res) {
            echo "加入收藏成功";
        } else {
            echo "加入收藏失败";
        }

    }

    // 加载 收藏管理列表页面
    public function index()
    {
        // 实例化 收藏管理表
        $collects = new Collects;

        // 判断用户是否登录
        if (session('IndexLogin') == true) {
            // 获取指定用户的id
            $uid = session('IndexUser')->uid;


            // 获取指定用户添加的收藏
            $data = $collects::where('uid', '=', $uid)->get();
        } else {
            $data = [];
        }

        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        // 渲染 收藏列表首页
        return view('home.collect.index', ['data' => $data, 'countCart' => $countCart, 'title' => '收藏列表']);
    }

    /**
     * 取消收藏
     */
    public function del(Request $request)
    {
        $id = $request->input('id', '');
        //删除ID对应收藏
        $res = DB::table('collects')->where('id', $id)->delete();
        if ($res) {
            echo '取消成功';
        } else {
            echo '取消失败';
        }
    }

}
