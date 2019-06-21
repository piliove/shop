<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupons;

/**
 * 优惠券 增删改查
 */
class CouponController extends Controller
{
    /**
     * 显示 优惠券管理列表页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收搜索的参数
        $search = $request->input('search','');

        // 查询所有数据
        $coupons = Coupons::where('cname','like','%'.$search.'%')->paginate(5);

        // 渲染 加载优惠券列表视图页面
        return view('admin.coupon.index',['coupons'=>$coupons,'search'=>$search]);
    }

    /**
     * 显示 添加优惠券页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 渲染 添加优惠券列表界面
        return view('admin.coupon.create');
    }

    /**
     * 执行 添加优惠券操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取表单提交的值
        $data = $request->all();

        // 判断优惠券名称长度
        if( strlen($data['cname']) > 30 ){
            exit('优惠券长度不超过十位');
        }

        // 判断价格是否是数字类型
        if( is_numeric($data['cprice']) == false ){
            exit('价格必须输入数字');
        }

        // 判断数量是否是数字类型
        if( is_numeric($data['cnum']) == false ){
            exit('数量必须输入数字');
        }

        //创建模型写入数据到数据库并判断是否添加成功
        $coupons = new Coupons;
        $coupons->cname = $data['cname'];
        $coupons->cprice = $data['cprice'];
        $coupons->cnum = $data['cnum'];

        // 存入数据到数据库中
        $coupons->save();

        // 判断成功与否
        if ($coupons) {
            exit('添加成功');
        } else {
            exit('添加失败');
        }

    }

    /**
     * 显示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示 修改优惠券页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询该记录所有数据
        $coupons = Coupons::find($id);

        // 渲染 优惠券修改页面
        return view('admin.coupon.edit',['coupons'=>$coupons]);
    }

    /**
     * 执行 修改优惠券操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //接收修改表单所有值
        $data = $request->all();

        //查询出对应ID的coupons的数据库
        $coupons = Coupons::find($data['id']);

        // 判断价格是否是数字类型
        if( is_numeric($data['cprice']) == false ){
            exit('价格必须输入数字');
        }

        // 判断数量是否是数字类型
        if( is_numeric($data['cnum']) == false ){
            exit('数量必须输入数字');
        }

        // 查询该记录所有数据
        // $coupons = Coupons::find($id);
        $coupons->cname = $data['cname'];
        $coupons->cprice = $data['cprice'];
        $coupons->cnum = $data['cnum'];

        // 存入数据到数据库中
        $coupons->save();
        
        // 判断成功与否
        if($coupons){
            exit('修改成功');
        }else {
            exit('修改失败');
        }
    }

    /**
     * 执行 删除一条优惠券记录
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        // 接收到ajax提交的id参数
        $coupons = Coupons::find($id);

        // 删除数据库中该id的反馈信息
        $res = $coupons->delete();

        // 判断并返回给ajax
        if ($res) {
            echo 'ok';
        } else {
            echo 'err';
        }
    }
}
