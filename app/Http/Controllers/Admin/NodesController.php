<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class NodesController extends Controller
{
    /**
     * 封装模块数组(添加页面模块)
     */
    public static function list()
    {
        $roles = DB::table('roles')->get();
        $list = [];
        foreach ($roles as $k => $v) {
            $temp['id'] = $v->id;
            $temp['control'] = $v->control;
            $temp['method'] = $v->method;
            $temp['desc'] = $v->desc;
            $list[$v->control][] = $temp;
        }
        return $list;
    }

    /**
     * 显示列表
     */
    public function index()
    {
        //查询出所有roles_nodes
        $res = DB::table('roles_nodes as a')
            ->join('roles as b', 'b.id', 'a.rid')
            ->join('nodes as c', 'c.id', 'a.nid')
            ->get();
        $list = [];
        foreach ($res as $k => $v) {
            $item['control'] = $v->control;
            $item['method'] = $v->method;
            $item['desc'] = $v->desc;
            $list[$v->name][$v->id][] = $item;
        }
        $res1 = DB::table('nodes')->get();
        //渲染模板
        return view('/admin/nodes/index', ['list' => $list, 'res1' => $res1]);
    }

    /**
     * 显示添加页面
     */
    public function create()
    {
        $list = self::list();
        //渲染页面
        return view('/admin/nodes/create', ['list' => $list]);
    }

    /**
     * 接收添加页面传值
     */
    public function store(Request $request)
    {
        $control = $request->input('control', '');
        $name = $request->only('name');
        //判断是否有空值
        if (empty($control) || empty($name)) exit('请确保各项不为空');
        //开启事务
        DB::beginTransaction();
        $res = DB::table('nodes')->insertGetId($name);
        foreach ($control as $k => $v) {
            $roles_nodes = DB::table('roles_nodes')->insert(['rid' => $v, 'nid' => $res]);
        }
        if ($res && $roles_nodes) {
            //提交事务
            DB::commit();
            echo '添加成功';
        } else {
            //回滚事务
            DB::rollBack();
            echo '添加失败';
        }
    }

    /**
     * 显示修改页面
     */
    public function edit($id)
    {
        //引用封装模块
        $list = self::list();
        //根据ID查询对应nodes表
        $nodes = DB::table('nodes')->where('id', $id)->first();
        //渲染模板
        return view('/admin/nodes/edit', ['list' => $list, 'nodes' => $nodes]);
    }

    /**
     * 接收修改页面数据
     */
    public function update(Request $request, $id)
    {
        $name = $request->input('name', '');
        $control = $request->input('control', '');
        //开启事务
        DB::beginTransaction();
        //先删除roles_nodes表中nid等于$id的值
        $roles_nodes_delete = DB::table('roles_nodes')->where('nid', $id)->delete();
        //查询nodes表单对应$id的值
        $nodes_select = DB::table('nodes')->where('id', $id)->first();
        //判断$name的传值是否和数据库的一样
        if ($name !== $nodes_select->name) {
            $nodes = DB::table('nodes')->where('id', $id)->insert(['name' => $name]);
        } else {
            $nodes = true;
        }
        foreach ($control as $k => $v) {
            $roles_nodes = DB::table('roles_nodes')->insert(['nid' => $id, 'rid' => $v]);
        }

        //判断上面的是否全部执行成功
        if ($roles_nodes_delete && $nodes && $roles_nodes) {
            //提交事务
            DB::commit();
            echo '修改成功';
        } else {
            //回滚事务
            DB::rollBack();
            echo '修改失败';
        }
    }

    /**
     * 角色删除
     */
    public function destroy(Request $request)
    {
        //接收ID传值
        $id = $request->input('id');
        //执行删除并判断是否删除成功
        //开始事务
        DB::beginTransaction();
        $res = DB::table('nodes')->where('id', $id)->delete();
        //删除roles_nodes内对应ID值
        $roles_nodes = DB::table('roles_nodes')->where('nid', $id)->delete();

        if ($res && $roles_nodes) {
            //事务提交
            DB::commit();
            echo '删除成功';
        } else {
            //事务回滚
            DB::rollBack();
            echo '删除失败';
        }
    }
}
