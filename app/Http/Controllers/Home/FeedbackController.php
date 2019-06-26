<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 使用Cart控制器的方法
use App\Http\Controllers\Home\CartController;

class FeedbackController extends Controller
{
    // 加载 反馈视图页面
    public function index()
    {
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();

        // 渲染 反馈管理页面
        return view('home.feedback.index',['countCart'=>$countCart,'title'=>'反馈留言']);
    }

    // 执行 添加反馈操作
    public function add(Request $request)
    {
        // 获取表单提交的数据
        $data['uname'] = $request->input('uname','');
        $data['feedback_info'] = $request->input('feedback_info','');
        $data['created_at'] = date('Y-m-d H:i:s',time());
        $data['updated_at'] = date('Y-m-d H:i:s',time());

        // 插入数据到数据库中
        $res = DB::table('feedback')->insert($data);
        
        // 判断成功与否
        if ($res) {
            echo "<script>alert('提交反馈成功');location.href='/home/feedback/index'</script>";
        } else {
            return back();
        }

    }
}
