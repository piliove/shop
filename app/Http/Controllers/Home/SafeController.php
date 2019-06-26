<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CartController;
use App\Models\Users;
use App\Models\UserInfos;
use Hash;
use DB;
use Illuminate\Support\Facades\Redis;
use Mail;

class SafeController extends Controller
{
    /**
     * 安全设置页面
     */
    public function index()
    {
        $countCart = CartController::countCart();
        $id = session('IndexUser')->uid;
        //通过$id查询用户信息
        $user = DB::table('users as u')
            ->join('user_info as ui', 'u.id', 'ui.uid')
            ->where('ui.uid', $id)
            ->first();
        //判断手机号码是否为空
        $phone = $user->phone;
        if (empty($phone)) {
            $phone = '暂未绑定手机';
        } else {
            $phone = substr($user->phone, 0, 3) . '********';
        }
        //判断邮箱是否为空
        $email = $user->email;
        if (empty($email)) {
            $email = '暂未绑定邮箱';
        } else {
            $email = substr($user->email, 0, 4) . '*******';
        }
        //查询会员等级
        $member = DB::table('member')->where('uid', $id)->first();
        return view('/home/safe/index', ['title' => '安全设置', 'countCart' => $countCart, 'user' => $user, 'phone' => $phone, 'email' => $email,'member'=>$member]);
    }

    /**
     * 修改密码页面
     */
    public function upwd()
    {
        $countCart = CartController::countCart();
        return view('/home/safe/upwd', ['title' => '修改密码', 'countCart' => $countCart]);
    }

    /**
     * 接收修改密码页面
     */
    public function UpdateUpwd(Request $request)
    {
        //接收表单信息
        $id = session('IndexUser')->uid;
        $start_upwd = $request->input('start_upwd', '');
        $upwd = $request->input('upwd', '');
        $upwd1 = $request->input('upwd1', '');
        if (!preg_match('/(?=.{6,12})(?=.*[a-z])(?=.*[A-Z])(?=.*\d).*/', $upwd)) exit('密码格式不正确');//须包含大小写字母和数字，且长度在6-12之间
        //判断两次密码是否一致
        if ($upwd !== $upwd1) exit('两次密码不一致');
        $user = Users::find($id);
        //判断原密码是否正确
        if (!Hash::check($start_upwd, $user->upwd)) exit('原密码错误');
        //提交密码修改
        $user->upwd = Hash::make($upwd);
        $user_status = $user->save();
        //判断是否修改成功
        if ($user_status) {
            session(['IndexLogin' => false]);
            session(['IndexUser' => false]);
            echo '修改成功';
        } else {
            echo '修改失败';
        }
    }

    /**
     *手机换绑页面
     */
    public function phone()
    {
        $countCart = CartController::countCart();
        $id = session('IndexUser')->uid;
        //通过$id获取数据
        $user = UserInfos::where('uid', $id)->first();
        $phone = $user->phone;
        if (empty($phone)) {
            $phone = '暂未绑定手机';
        } else {
            $phone = substr($user->phone, 0, 3) . '****' . substr($user->phone, -4);
        }
        return view('/home/safe/phone', ['countCart' => $countCart, 'title' => '验证手机', 'phone' => $phone, 'user' => $user]);
    }

    /**
     * 接收原手机验证码
     */
    public function PhoneCode()
    {
        $id = session('IndexUser')->uid;
        //记录当前用户ID检查是否频繁发送验证码
        \Cookie::queue($id, 'code', 1);
        if (\Cookie::get($id) == 'code') exit(json_encode('发送频繁,请稍后再尝试发送'));
        //通过ID获取对应数据
        $user = UserInfos::where('uid', $id)->first();
        //判断手机号码是否为空
        if (empty($user->phone)) exit(json_encode('原手机未绑定'));
        //获取手机号码
        $phone = $user->phone;
        //生成验证码
        $code = rand(1000, 9999);
        //保存验证码到redis,有效时间十分钟
        Redis::setex($phone, 600, $code);
        //聚合短信接口
        $url = "http://v.juhe.cn/sms/send";
        $params = array(
            'key' => '47e57c25f8e081c045ea108c81af8848', //您申请的APPKEY
            'mobile' => $phone, //接受短信的用户手机号码
            'tpl_id' => '166571', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' => '#code#=' . $code, //您设置的模板变量，根据实际情况修改
        );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
        echo $content;
    }

    /**
     * 验证原手机验证码
     */
    public function testing(Request $request)
    {
        $id = session('IndexUser')->uid;
        //通过ID查询对应数据
        $user = UserInfos::where('uid', $id)->first();

        if (empty($user->phone)) {
            exit('验证成功');
        } else {
            //读取redis保存的验证码
            $code = Redis::get($user->phone);
            //接收表单发送的验证码
            $code1 = $request->input('code', '');
            //判断原手机验证码是否为空
            if (empty($code1)) exit('请输入原手机验证码');
            //判断原手机验证码是否和redis的一致
            if ($code !== $code1) exit('原手机验证码错误');
            exit('验证成功');
        }
    }

    /**
     * 发送新手机验证码
     */
    public function PhoneCode1(Request $request)
    {
        $id = session('IndexUser')->uid;
        //记录当前用户ID检查是否频繁发送验证码
        \Cookie::queue($id, 'code1', 1);
        if (\Cookie::get($id) == 'code1') exit(json_encode('发送频繁,请稍后再尝试发送'));
        $user = UserInfos::where('uid', $id)->first();
        //接收表单传值的手机号码
        $phone = $request->input('phone', '');
        //判断新手机号码是否为空
        if (empty($phone)) exit(json_encode('手机号码不能为空'));
        //正则检查手机号码是否符合
        if (!preg_match('/^1\d{2,3}-?\d{7,8}$/', $phone)) exit(json_encode('手机号码格式错误'));//11位数字，以1开头
        //检查新手机号码与旧手机是否一养
        if ($phone == $user->phone) exit(json_encode('需修改手机号码与原号码相同'));
        //生成验证码
        $code = rand(1000, 9999);
        //redis保存验证码十分钟
        Redis::setex($phone, 600, $code);
        //聚合短信接口
        $url = "http://v.juhe.cn/sms/send";
        $params = array(
            'key' => '47e57c25f8e081c045ea108c81af8848', //您申请的APPKEY
            'mobile' => $phone, //接受短信的用户手机号码
            'tpl_id' => '166571', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' => '#code#=' . $code, //您设置的模板变量，根据实际情况修改
        );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
        echo $content;
    }

    /**
     * 接收修改手机表单
     */
    public function UpdatePhone(Request $request)
    {
        $id = session('IndexUser')->uid;
        //获取表单传值
        $phone = $request->input('phone', '');
        $code = $request->input('code2', '');
        //判断新手机号码是否为空
        if (empty($phone) || empty($code)) exit('手机号码和验证码不能为空');
        //判断验证码是否一致
        if (Redis::get($phone) !== $code) exit('验证码错误');
        //正则检查手机号码是否符合要求
        if (!preg_match('/^1\d{2,3}-?\d{7,8}$/', $phone)) exit('手机号码格式错误');//11位数字，以1开头
        //将新手机号码写入数据库
        $user = UserInfos::where('uid', $id)->first();
        $user->phone = $phone;
        $user_status = $user->save();
        //判断是否修改成功
        if ($user_status) {
            echo '修改成功';
        } else {
            echo '修改失败';
        }
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

    /**
     * 显示邮箱验证页面
     */
    public function email()
    {
        $countCart = CartController::countCart();
        return view('/home/safe/email', ['countCart' => $countCart, 'title' => '验证邮箱']);
    }

    /**
     * 接收邮箱,发送验证码
     */
    public function EmailCode(Request $request)
    {
        $id = session('IndexUser')->uid;
        //记录用户ID判断是否频繁发送邮件
        \Cookie::queue($id, 'EmailCode', 1);
        if (\Cookie::get($id) == 'EmailCode') exit('发送频繁,请稍后再尝试发送');
        //通过uid查询users表
        $user = UserInfos::where('uid', $id)->first();
        //判断昵称是否为空
        if (empty($user->name)) {
            $name = '';
        } else {
            $name = $user->name;
        }
        $email = $request->input('email', '');
        //判断邮箱是否为空
        if (empty($email)) exit('邮箱不能为空');
        //生成验证码
        $code = rand(1000, 9999);
        //保存验证码到redis十分钟
        Redis::setex($email, 600, $code);
        //发送邮件
        Mail::send('/EmailCode', ['code' => $code, 'name' => $name], function ($m) use ($email) {
            $m->to($email)->subject('邮箱验证码');
        });

        //判断是否发送成功
        $error = Mail::failures();
        if (empty($error)) {
            echo '发送成功';
        } else {
            echo '发送失败';
        }

    }

    /**
     * 接收邮箱验证页面传值
     */
    public function UpdateEmail(Request $request)
    {
        $id = session('IndexUser')->uid;
        //接收表单传值
        $email = $request->input('email', '');
        $code = $request->input('code', '');
        //判断是否为空
        if (empty($email) || empty($code)) exit('邮箱或验证码不能为空');
        //判断验证码是否正确
        if ($code !== Redis::get($email)) exit('验证码错误');
        //执行修改
        $user = UserInfos::where('uid', $id)->first();
        $user->email = $email;
        $user_status = $user->save();
        //判断是否修改成功
        if ($user_status) {
            echo '修改成功';
        } else {
            echo '修改失败';
        }
    }
}
