<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//正则验证表单
use App\Http\Requests\StoreCate;
//模型
use App\Models\Cates;
use DB;

class CateController extends Controller
{
    /**
     * 分类 主页面 显示
     *
     * @return 第21行
     * @return_param cates_data(栏目数据)
     */
    public function index(Request $request)
    {
       $search_key = $request->input('search_key','');

        return view('admin.cate.index',['cates_data'=>self::cateData_all($search_key)]);
    }

    /**
     * 显示 添加 页面
     *
     * @return 第32行
     */
    public function create(Request $request)
    {
        $id = $request->input('id');
        return view('admin.cate.create',['id'=>$id, 'cates_data'=>self::cateData_all()]);
    }

    /**
     * 执行 添加 操作
     *
     * @param  Request(cname(添加的栏目名), pid(父id))
     * @return 第70行
     * @return session('cate_msg')(返回前台的提醒)
     */
    public function store(StoreCate $request)
    {
        //通过表单验证后,开始装填数据
        $cates = new Cates();
        //栏目名
        $cname = $request->input('cname','');
        //父类id
        $pid = $request->input('pid',0);

        //根据是一级分类,或者是下级分类,分别压入路径
        if ($pid == 0) {
            //一级分类 压入路径为0
            $path = 0;
        } else {
            //下级分类
            $path = Cates::find($pid)->path.','.$pid;
        }
        //压入数据,准备保存
        $cates->cname = $cname;
        $cates->pid = $pid;
        $cates->path = $path;
        //保存数据
        $res = $cates->save();

        //判断结果
        if ( $res ) {
            session(['cate_msg'=>'添加成功']);
            return redirect('/admin/cate');
        } else {
            session(['cate_msg'=>'添加失败']);
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
    public function update(Request $request, $id)
    {
        //
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
     * 修改 通知状态
     *
     * @param  Request(msg(前台返回的信息))
     * 
     */
    public function change(Request $request)
    {
        //修改状态
        if ($request->input('msg')) {
            session(['cate_msg'=>null]);
        }

    }

    /**
     * 修饰 栏目数据
     *
     * @param  $search(搜索的关键词)
     * @return $data(一段修饰好的栏目数据)
     */
    private static function cateData_all($search='')
    {
        //获取数据库数据
        $data = Cates::where('cname','like','%'.$search.'%')->select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths')->get();
        //遍历改变标题样式
        foreach ($data as $k => $v) {
            //修改后的名字
            $n = substr_count($v->path,',');
            $data[$k]['cname'] = str_repeat('|----',$n).$v->cname;
        }
        return $data;
    }

    
}
