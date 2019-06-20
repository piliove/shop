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
    public function index(Request $request)
    {
         //接收搜索传值
        $search = $request->input('search', null);
        $data = [
        //  ['id', 'like', '%' . $search . '$'],
            ['title', 'like', '%' . $search . '%'],

        ];
        //查询所有用户数据
        $banners = Banners::where($data)->orderBy('id')->paginate(3);

        return view('admin.banners.index',['banners'=>$banners, 'search' => $search]);
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
        $banners = $request->except('_token');

        $res = DB::table('banners')->insert($banners);

        if($res) {
            exit('添加成功');
        } else {
            exit('添加失败');
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
    public function update(Request $request)
    {
        //接收修改表单所有值
        $data = $request->all();

        // 实例化goods模型
        $banners = banners::find($data['id']);

        //判断token是否一致
        if ($banners->_token !== $data['token']) exit('验证失败');

        //判断各项是否为空
        if (!$data['title'] || !$data['url']) exit('请确保各项值不为空');

        // 将数据存入数据库
        $banners->title = $data['title'];
        $banners->url = $data['url'];

        $path = $banners->save();
        if ($path) {
            exit('修改成功');
        } else {
            exit('修改失败');
        }
    }

    /**
     * 执行删除 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         //接收传值
        $id = $request->input('id');
        //查询id对应用户
        $img = Banners::find($id);
        //执行删除操作
        $banners = Banners::destroy($id);
        if ($banners) {
            echo '删除成功';
            //删除查询出的用户头像
            Storage::delete($img->url);
        } else {
            echo '删除失败';
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
