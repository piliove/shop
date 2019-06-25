<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ws_system;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    /**
     * 显示主页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('admin.wsSystem.index',['ws_data'=>Ws_system::find(1)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       //验证规则
       $this->validate($request,[
            'title'=>'max:20'
       ],[
            'title.max'=>'字段长度不能超过20'
        ]);
        
        //通过验证后,实例化模型
        $wsSystem = Ws_system::find(1);

        //测试头像是否1上传上来
        if ($request->hasFile('profile')) {
            //获得原图片路径,删除
            $path = $wsSystem->ws_path;
            Storage::delete('$path');
            Storage::deleteDirectory('temp');
            
            //开始压入新图片路径
            $wsSystem->ws_path = $request->file('profile')->store(date('Ymd'));

        }

         //实例化模型,开始压入数据      
        $wsSystem->ws_title = $request->input('title');
        $wsSystem->ws_footMsg = $request->input('footMsg');
        $wsSystem->ws_desc = $request->input('desc');
        $res = $wsSystem->save();

        //判断
        if ($res) {
            session(['site_msg'=>'修改成功']);
            return back();
        } else {
            session(['site_msg'=>'修改失败']);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * 异步 改变消息
     *
     * @param  
     * 
     */
    public function change(Request $request)
    {
        if ($request->input('msg')) {
            session(['site_msg'=>null]);
        }
    }
}
