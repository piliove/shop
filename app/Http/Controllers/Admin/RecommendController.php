<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Recommends;

class RecommendController extends Controller
{
    /**
     * 显示 创建修改位置
     * 
     * @param id(设置推荐的id)
     */
    public function create($id)
    {
        
        //获取标题
        $goods = DB::table('goods')->where('id',$id)->first();

        //查询一下推荐位栏目数量,超过3个则不再添加
        $rec_s =  DB::table('goods')->where('rec_status', 1)->count();
        if ($rec_s >= 3) {
           session(['status_m'=>'推荐位以超过3个']);
           return back()->with('error','推荐位已超过3个');
        }
     

        return view('admin.recommend.create', ['gs_data'=>$goods]);
    }

    /**
     * 显示 储存修改
     * 
     * @param Request(id(商品id))
     */
    public function store($id, Request $request)
    {
        //验证
        $this->validate($request, [
            'title'=>'max:10',
            'desc'=>'max:10',
        ],[
            'title.max'=>'标题超过10个字',
            'desc.max'=>'描述超过10个字',           
        ]);
        


        //实例化模型
        $recommend = new Recommends();

        //添加内容
        $recommend->rec_title = $request->input('title');
        $recommend->rec_desc = $request->input('desc');
        $recommend->goods_id = $id;

        //返回结果,并且判断
        $res = $recommend->save();

        if ($res) {
             //设置商品推荐状态
             DB::table('goods')->where('id', $id)->update(['rec_status'=>1]);
            session(['rec_msg'=>'推荐位设置成功']);
            return redirect('/admin/goods');
        } else {
            session(['rec_msg'=>'推荐位设置失败']);
            return back();
        }

       
    }

    /**
     * 显示 修改推荐设置
     * 
     * @param id(设置商品的id),Request(title(推荐标题), desc(推荐描述))
     * @return 78行
     */
    public function edit($id)
    {
        $rec_data = DB::table('recommends')->where('goods_id', $id)->first();
        $goods_title = DB::table('goods')->where('id', $id)->value('gtitle');
        
       

        return view('admin.recommend.edit', ['rec_data'=>$rec_data, 'goods_title'=>$goods_title]);
    }

    /**
     * 存储 修改推荐设置
     * 
     * @param id(设置推荐的id),Request(title(推荐标题), desc(推荐描述))
     * @return 106行
     */
    public function update($id,Request $request)
    {
        //验证
        $this->validate($request, [
            'title'=>'max:10',
            'desc'=>'max:10',
        ],[
            'title.max'=>'标题超过10个字',
            'desc.max'=>'描述超过10个字',           
        ]);

        //开始压入数据库 
        $recommend = Recommends::find($id);
        $recommend->rec_title = $request->input('title');
        $recommend->rec_desc = $request->input('desc');
    
        //保存并且判断结果
        $res = $recommend->save();

        if ($res) {
           
           session(['rec_msg'=>'推荐位设置成功']);
           return redirect('/admin/goods');
       } else {
           session(['rec_msg'=>'推荐位设置失败']);
           return back();
       }
    }

    /**
     * 
     * 执行 删除操作
     * 
     * @param id(商品id)
     */
    public function del($id)
    {
        //找到并且删除
        
       
        $res = DB::table('recommends')->where('goods_id', $id)->delete();
        
        if ($res) {
            DB::table('goods')->where('id', $id)->update(['rec_status'=>0]);
            session(['rec_msg'=>'推荐位取消成功']);
            echo 1;
        } else {
            session(['rec_msg'=>'推荐位取消失败']);
           
        }

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
            session(['rec_msg'=>null]);
        }
    }
}
