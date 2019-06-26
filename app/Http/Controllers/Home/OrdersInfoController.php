<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class OrdersInfoController extends Controller
{
    public function index()
    {
        //检测是否登陆
        if (session('IndexLogin')) {
            $uid = session('IndexUser')->uid;
            
        } else {
            echo '<script>alert("未登录,请登录");location.href="/login"</script>';
        }


        //提取订单表数据
        $orders_data = DB::table('orders')->where('uid', session('IndexUser')->id)->get();
        
        //取得订单详情表信息
        foreach($orders_data as $k=>$v){
            $orders_data[$k]->sub = DB::table('orders_info')->where('oid', $v->id)->get();

            foreach($orders_data[$k]->sub as $kk=>$vv){
                $orders_data[$k]->sub[$kk]->path = DB::table('goods')->where('id',$vv->gid)->value('gthumb_1');
            }

        }
        
    



        return view('home.ordersinfo.index',[
                                             'countCart'=>CartController::countCart(),
                                             'links_data'=>GetdateController::getLink(),
                                             'orders_data'=>$orders_data,
                                            ]);
    }

    public function del(Request $request)
    {
        DB::beginTransaction();

        $id = $request->input('id');


        $res = DB::table('orders')->where('id',$id)->delete();

        if($res){
            $res = DB::table('orders_info')->where('oid', $id)->delete();
            if(!$res){
                DB::rollback();
            }
            DB::commit();
            echo 'ok';
        }else{
           return '出错';
        }
        



    }
}
