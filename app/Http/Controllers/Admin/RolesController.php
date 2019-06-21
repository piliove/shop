<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RolesController extends Controller
{
    /**
     * 显示列表页面
     */
    public function index(Request $request)
    {
        //接收desc
        $desc = $request->input('desc');
        //查询所有数据
        $roles = DB::table('roles')->where('desc', 'like', '%' . $desc . '%')->paginate(8);
        //渲染模板
        return view('/admin/roles/index', ['roles' => $roles, 'desc' => $desc]);
    }

    /**
     * 显示控制器添加页面
     */
    public function create()
    {
        //渲染模板
        return view('/admin/roles/create');
    }

    /**
     * 接收添加页面信息
     */
    public function store(Request $request)
    {
        $data = $request->all();
<<<<<<< HEAD
=======
        if (empty($data['control']) && empty($data['method']) && empty($data['desc'])) exit('请确保各项不为空');
>>>>>>> origin/muyinya
        //写入数据库且判断是否添加成功
        $res = DB::table('roles')->insert($data);
        if ($res) {
            echo '添加成功';
        } else {
            echo '添加失败';
        }
    }

    /**
     * 显示修改页面
     */
    public function edit($id)
    {
        $roles = DB::table('roles')->where('id', $id)->first();
        //渲染模板
        return view('/admin/roles/edit', ['roles' => $roles]);
    }

    /**
     * 接收修改页面信息
     */
    public function update(Request $request, $id)
    {
        $control = $request->input('control', '');
        $method = $request->input('method', '');
        $desc = $request->input('desc', '');
<<<<<<< HEAD
        $res = DB::table('roles')->where('id',$id)->update(['control' => $control, 'method' => $method, 'desc' => $desc]);
=======
        if (empty($desc) && empty($method) && empty($control)) exit('请确保各项不为空');
        $res = DB::table('roles')->where('id', $id)->update(['control' => $control, 'method' => $method, 'desc' => $desc]);
>>>>>>> origin/muyinya
        if ($res) {
            echo '修改成功';
        } else {
            echo '无改动,无需提交';
        }
    }

    /**
     * 删除模块
     */
    public function destroy(Request $request)
    {
        //接收ID传值
        $id = $request->input('id');
        //执行删除且判断是否删除成功
        $res = DB::table('roles')->where('id', $id)->delete();
        if ($res) {
            echo '删除成功';
        } else {
            echo '删除失败';
        }
    }
}
