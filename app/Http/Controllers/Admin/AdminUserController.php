<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * 显示管理员列表
     */
    public function index()
    {
        //多表联查admin_user,admin_nodes,nodes
        $admin_user = DB::table('admin_nodes as a')
            ->join('admin_user as b', 'b.id', 'a.aid')
            ->join('nodes as c', 'c.id', 'a.nid')
            ->paginate(8);
        //渲染模板
        return view('/admin/admin_user/index', ['admin_user' => $admin_user]);
    }

    /**
     * 用户添加页面
     */
    public function create()
    {
        //获取nodes表所有数据
        $nodes = DB::table('nodes')->get();
        //渲染模板
        return view('/admin/admin_user/create', ['nodes' => $nodes]);
    }

    /**
     * 头像上传
     */
    public function updateFile(Request $request)
    {
        //判断是否有文件上传
        if ($request->hasFile('uface')) {
            //接收上传文件
            $uface = $request->file('uface');
            //获取上传文件后缀
            $name = $uface->extension();
            //设置图片名称
            $FileName = date('Ymd', time()) . rand(1000, 1999) . '.' . $name;
            //执行文件上传
            $path = $uface->storeAs('/' . date('Ymd', time()), $FileName);
            echo $path;
        }
    }

    /**
     * 接收添加页面传值
     */
    public function store(Request $request)
    {
        //接收表单传值
        $uname = $request->input('uname', '');
        $upwd = $request->input('upwd', '');
        $upwd1 = $request->input('upwd1', '');
        $nid = $request->input('nid', '');
        $uface = $request->input('uface', '');
        $token = date('Ymd', time()) . rand(1000, 10000);
        //判断是否有空值
        if (empty($uname) || empty($upwd) || empty($upwd1) || empty($nid) || empty($uface)) exit('请确保各项不为空');
        //判断两次密码是否一致
        if ($upwd !== $upwd1) exit('两次密码需一致');
        //密码哈希加密
        $upwd = Hash::make($upwd);

        try {
            //开启事务
            DB::beginTransaction();
            $admin_user = DB::table('admin_user')->insertGetId(['uname' => $uname, 'upwd' => $upwd, 'uface' => $uface, '_token' => $token]);
            $admin_nodes = DB::table('admin_nodes')->insert(['aid' => $admin_user, 'nid' => $nid]);
            if ($admin_user && $admin_nodes) {
                //提交事务
                DB::commit();
                echo '添加成功';
            } else {
                //回滚事务
                DB::rollBack();
                echo '添加失败';
            }
        } catch (\Exception $e) {
            //回滚事务
            DB::rollBack();
            echo '用户名已存在';
        }
    }

    /**
     * 显示修改页面
     */
    public function edit($id)
    {
        //多表联查admin_user,admin_nodes,nodes
        $admin_user = DB::table('admin_nodes as a')
            ->join('admin_user as b', 'b.id', 'a.aid')
            ->join('nodes as c', 'c.id', 'a.nid')
            ->where('aid', $id)
            ->first();
        //查询nodes表
        $nodes = DB::table('nodes')->get();
        //渲染模板
        return view('/admin/admin_user/edit', ['admin_user' => $admin_user, 'nodes' => $nodes]);
    }

    /**
     * 接收修改页面数据
     */
    public function update(Request $request, $id)
    {
        $uname = $request->input('uname', '');
        $upwd = $request->input('upwd', '');
        $nid = $request->input('nid', '');
        $uface = $request->input('uface', '');
        $token = $request->input('token', '');
        //开启事务
        DB::beginTransaction();
        //判断token是否正确
        $_token = DB::table('admin_user')->where('id', $id)->first();
        if ($token !== $_token->_token) exit('验证失败');
        //判断密码是否有修改
        if (empty($upwd)) {
            $admin_user_upwd = DB::table('admin_user')->where('id', $id)->first();
            $upwd = $admin_user_upwd->upwd;
        } else {
            $upwd = Hash::make($request->input('upwd'));
        }
        //判断头像是否有改动
        if (empty($uface)) {
            $admin_user_uface = DB::table('admin_user')->where('id', $id)->first();
            $uface = $admin_user_uface->uface;
        } else {
            $uface = $request->input('uface');
        }
        //判断权限是否有改动
        $admin_nodes = DB::table('admin_nodes')->where('aid', $id)->first();
        if ($admin_nodes->nid !== (int)$nid) {
            $admin_nodes_update = DB::table('admin_nodes')->where('aid', $id)->update(['nid' => $nid]);
        } else {
            $admin_nodes_update = true;
        }
        //提交修改且判断是否修改成功
        $admin_user = DB::table('admin_user')->where('id', $id)->update(['uname' => $uname, 'upwd' => $upwd, 'uface' => $uface]);
        if ($admin_nodes_update && $admin_user) {
            //提交事务
            DB::commit();
            echo '修改成功';
        } else {
            //回滚事务
            DB::rollBack();
            echo '无改动,无需提交';
        }

    }

    /**
     * 删除管理员
     */
    public function destroy(Request $request)
    {
        //接收id
        $id = $request->input('id', '');
        //开始事务
        DB::beginTransaction();
        //查询管理头像
        $img = DB::table('admin_user')->where('id', $id)->first();
        //删除管理员,且判断是否删除成功
        $res = DB::table('admin_user')->where('id', $id)->delete();
        //删除admin_nodes对应id数据
        $admin_nodes = DB::table('admin_nodes')->where('aid', $id)->delete();
        if ($res && $admin_nodes) {
            //提交事务
            DB::commit();
            //删除头像
            Storage::delete($img->uface);
            echo '删除成功';
        } else {
            //回滚事务
            DB::rollBack();
            echo '删除失败';
        }
    }
}
