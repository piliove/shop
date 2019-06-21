<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\Users;
use App\Models\UserInfos;
use Illuminate\Support\Facades\Hash;
use Mail;
use DB;
use Captcha;

class RegController extends Controller
{


    /**
     * 显示注册页面
     */
    public function index()
    {
        return view('/home/reg');
    }

    /**
     * 接收邮箱注册信息并发送邮件
     */
    public function upEmail(Request $request)
    {
        try {
            $email = $request->input('email');
            $upwd = $request->input('email_upwd');
            $upwd1 = $request->input('email_upwd1');
            $agree = $request->input('agree1');
            $uname = str_random(5) . rand(100, 999);
            $token = date('Ymd', time()) . rand(1000, 10000);

            //检查是否有空值
<<<<<<< HEAD
            if (empty($email) || empty($upwd) || empty($upwd1)) exit('请确保每项不为空');
=======
            if (empty($email) && empty($upwd) && empty($upwd1)) exit('请确保每项不为空');
>>>>>>> origin/muyinya
            //正则验证邮箱
            if (!preg_match('/^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/', $email)) exit('邮箱号码格式不正确');//验证邮箱
            //正则检查密码是否符号要求
            if (!preg_match('/(?=.{6,12})(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*/', $upwd)) exit('密码格式不正确');//须包含大小写字母和数字，且长度在6-12之间
            //检查两次密码是否一致
            if ($upwd !== $upwd1) exit('两次密码不一致');
            //验证验证码
            if (!Captcha::check($request->input('captcha'))) exit('验证码错误');
            //判断是否勾选协议
            if (empty($agree)) exit('请勾选同意商城协议');

            //开启事务
            DB::beginTransaction();

            //写入users表单
            $user_data['upwd'] = Hash::make($upwd);
            $user_data['uname'] = $uname;
            $user_data['_token'] = $token;
            $user_data['status'] = 0;
            $user = DB::table('users')->insertGetId($user_data);
            //写入UserInfos表单
            $userinfo_data['email'] = $email;
            $userinfo_data['uid'] = $user;
            $userinfo = DB::table('user_info')->insert($userinfo_data);
            $redis_token = Redis::setex($uname, 600, $token);
            if ($user && $userinfo) {
                //发送邮件
                Mail::send('/email', ['uname' => $uname, 'user' => $user, 'token' => $token], function ($m) use ($email) {
                    $m->to($email)->subject('HelloWorld!');
                });
                //提交事务
                DB::commit();
                exit('注册成功');
            } else {
                //回滚事务
                DB::rollBack();
                exit('注册失败');
            }
        } catch (Exception $e) {
            //回滚事务
            DB::rollBack();
            exit('用户名已存在');
        }
    }

    /**
     * 发送验证码
     */
    public function upPhone(Request $request)
    {
        $phone = $request->input('phone', '');
        $code = rand(1234, 9999);
        redis::setex($phone, 600, $code);
        //判断是否为空
        if (empty($phone)) exit('手机号码不能为空');
        if (!preg_match('/^1\d{2,3}-?\d{7,8}$/', $phone)) exit('手机号码格式不正确');//11位数字，以1开头
        $url = "http://v.juhe.cn/sms/send";
        $params = array(
            'key' => '98061437b0af973baba63246267c663c', //您申请的APPKEY
            'mobile' => $phone, //接受短信的用户手机号码
            'tpl_id' => '166025', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' => '#code#=' . $code //您设置的模板变量，根据实际情况修改
        );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
        echo $content;
    }

    /**
     * 接收手机注册页面信息
     */
    public function regPhone(Request $request)
    {
        //接收密码和手机号码
        $data['upwd'] = $request->input('upwd');
        $data['phone'] = $request->input('phone');
        $agree = $request->input('agree');
        //接收验证码
        $code = $request->input('code');
        //检查是否有空项
<<<<<<< HEAD
        if (empty($data['phone']) || empty($data['upwd']) || empty($code)) exit('请确保每项不为空');
=======
        if (empty($data['phone']) && empty($data['upwd']) && empty($code)) exit('请确保每项不为空');
>>>>>>> origin/muyinya
        //验证验证码
        if ($code !== redis::get($data['phone'])) exit('验证码错误');
        //验证两次密码是否一致
        if ($data['upwd'] !== $request->input('upwd1')) exit('密码不一致');
        //正则检查密码
        if (!preg_match('/(?=.{6,12})(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*/', $data['upwd'])) exit('密码格式不正确');//须包含大小写字母和数字，且长度在6-12之间
        //验证是否勾选同意商城协议
        if (empty($agree)) exit('请同意商城协议后再提交注册');

        try {
            //若以上判断通过则添加数据且判断是否添加成功
            //添加密码至users表
            //开启事务
            DB::beginTransaction();
            $user = new Users;
            $user->upwd = Hash::make($data['upwd']);
            $user->uip = $_SERVER['REMOTE_ADDR'];
            $user->uname = str_random(5) . rand(100, 999);
            $user->_token = date('Ymd', time()) . rand(1000, 10000);
            $user_status = $user->save();
            //添加手机号至user_infos表
            $userinfo = new UserInfos;
            $userinfo->phone = $data['phone'];
            $userinfo->uid = $user->id;
            $userinfo_status = $userinfo->save();
            if ($user_status && $userinfo_status) {
                //提交事务
                DB::commit();
                exit ('注册成功');
            } else {
                //回滚事务
                DB::rollBack();
                echo '注册失败';
            }
        } catch (\Exception $e) {
            //回滚事务
            DB::rollBack();
            echo '手机号码已存在';
        }

    }

    /**
     * 显示邮箱激活页面
     */
    public function email($id, $token, $uname)
    {
        //判断token是否和redis保存的token一致
        if ($token !== Redis::get($uname)) return redirect('/');
        //执行激活
        DB::table('users')->where('id', $id)->update(['status' => 1]);
        $data = DB::table('users')->where('id', $id)->first();
        //渲染激活页面
        return view('/staEmail', ['data' => $data]);
    }

    /**
     * 请求接口返回内容
     * @param string $url [请求的URL地址]
     * @param string $params [请求的参数]
     * @param int $ipost [是否采用POST形式]
     * @return  string
     */
    public static function juheCurl($url, $params = false, $ispost = 0)
    {
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        $response = curl_exec($ch);
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
}
