<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Goods;
use App\Models\Cates;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use DB;

class GoodsController extends Controller
{
    /**
     * 显示 商品管理列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索的参数
        $search = $request->input('search','');

        // 查询所有数据
        $goods = Goods::where('gname','like','%'.$search.'%')->orderBy('rec_status','desc')->paginate(5);

        // 渲染 商品管理列表
        return view('admin.goods.index',['goods'=>$goods,'search'=>$search]);
    }

    /**
     * 接收上传头像
     */
    public function updateFile(Request $request)
    {
        if ($request->hasFile('uface')) {
            //创建上传对象
            $uface = $request->file('uface');
            //修改上传文件名称
            $name = $uface->extension();
            $FileName = time() . rand(100, 1234);
            $FileName = $FileName . '.' . $name;
            //执行上传文件
            $path = $uface->storeAs('/' . date('Ymd', time()), $FileName);
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
        // 获取商家管理的所有数据
        $business = Business::all();

        // 获取栏目管理的所有数据
        $cates = Cates::all();

        // 渲染 添加管理页面
        return view('admin.goods.create',['cates'=>$cates,'business'=>$business]);
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
        if (!$data['gname'] || !$data['gprice'] || !$data['gdesc'] || !$data['gtitle'] || !$data['gnum'] || !$data['gid'] || !$data['uface']) exit('请确保各项值不为空');
        
        //创建模型写入数据到数据库并判断是否添加成功
        // 实例化goods模型
        $goods = new Goods;

        // 将数据存入数据库
        $goods->gname = $data['gname'];
        $goods->gprice = $data['gprice'];
        $goods->gprice = $data['gprices'];
        $goods->gdesc = $data['gdesc'];
        $goods->gtitle = $data['gtitle'];
        $goods->gnum = $data['gnum'];
        $goods->gid = $data['gid'];
        $goods->cid = $data['cid'];
        $goods->gthumb_1 = $data['uface'];
        $goods->_token = date('ymd', time()) . rand(1000, 10000);

        try {
            $path = $goods->save();
            if ($path) {
                exit('添加成功');
            } else {
                exit('添加失败');
            }
        } catch (\Exception $e) {
            echo '用户名已存在';
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
        // 获取商品管理指定数据信息
        $goods = Goods::find($id);

        // 获取商家管理的指定数据
        $business = Business::find($goods->gid);

        // 获取栏目管理的所有数据
        $cate = Cates::all();

        // 渲染 添加管理页面
        return view('admin.goods.edit',['cate'=>$cate,'goods'=>$goods,'business'=>$business]);
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
        $goods = Goods::find($data['id']);

        //判断token是否一致
        if ($goods->_token !== $data['token']) exit('验证失败');

        //判断各项是否为空
        if ( !$data['gname'] && !$data['gprice'] && !$data['gdesc'] && !$data['gtitle'] && !$data['gnum'] && !$data['gid'] ) exit('请确保各项值不为空');
        //判断头像是否有修改
        if (empty($data['uface'])) {
            $data['uface'] = $goods->uface;
        } else {
            $data['uface'];
        }

        // 将数据存入数据库
        $goods->gname = $data['gname'];
        $goods->gprice = $data['gprice'];
        $goods->gprice = $data['gprices'];
        $goods->gdesc = $data['gdesc'];
        $goods->gtitle = $data['gtitle'];
        $goods->gnum = $data['gnum'];
        $goods->gid = $data['gid'];
        $goods->cid = $data['cid'];
        $goods->gthumb_1 = $data['uface'];
        $goods->_token = date('ymd', time()) . rand(1000, 10000);

        try {
            $path = $goods->save();
            if ($path) {
                exit('修改成功');
            } else {
                exit('修改失败');
            }
        } catch (\Exception $e) {
            echo '用户名已存在';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // 接收到ajax提交的id参数
        $goods = Goods::find($id);

        // 删除数据库中该id的反馈信息
        $res = $goods->delete();

        // 判断并返回给ajax
        if ($res) {
            echo 'ok';
        } else {
            echo 'err';
        }
    }

   
}
