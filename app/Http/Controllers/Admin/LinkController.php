<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入上传
use StoreUsers;
//引入文件储存控制
use Illuminate\Support\Facades\Storage;
//引入模型 Links
use App\Models\Links;

class LinkController extends Controller
{
    /**
     * 显示首页 主页面
     *
     * @param Request(lname(链接名))
     * @return 第26行代码
     * @return_param $links_data(连接数据)
     */
    public function index(Request $request)
    {
        //获得搜索关键词(链接名)
        $search_key = $request->input('lname','');
        //实例化模型,取出数据
        $links_data = Links::where('lname','like','%'.$search_key.'%')->orderBy('id','asc')->paginate(7);

        return view('admin.link.index', ['links_data'=>$links_data, 'search_key'=>$search_key]);
    }

    /**
     * 显示添加 页面
     *
     * @return 第36行代码
     */
    public function create()
    {
        //return view('admin.link.create');
    }

    /**
     * 执行添加 操作
     *
     * @param  Request(lname(友情连接名), title(链接地址), thumb(链接图))
     * @return 第86行代码
     */
    public function store(Request $request)
    {
        //验证 表单传入值

        $this->validate($request, [
            'title'=>[
                'required',
                'regex:/^[A-Za-z0-9]{1,6}\.(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/',
                'max:128'
            ],
            'lname'=>'required|max:32',
            
        ],[
            'title.required'=>'链接地址必须有',
            'title.max'=>'不可超过128个字',
            'title.regex'=>'链接格式不合格',
            'lname.required'=>'链接地址必须有',
            'lname.max'=>'不可超过32个字',
        ]);

        
        //友情链接 名
        $lname = $request->input('lname');
        //友情链接 url地址
        $title = $request->input('title');
        //图片
        $thumb = $request->file('thumb');
        //下载图片到服务器
        if ($request->hasFile('thumb')) {
            //thumb(重赋值为路径)
            $thumb = $thumb->store(date('Ymd'));
        }
        
        //开始压入数据,links(实例化Links模型)
        $links = new Links;
        $links->title = $title;
        $links->lname = $lname;
        $links->thumb = $thumb;
        //res(开始记录结果)
        $res = $links->save();

        //判断结果
        if ($res) {
            //设置成功之后的消息
            session(['link_msg'=>'添加成功']);

            return redirect('/admin/link');
        } else {
            //设置失败之后的消息
            session(['link_msg'=>'添加失败']);

            return back();
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
        //
    }

    /**
     * 显示 修改 页面
     *
     * @param   id(被修改id值)
     * @return 第129行代码
     * @return_param $links_data(被修改的记录值)
     */
    public function edit($id)
    {
        //找到需要修改的记录
        $links_data = Links::find($id);

        return $links_data;
    }

    /**
     * 执行 更新 操作
     *
     * @param  Request()
     * @param  int  $id
     * @return 第169行代码
     */
    public function update(Request $request, $id)
    {
        //验证 表单传入值
        $this->validate($request, [
            'title'=>[
                'required',
                'regex:/^[A-Za-z0-9]{1,6}\.(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+$/',
                'max:128'
            ],
            'lname'=>'required|max:32',
            
        ],[
            'title.required'=>'链接地址必须有',
            'title.max'=>'不可超过128个字',
            'title.regex'=>'链接格式不合格',
            'lname.required'=>'链接地址必须有',
            'lname.max'=>'不可超过32个字',
        ]);

        //开始修改数据,links(实例化Links模型)
        $links = Links::find($id);  

        //友情链接 名
        $links->lname = $request->input('lname');
        //友情链接 url地址
        $links->title = $request->input('title');       
        //下载图片到服务器
        if ($request->hasFile('thumb')) {
            
            //删除旧图片
            $thumb = $links->thumb;
            Storage::delete($thumb);

            //压入新图片路径
            $thumb = $request->file('thumb')->store(date('Ymd'));
            $links->thumb = $thumb;
        }

        //res(开始记录结果)
        $res = $links->save();

        //判断结果
        if ($res) {
            session(['link_msg'=>'修改成功']);
            
            return redirect('/admin/link');
        } else {
            session(['link_msg'=>'修改失败']);

            return back();
        }


    }

    /**
     * 执行 删除 操作
     *
     * @param  id(被删除的记录id)
     * @return 第190行
     */
    public function destroy($id)
    {
        //获得图片路径
        $links = Links::find($id);
        $thumb = $links->thumb;

        //检查是否有图片
        $exists = Storage::disk('local')->exists($thumb);

        //若有图片,则直接删除
        if ($exists) {
            Storage::delete($thumb);
        }

        //直接删除
        $res = Links::destroy($id);

        //直接返回结
        if ($res) {            
            return json_encode(['flag'=>true, 'info'=>'删除成功']);
        } else {
            return json_encode(['flag'=>false, 'info'=>'删除失败']);
        }
    }

    /**
     * 执行 转变状态 操作
     *
     * @param  Request(msg(标识符))
     * 
     */
    public function change(Request $request)
    {
        if ($request->input('msg')) {
            session(['link_msg'=>null]);
        }
    }
  
}
