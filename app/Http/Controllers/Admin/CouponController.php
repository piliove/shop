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
        $coupons = Coupons::where('cname','like','%'.$search.'%')->paginate(1);

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
        // 接收表单传递的参数
        $data['cname'] = $request->input('cname','');
        $data['cprice'] = $request->input('cprice','');
        $data['cnum'] = $request->input('cnum','');

        // 判断字符串长度
        if (mb_strlen($data['cname'])<20) {
            return back()->with('error','优惠券名称长度超过限制');
        }

        // 判断是否是数字
        if( is_numeric($data['cprice']) == false ){
            return back()->with('error','优惠券价格有误');
        }

        // 判断是否是数字
        if( is_numeric($data['cnum']) == false ){
            return back()->with('error','优惠券数量有误');
        }

        //创建模型写入数据到数据库并判断是否添加成功
        $coupons = new Coupons;
        $coupons->cname = $data['cname'];
        $coupons->cprice = $data['cprice'];
        $coupons->cnum = $data['cnum'];

        // 存入数据到数据库中
        $coupons->save();

        // 判断成功与否
        if($coupons){
            return redirect('/admin/coupon')->with('success','添加成功!');
        }else {
            return back()->with('error','添加失败!');
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
    public function update(Request $request,$id)
    {
        // 接收表单传递的参数
        $data['cname'] = $request->input('cname','');
        $data['cprice'] = $request->input('cprice','');
        $data['cnum'] = $request->input('cnum','');
        
        // 判断是否是数字
        if( is_numeric($data['cprice']) == false ){
            return back()->with('error','优惠券价格有误');
        }

        // 判断是否是数字
        if( is_numeric($data['cnum']) == false ){
            return back()->with('error','优惠券数量有误');
        }

        // 查询该记录所有数据
        $coupons = Coupons::find($id);
        $coupons->cname = $data['cname'];
        $coupons->cprice = $data['cprice'];
        $coupons->cnum = $data['cnum'];

        // 存入数据到数据库中
        $coupons->save();
        
        // 判断成功与否
        if($coupons){
            return redirect('/admin/coupon')->with('success','添加成功!');
        }else {
            return back()->with('error','添加失败!');
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
