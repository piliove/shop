<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// 使用comment模板
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request)
    {
    	// 查询所有数据
        $comment = Comment::all();
        return view('home.comment.index',['comment'=>$comment]);
    }
     /**
     * 接收上传头像
     */
    public function updateFile(Request $request)
    {
        if ($request->hasFile('cfate')) {
            //创建上传对象
            $cfate = $request->file('cfate');
            //修改上传文件名称
            $name = $cfate->extension();
            $FileName = time() . rand(100, 1234);
            $FileName = $FileName . '.' . $name;
            //执行上传文件
            $path = $cfate->storeAs('/' . date('Ymd', time()), $FileName);
            //返回上传文件名称
            echo $path;
        }
    }
    /**
     * 添加操作
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.comment.create');
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收所有值
        $data = $request->all();
       
        //判断各项是否为空
        if ( empty($data['content']) || empty($data['cfate']) || empty($data['Comm_status'])) exit('请确保各项值不为空');
        
        //创建模型写入数据到数据库并判断是否添加成功
        // 实例化comment模型
        $comment = new Comment;

        // 将数据存入数据库
        $comment->content = $data['content'];
        $comment->cfate = $data['cfate'];
        $comment->Comm_status = $data['Comm_status'];
            $path = $comment->save();
            if ($path) {
                exit('发表成功');
            } else {
                exit('发表失败');
            }
    }
}
