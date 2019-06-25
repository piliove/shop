<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //接收搜索传值
        $search = $request->input('search', null);
        $data = [
        //  ['id', 'like', '%' . $search . '$'],
            ['bname', 'like', '%' . $search . '%'],

        ];
        //查询所有用户数据
        $blog = Blog::where($data)->orderBy('id')->paginate(3);

        return view('admin.blog.index',['blog'=>$blog, 'search' => $search]);
    }
    
    /**
     * 接收上传头像
     */
    public function updateFile(Request $request)
    {
        if ($request->hasFile('ufate')) {
            //创建上传对象
            $ufate = $request->file('ufate');
            //修改上传文件名称
            $name = $ufate->extension();
            $FileName = time() . rand(100, 1234);
            $FileName = $FileName . '.' . $name;
            //执行上传文件
            $path = $ufate->storeAs('/' . date('Ymd', time()), $FileName);
            //返回上传文件名称
            echo $path;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取新闻所有数据
        $blog = Blog::all();

        return view('admin.blog.create',['blog'=>$blog]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          //接收所有值
        $data = $request->all();

        //判断各项是否为空
        if (empty($data['bname']) || empty($data['title']) || empty($data['ufate']) || empty($data['bdesc'])) exit('请确保各项值不为空');
        
        //创建模型写入数据到数据库并判断是否添加成功
        // 实例化goods模型
        $blog = new Blog;

        // 将数据存入数据库
        $blog->bname = $data['bname'];
        $blog->title = $data['title'];
        $blog->ufate = $data['ufate'];
        $blog->bdesc = $data['bdesc'];
        
            $path = $blog->save();
            if ($path) {
                exit('添加成功');
            } else {
                exit('添加失败');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 获取新闻所有数据
        $blog = Blog::find($id);

        return view('admin.blog.edit',['blog'=>$blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //接收修改表单所有值
        $data = $request->all();

        // 实例化goods模型
        $blog = Blog::find($data['id']);

        //判断token是否一致
        if ($blog->_token !== $data['token']) exit('验证失败');

        //判断各项是否为空
        if (empty($data['bname']) || empty($data['title']) || empty($data['ufate']) || empty($data['bdesc'])) exit('请确保各项值不为空');

        // 将数据存入数据库
        $blog->title = $data['title'];
        $blog->ufate = $data['ufate'];
        $blog->bdesc = $data['bdesc'];
        $path = $blog->save();
        if ($path) {
            exit('修改成功');
        } else {
            exit('修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         //接收传值
        $id = $request->input('id');
        //查询id对应用户
        $img = Blog::find($id);
        //执行删除操作
        $blog = Blog::destroy($id);
        if ($blog) {
            echo '删除成功';
            //删除查询出的用户头像
            Storage::delete($img->ufate);
        } else {
            echo '删除失败';
        }
    }
}
