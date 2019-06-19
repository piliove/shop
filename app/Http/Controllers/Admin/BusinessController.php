<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Goods;

/**
 * 商家 管理
 */
class BusinessController extends Controller
{
    /**
     * 显示 商家管理列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取Goods商品的所有数据
        $goods = Goods::all();

        // 接收搜索的参数
        $search = $request->input('search','');

        // 查询所有数据
        $business = Business::where('business_name','like','%'.$search.'%')->paginate(5);

        // 渲染 商家列表页面
        return view('admin.business.index',['goods'=>$goods,'business'=>$business,'search'=>$search]);
    }

    /**
     * 显示 添加商家 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 渲染 添加商家页面
        return view('admin.business.create');
    }

    /**
     * 执行 添加商家操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取表单提交的值
        $data = $request->all();

        // 判断所给的值是否为空
        if($data['bname'] == false){
            exit('用户名不能为空');
        }

        //创建模型写入数据到数据库并判断是否添加成功
        $business = new Business;
        $business->bname = $data['bname'];
        
        try {
            // 存入数据库
            $res = $business->save();
            // 判断成功与否
            if ($res) {
                exit('添加成功');
            } else {
                exit('添加失败');
            }
        } catch (\Exception $e) {
            echo '商品名称已存在';
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
     * 显示 修改商家页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询该记录所有数据
        $business = Business::find($id);

        // 渲染 商家修改页面
        return view('admin.business.edit',['business'=>$business]);

    }

    /**
     * 执行 修改商家操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //接收修改表单所有值
        $data = $request->all();

        //查询出对应ID的business的数据库
        $business = Business::find($data['id']);

        // 判断商家名称是否为空
        if( empty($data['bname']) ){
            exit('商家名称不能为空');
        }

        // 查询该记录所有数据
        $business->bname = $data['bname'];

        // 存入数据到数据库中
        $business->save();
        
        // 判断成功与否
        if ($business) {
            exit('修改成功');
        } else {
            exit('修改失败');
        }
    }

    /**
     * 删除 一条商家操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // 接收到ajax提交的id参数
        $business = Business::find($id);

        // 删除数据库中该id的反馈信息
        $res = $business->delete();

        // 判断并返回给ajax
        if ($res) {
            echo 'ok';
        } else {
            echo 'err';
        }
    }
}
