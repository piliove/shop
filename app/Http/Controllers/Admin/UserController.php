<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\UserInfos;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DB;

class UserController extends Controller
{
    /**
     * 显示用户首页
     */
    public function index(Request $request)
    {
        //接收搜索传值
        $search = $request->input('search', null);
        $data = [
            //  ['id', 'like', '%' . $search . '$'],
            ['uname', 'like', '%' . $search . '%'],

        ];
        //查询所有用户数据
        $users = Users::where($data)->orderBy('id')->paginate(3);
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
        try {
            //接收所有值
            $data = $request->except('upwd1');
            //判断密码和确认密码是否一致
            if ($request->input('upwd1') !== $data['upwd']) exit('两次密码必须一致');
            //判断各项是否为空
            if (empty($data['uname']) || empty($data['upwd']) || empty($data['uface'])) exit('请确保各项值不为空');

            //创建模型写入数据到数据库并判断是否添加成功
            //开启事务
            DB::beginTransaction();
            $user = new Users;
            $user->uname = $data['uname'];
            $user->upwd = Hash::make($data['upwd']);
            $user->uface = $data['uface'];
            $user->uip = $_SERVER['REMOTE_ADDR'];
            $user->_token = date('Ymd', time()) . rand(1000, 10000);
            $path = $user->save();
            //获取新添加数据id写入用户详情表user_info中的uid
            $uid = $user->id;
            $user_info = new UserInfos;
            $user_info->uid = $uid;
            $user_info->save();
            if ($path && $user_info) {
                //提交事务
                DB::commit();
                exit('添加成功');
            } else {
                //回滚事务
                DB::rollBack();
                exit('添加失败');
            }
        } catch (\Exception $e) {
            echo '用户名已存在';
        }

    }

    /**
     * 显示修改页面(用户详情)
     */
    public function edit($id)
    {
        //通过id获取用户信息
        $user = Users::find($id);
        //一对一关系查询用户详情表(模型查询)
        $userinfo = $user->userinfo;
        //引导模板
        return view('/admin/user/edit', ['user' => $user, 'userinfo' => $userinfo]);
    }

    /**
     * 接收修改用户传值
     */
    public function update(Request $request)
    {
        //接收修改表单所有值
        $data = $request->all();
        //查询出对应ID的users和userinfos的数据库
        $user = Users::find($data['id']);
        $userinfo = UserInfos::where('uid', $data['id'])->first();
        //判断token是否一致
        if ($user->_token !== $data['token']) exit('验证失败');
        //判断头像是否有修改
        if (empty($data['uface'])) {
            $data['uface'] = $user->uface;
        } else {
            //删除查询出的用户头像
            Storage::delete($user->uface);
            $data['uface'];
        }
        //age的值不能超出范围
        if ($data['age'] < 0 || $data['age'] >= 150) exit('年龄范围不合法');
        //判断是否有空值
        if (empty($data['uname']) || empty($data['name']) || empty($data['email']) || empty($data['phone']) || empty($data['age']) || empty($data['qq']) || empty($data['addr'])) exit('请确保所有选项不为空');

        //开启事务
        DB::beginTransaction();
        //将需要修改的值写入users表
        $user->uname = $data['uname'];
        $user->uface = $data['uface'];
        $user->status = $data['status'];
        $user_status = $user->save();
        //将需要修改的值写入userinfos表
        $userinfo->name = $data['name'];
        $userinfo->addr = $data['addr'];
        $userinfo->email = $data['email'];
        $userinfo->phone = $data['phone'];
        $userinfo->qq = $data['qq'];
        $userinfo->age = $data['age'];
        $userinfo->sex = $data['sex'];
        $userinfo_status = $userinfo->save();
        if ($user_status && $userinfo_status) {
            echo '修改成功';
            //提交事务
            DB::commit();
        } else {
            echo '修改失败';
            //回滚事务
            DB::rollBack();
        }
    }

    /**
     * 修改用户密码
     */
    public function upwd()
    {
        return view('/admin/user/upwd');
    }

    /**
     * 接收修改密码值
     */
    public function cpwd(Request $request)
    {
        //接收除token外所有值
        $data = $request->except('_token');
        //判断ID是否为空
        if (empty($data['id'])) exit('用户ID不能为空');
        //判断是否有空项
        if (empty($data['upwd']) || empty($data['upwd1'])) exit('请确保各项不为空');

        //判断两次密码是否一致
        if ($data['upwd'] !== $data['upwd1']) exit('两次密码不一致');
        //将修改的密码写入数据库中,并验证是否修改成功
        $user = Users::find($data['id']);
        $user->upwd = Hash::make($data['upwd']);
        $status = $user->save();
        if ($status) {
            echo('修改成功');
        } else {
            echo('修改失败');
        }
    }

    /**
     * 删除用户
     */
    public function destroy(Request $request)
    {
        //接收传值
        $uid = $request->input('id');
        //查询id对应用户
        $img = Users::find($uid);
        //执行删除操作
        $user = Users::destroy($uid);
        $user_info = DB::table('user_info')->where('uid', $uid)->delete();
        if ($user && $user_info) {
            echo '删除成功';
            //删除查询出的用户头像
            Storage::delete($img->uface);
        } else {
            echo '删除失败';
        }
    }
}
