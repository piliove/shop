<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collects;
use DB;

class PersonController extends Controller
{
    // 加载 个人中心页面
    public function index()
    {
        
        // 实例化 收藏管理表
        $collects = new Collects; 

        // 判断用户是否登录
        if ( session('IndexLogin') == true ) {
            // 获取指定用户的id
            $uid = session('IndexUser')->id;

            // 获取指定用户添加的收藏
            $data = $collects::where('uid','=',$uid)->get();
        } else {
            $data = [];
        }   

        // 渲染 个人中心首页
        return view('home.person.index',['data'=>$data]);
    }

}
