<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Banners;
use DB;
class BannersController extends Controller
{
    /**
     * 列表页 主页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = DB::table('banners')->get();

        return view('admin.banners.index',['banners'=>$banners]);
    }

    /**
     * 显示添加 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * 执行添加 操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证数据
        $this->validate($request, [
            'title' => 'required|max:30',
            'url' => 'required',
        ],[
            'title.required'=>'标题必填',
            'phone.regex'=>'标题超出',
            'url.required'=>'图片必填',
        ]);
        if ($request->hasFile('url')) {
            $url = $request->file('url')->store(date('Ymd')); 
        } else {
            return back()-> with('error','请选择图片');
        }

        $banners['title'] = $request->input('title','');
        $banners['url'] = $url;
        $banners['status'] = $request->input('status','');

        $res = DB::table('banners')->insert($banners);

        if($res){
            return redirect('admin/banners')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    /**
     * 显示详情页
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banners = Banners::find($id);

        return view('admin.banners.edit',['banners'=>$banners]);
    }

    /**
     * 执行修改 页面
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 检查文件
         if($request->hasFile('url')){
            $url = $request->file('url')->store(date('Ymd'));
        }else{
            $url = $request->input('url');
        }

        //接受数据
        $banners['title'] = $request->input('title','');
        $banners['url'] = $url;

         // 执行修改
        $res = DB::table('banners')->where('id',$id)->update($banners);
        if($res){
            return redirect('admin/banners')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * 执行删除 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Banners::destroy($id);
        if ($res) {
            return back()->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }
    
    public function changeStatus(Request $request)
    {
        $status = $request->input('status');

        $id = $request->input('id');

        // 执行修改
       $res = DB::table('banners')->where('id',$id)->update(['status'=>$status]);
       if($res){
            return back()->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}
