<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    // 加载 结算页面
    public function index()
    {
        // 渲染 结算页面
        return view('home.orders.index');
    }
}
