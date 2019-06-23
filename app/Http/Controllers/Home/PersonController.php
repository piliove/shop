<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    // 加载 个人中心页面
    public function index()
    {
        // 渲染 个人中心首页
        return view('home.person.index');
    }

}
