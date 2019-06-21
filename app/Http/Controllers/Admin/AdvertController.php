<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Advert;
use DB;
class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search', null);
        $data = [
        //  ['id', 'like', '%' . $search . '$'],
            ['advert_title', 'like', '%' . $search . '%'],

        ];
        //查询所有用户数据
        $advert = Advert::where($data)->orderBy('id')->paginate(3);

        return view('admin.advert.index',['advert'=>$advert,'search'=>$search]);
    }
    
     /**
     * 接收上传头像
     */
    public function updateFile(Request $request)
    {
        if ($request->hasFile('url')) {
            //创建上传对象
            $url = $request->file('url');
            //修改上传文件名称
            $name = $url->extension();
            $FileName = time() . rand(100, 1234);
            $FileName = $FileName . '.' . $name;
            //执行上传文件
            $path = $url->storeAs('/' . date('Ymd', time()), $FileName);
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
        return view('admin.advert.create');
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
        $data = $request->except('_token');

        //创建模型写入数据到数据库并判断是否添加成功
        $advert = new Advert;
        $advert->advert_title = $data['advert_title'];
        $advert->activity_desc = $data['activity_desc'];
        $advert->activity_status = $data['activity_status'];
        $advert->url = $data['url'];
        $path = $advert->save();
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
         $advert = advert::find($id);

        return view('admin.advert.edit',['advert'=>$advert]);
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
        $advert = Advert::find($data['id']);

        //判断token是否一致
        if ($advert->_token !== $data['token']) exit('验证失败');

        //判断各项是否为空
        if (!$data['advert_title'] || !$data['activity_desc'] || !$data['url']) exit('请确保各项值不为空');

        // 将数据存入数据库
        $advert->advert_title = $data['advert_title'];
        $advert->activity_desc = $data['activity_desc'];
        $advert->url = $data['url'];

        $path = $advert->save();
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
        $img = Advert::find($id);
        //执行删除操作
        $advert = Advert::destroy($id);
        if ($advert) {
            echo '删除成功';
            //删除查询出的用户头像
            Storage::delete($img->url);
        } else {
            echo '删除失败';
        }
    }
     public function changeStatus(Request $request)
    {
        $activity_status = $request->input('activity_status');

        $id = $request->input('id');

        // 执行修改
       $res = DB::table('advert')->where('id',$id)->update(['activity_status'=>$activity_status]);
       if($res){
            return back()->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}
