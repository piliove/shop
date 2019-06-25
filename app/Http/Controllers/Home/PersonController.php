<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\CartController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Users;
use App\Models\UserInfos;
use Illuminate\Support\Facades\Storage;

class PersonController extends Controller
{
    /**
     * 显示个人中心
     */
    public function index()
    {
        $countCart = CartController::countCart();
        // 渲染 个人中心首页
        return view('home.person.index', ['countCart' => $countCart, 'title' => '个人中心']);
    }

    /**
     * 显示个人资料
     */
    public function infos()
    {
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();
        $uid = session('IndexUser')->uid;
        $user = DB::table('users as u')
            ->join('user_info as ui', 'u.id', 'ui.uid')
            ->where('ui.uid', $uid)
            ->first();
        return view('/home/person/infos', ['countCart' => $countCart, 'title' => '用户信息', 'user' => $user]);
    }

    /**
     * 文件上传
     */
    public function updateFile(Request $request)
    {
        //判断是否有文件上传
        if ($request->hasFile('uface')) {
            //获取文件
            $uface = $request->file('uface');
            //获取后缀
            $name = $uface->extension();
            //设置前缀
            $fileName = date('Ymd', time()) . rand(1000, 1234);
            //设置文件名称
            $fileName = $fileName . '.' . $name;
            //执行文件上传
            $path = $uface->storeAs('/' . date('Ymd', time()), $fileName);
            echo $path;
        }
    }

    /**
     * 接收个人资料页面修改信息
     */
    public function UpdateInfos(Request $request)
    {
        $id = session('IndexUser')->uid;
        $uname = $request->input('uname', '');
        $token = $request->input('token', '');
        $name = $request->input('name', '');
        $qq = $request->input('qq', '');
        $uface = $request->input('uface', '');
        $sex = $request->input('sex', '');
        $age = $request->input('age', '');
        $addr = $request->input('addr', '');
        //判断是否有空值
        if (empty($uname) || empty($name) || empty($qq) || empty($age)) exit('请确保各项不为空');
        //正则验证用户名格式
        if (!preg_match('/^[a-zA-z]\w{3,15}$/', $uname)) exit('用户名格式不正确');//字母,数字,下划线组成,字母开头,4-16位
        //开启事务
        DB::beginTransaction();
        //通过模型查询id对应数据
        $user = Users::find($id);
        //判断是否上传头像
        if (empty($uface)) {
            $uface = $user->uface;
        } else {
            $uface = $request->input('uface');
            //删除头像文件
            Storage::delete($user->uface);
        }
        //判断token是否一致
        if ($token !== $user->_token) exit('验证失败');
        //执行user表修改命令
        $user->uname = $uname;
        $user->uface = $uface;
        $user_status = $user->save();
        //通过id查询user_info表数据执行修改操作
        $userinfo = UserInfos::where('uid', $id)->first();
        $userinfo->name = $name;
        $userinfo->addr = $addr;
        $userinfo->qq = $qq;
        //判断年龄数值大小
        if ($age < 0 || $age > 150) exit('年龄参数不合法');
        $userinfo->age = $age;
        $userinfo->sex = $sex;
        $userinfo_status = $userinfo->save();
        if ($user_status && $userinfo_status) {
            //提交事务
            DB::commit();
            echo '修改成功';
        } else {
            //回滚事务
            DB::rollBack();
            echo '修改失败';
        }
    }

}
