<?php

namespace App\Http\Controllers\Admin;

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
        return view('/admin/login/index');
    }

    /**
     * 接收登录表单传值
     */
    public function doLogin(Request $request)
    {
        $uname = $request->input('uname');
        $upwd = $request->input('upwd');
        //判断是否为空值
        if (empty($uname) || empty($upwd)) exit('请确保各项不为空');
        //查询并判断是否有该用户
        $res = DB::table('admin_user')->where('uname', $uname)->first();
        if (!$res) exit('账号或密码错误');
        //查询用户可操作模块
        $nodes = DB::table('admin_nodes as an')
            ->join('roles_nodes as rn', 'an.nid', 'rn.nid')
            ->join('roles as r', 'rn.rid', 'r.id')
            ->where('an.aid', $res->id)
            ->select('control', 'method')
            ->get();
        $list = [];
        foreach ($nodes as $k => $v) {
            $list[$v->control][] = $v->method;
        }
        foreach ($list as $k => $v) {
            foreach ($v as $kk => $vv) {
                if($vv=='create'){
                    $list[$k][] = 'story';
                }
                if($vv=='edit'){
                    $list[$k][] = 'update';
                    $list[$k][] = 'upwd';
                    $list[$k][] = 'cpwd';
                    $list[$k][] = 'updateFile';
                }
            }
        }
        $list['logincontroller'][] = 'center';
        $list['logincontroller'][] = 'update';
        $list['logincontroller'][] = 'rbac';
        //检查密码是否一致
        if (Hash::check($upwd, $res->upwd)) {
            session(['RolesUser' => $list]);
            session(['AdminLogin' => true]);
            session(['AdminUser' => $res]);
            echo '登录成功';
        } else {
            echo '登录失败';
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        session(['AdminLogin' => false]);
        session(['AdminUser' => false]);
        session(['RolesUser' => false]);
        return redirect('/admin/login');
    }

    /**
     * 显示个人中心
     */
    public function center($id, $token)
    {
        $admin_user = DB::table('admin_user')->where('id', $id)->first();
        if ($token !== $admin_user->_token) return redirect('/admin/index');
        //渲染模板
        return view('/admin/login/center', ['admin_user' => $admin_user]);
    }

    /**
     * 接收个人中心修改信息
     */
    public function update(Request $request, $id)
    {
        $uname = $request->input('uname', '');
        $upwd = $request->input('upwd', '');
        $uface = $request->input('uface', '');
        $admin_user = DB::table('admin_user')->where('id', $id)->first();
        //判断密码是否为空
        if (empty($upwd)) {
            $upwd = $admin_user->upwd;
        } else {
            $upwd = Hash::make($request->input('upwd'));
            session(['AdminLogin' => false]);
            session(['AdminUser' => false]);
            session(['RolesUser' => false]);
        }
        //判断头像是否有改动
        if (empty($uface)) {
            $uface = $admin_user->uface;
        } else {
            $uface = $request->input('uface');
        }

        //提交修改,且判断是否修改成功
        $res = DB::table('admin_user')->where('id', $id)->update(['uname' => $uname, 'upwd' => $upwd, 'uface' => $uface]);
        if ($res) {
            $user = DB::table('admin_user')->where('id', $id)->first();
            session(['AdminUser' => $user]);
            echo '修改成功';
        } else {
            echo '无改动,无需提交';
        }
    }

    /**
     * 显示rbac错误页面
     */
    public function rbac() {
        //渲染模板
        return view('/admin/rbac');
    }
}
