<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\feedbacks;

/**
 * 反馈管理
 */
class FeedbackController extends Controller
{
    /**
     * 显示反馈管理 列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索的参数
        $search = $request->input('search','');

        // 查询所有数据
        $feedbacks = FeedBacks::where('uname','like','%'.$search.'%')->paginate(5);

        // 加载 反馈列表页面
        return view('admin.feedback.index',['feedbacks'=>$feedbacks,'search'=>$search]);
    }

    /**
     * 显示 添加反馈页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 渲染 添加反馈页面
        return view('/admin/feedback/create');
    }

    /**
     * 执行 添加反馈操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取表单提交的值
        $data = $request->all();

        // 判断所给的值是否为空
        if($data['uname'] == false){
            exit('用户名不能为空');
        }

        // 判断反馈信息是否为空
        if($data['feedback_info'] == false){
            exit('反馈信息不能为空');
        }

        //创建模型写入数据到数据库并判断是否添加成功
        $feedbacks = new FeedBacks;
        $feedbacks->uname = $data['uname'];
        $feedbacks->feedback_info = $data['feedback_info'];

        // 存入数据库
        $feedbacks->save();
        
        // 判断成功与否
        if ($feedbacks) {
            exit('添加成功');
        } else {
            exit('添加失败');
        }

    }

    /**
     * 显示页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示 详情页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // 查询该记录所有数据
        $feedbacks = Feedbacks::find($id);

        // 渲染详情页面
        return view('admin.feedback.edit',['feedbacks'=>$feedbacks]);
    }

    /**
     * 执行 修改反馈操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除 一条反馈记录
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // $data = $request->all();
        // dd($data);
        // 接收到ajax提交的id参数
        $feedbacks = FeedBacks::find($id);

        // 删除数据库中该id的反馈信息
        $res = $feedbacks->delete();

        // 判断并返回给ajax
        if ($res) {
            echo 'ok';
        } else {
            echo 'err';
        }
        
    }
}
