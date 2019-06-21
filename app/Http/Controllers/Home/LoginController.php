<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class LoginController extends Controller
{
    /**
     * 显示登陆页面
     */
    public function login()
    {
        return view('home/login');
    }

    public function doLogin(Request $request)
    {
        //接收传值
        $choice = $request->input('choice', '');
        $number = $request->input('number', '');
        $upwd = $request->input('upwd', '');
        //判断是否有传值
<<<<<<< HEAD
        if (empty($number) || empty($upwd)) exit('请确保各项不为空');
=======
        if (empty($number) && empty($upwd)) exit('请确保各项不为空');
>>>>>>> origin/muyinya
        //判断用户选择的登录方式
        if ($choice == 'c_email') {
            $userinfo = DB::table('user_info')->where('email', $number)->first();
            if (empty($userinfo)) exit('账号或密码错误');
            $res = DB::table('users')->where('id', $userinfo->uid)->first();
        } else if ($choice == 'c_phone') {
            $userinfo = DB::table('user_info')->where('phone', $number)->first();
            if (empty($userinfo)) exit('账号或密码错误');

            $res = DB::table('users')->where('id', $userinfo->uid)->first();
        } else {
            $res = DB::table('users')->where('uname', $number)->first();
            if (empty($res)) exit('账号或密码错误');
        }
        //检查密码是否正确
        if (Hash::check($upwd, $res->upwd)) {
            session(['IndexLogin'=>true]);
            session(['IndexUser'=>$res]);
            echo '登录成功';
        } else {
            echo '账号或密码错误';
        }
    }
}
