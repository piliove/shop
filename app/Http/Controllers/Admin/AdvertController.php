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
    public function index()
    {
        $advert = DB::table('advert')->get();
        return view('admin.advert.index',['advert'=>$advert]);
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
         //验证 表单传入值
        $this->validate($request, [
            'advert_title' => 'required|max:20',
            'activity_desc'  => 'required|max:255',
            'url' => 'required',
            
        ],[
            'advert_title.required'=>'广告标题必须有',
            'advert_title.max'=>'不可超过20个字',
            'activity_desc.required'=>'广告描述必须有',
            'activity_desc.max'=>'不可超过255个字',
            'url.required'=>'图片必填',
        ]);
        
        // 验证 图片
        if ($request->hasFile('url')) {
            $url = $request->file('url')->store(date('Ymd')); 
        } else {
            return back()-> with('error','请选择图片');
        }

        $advert['advert_title'] = $request->input('advert_title','');
        $advert['activity_desc'] = $request->input('activity_desc','');
        $advert['activity_status'] = $request->input('activity_status','');
        $advert['created_at'] = date('Y-m-d H:i:s',time());
        $advert['url'] = $url;

        $res = DB::table('advert')->insert($advert);

        if($res){
            return redirect('admin/advert')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
    public function update(Request $request, $id)
    {
         //验证 表单传入值
        $this->validate($request, [
            'advert_title' => 'required|max:20',
            'activity_desc'  => 'required|max:255',
            'url' => 'required',
            
        ],[
            'advert_title.required'=>'广告标题必须有',
            'advert_title.max'=>'不可超过20个字',
            'activity_desc.required'=>'广告描述必须有',
            'activity_desc.max'=>'不可超过255个字',
            'url.required'=>'图片必填',
        ]);

         if($request->hasFile('url')){
            $url = $request->file('url')->store(date('Ymd'));
        }else{
            $url = $request->input('url');
        }

        $advert['advert_title'] = $request->input('advert_title','');
        $advert['activity_desc'] = $request->input('activity_desc','');
        $advert['url'] = $url;
         
        // 执行修改
        $res = DB::table('advert')->where('id',$id)->update($advert);
        if($res){
            return redirect('admin/advert')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
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
        $res = Advert::destroy($id);
        if ($res) {
            return back()->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
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
