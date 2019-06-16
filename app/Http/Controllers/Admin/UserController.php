<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\users;
use App\Models\user_infos;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{
    /**
     * 显示用户首页
     */
    public function index(Request $request)
    {
        $search = $request->input('search',null);
        $data = [
            ['uname', 'like', '%' . $search . '%'],

        ];
        //查询所有用户数据
        $users = users::orderBy('id')->paginate(8);
        $users = DB::table('users')->where($data)->orderBy('id')->paginate(8);
        //引导模板
        return view('/admin/user/index', ['users' => $users, 'search' => $search]);
    }

    /**
     * 接收上传头像
     */
    public function updateFile(Request $request)
    {
        if ($request->hasFile('uface')) {
            //创建上传对象
            $uface = $request->file('uface');
            //修改上传文件名称
            $name = $uface->extension();
            $FileName = time() . rand(100, 1234);
            $FileName = $FileName . '.' . $name;
            //执行上传文件
            $path = $uface->storeAs('/' . date('Ymd', time()), $FileName);
            //返回上传文件名称
            echo $path;
        }
    }

    /**
     * 显示用户添加页面
     */
    public function create()
    {
        //引导模板
        return view('/admin/user/create');
    }

    /**
     * 接收添加用户信息
     */
    public function store(Request $request)
    {
        //接收所有值
        $data = $request->except('upwd1');
        //判断密码和确认密码是否一致
        if ($request->input('upwd1') !== $data['upwd']) exit('两次密码必须一致');
        //判断各项是否为空
        if (!$data['uname'] || !$data['upwd'] || !$data['uface'] || !$data['_token']) exit('请确保各项值不为空');

        //创建模型写入数据到数据库并判断是否添加成功
        $user = new users;
        $user->uname = $data['uname'];
        $user->upwd = Hash::make($data['upwd']);
        $user->uface = $data['uface'];
        $user->uip = $_SERVER['REMOTE_ADDR'];
        $user->_token = $data['_token'];
        try {
            $path = $user->save();
            if ($path) {
                //获取新添加数据id写入用户详情表user_info中的uid
                $uid = $user->id;
                $user_info = new user_infos;
                $user_info->uid = $uid;
                $user_info->save();
                exit('添加成功');
            } else {
                exit('添加失败');
            }
        } catch (\Exception $e) {
            echo '用户名已存在';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改页面(用户详情)
     */
    public function edit($id)
    {
        //通过id获取用户信息
        $user = users::find($id);
        //一对一关系查询用户详情表(模型查询)
        $userinfo = $user->userinfo;
        //引导模板
        return view('/admin/user/edit', ['user' => $user, 'userinfo' => $userinfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除用户
     */
    public function destroy(Request $request)
    {
        //接收传值
        $uid = $request->input('id');
        //执行删除操作
        $user = users::destroy($uid);
        $user_info = DB::table('user_info')->where('uid', $uid)->delete();
        if ($user && $user_info) {
            echo '删除成功';
        } else {
            echo '删除失败';
        }
    }
}
