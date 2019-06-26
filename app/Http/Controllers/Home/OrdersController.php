<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        //判断用户是否登陆
        if( session('IndexLogin') ){
            $uid = session('IndexUser')->uid;

        } else {
            echo'<script>alert("请登录");location.href="/login"</script>';
        }


        //查找用户的收货地址
        $addres = DB::table('addres')->where('uid', $uid)->get();

        //想要购买的商品
        $data = DB::table('goods')->where('id', $request->input('id'))->first();
        //查看购物券的价格
        $coupon = DB::table('coupon')->where('uid', $uid)->get();

        //获取购物券的价格
        $coupon_price = DB::table('coupon')->first();
        $coupon_price = $coupon_price->cprice;

        return view('home.orders.index',['countCart'=>CartController::countCart(),
                                         'addres'=>$addres,
                                         'data'=>$data,
                                         'coupon'=>$coupon,
                                         'countPrice'=>$coupon_price,
                                         'links_data'=>GetdateController::getLink(),
                                        ]);
    }

    public function pay(Request $request)
    {


        
        //检测是否登陆
        if (session('IndexLogin')) {
            $uid = session('IndexUser')->uid;
            
        } else {
            echo '<script>alert("未登录,请登录");location.href="/login"</script>';
        }
        DB::beginTransaction();
        //开始压入数据
        $data['num'] = $request->input('num');
        $data['prices'] = $request->input('price')*$request->input('num');
        $data['addr'] = $request->input('aname').' '.$request->input('dname');
        $data['uname'] = $request->input('name');
        $data['phone'] = $request->input('aphone');

        $data['ctimes'] = date('Y-m-d H:i:s', time());
        $data['order'] = date('YmdHis',time()).mt_rand(1,1000);
        $data['uid'] = $uid;

        //压入数据库

        $oid = DB::table('orders')->insertGetId($data);

        //开始压入数据(订单详情)
        $info_data['oid'] = $oid;
        $info_data['gid'] = $request->input('gid');
        $info_data['gname'] = DB::table('goods')->where('id', $request->input('gid'))->value('gname');
        $info_data['price'] = $request->input('price');
        $info_data['num'] = $request->input('num');

        //压入数据库
        $res = DB::table('orders_info')->insert($info_data);

        if(!$res){
            //失败回滚
            DB::rollBack();
        } else {
            //提交记录
            DB::commit();  
            DB::table('goods')->where('id', $request->input('gid'))->decrement('gnum',$request->input('num'));          
            return redirect('/home/ordersinfo/index');
        }

        
    }

    public function cart_index(Request $request)
    {
       
       //检测是否登陆
        if (session('IndexLogin')) {
        $uid = session('IndexUser')->uid;
        
        } else {
        echo '<script>alert("未登录,请登录");location.href="/login"</script>';
        }

        $data = DB::table('carts')->where('uid', $uid)->where('status',1)->get();

        $allNum = 0;
        $allPrice = 0;
        foreach($data as $k=>$v){
            $data[$k]->sub = DB::table('goods')->where('id',$v->gid)->first();
            $allPrice += $v->sub->gprice * $v->num; 
            $allNum += $v->num;
        }

        //查找用户的收货地址
        $addres = DB::table('addres')->where('uid', $uid)->get();

        //查看购物券的价格
        $coupon = DB::table('coupon')->where('uid', $uid)->get();

        //获取购物券的价格
        $coupon_price = DB::table('coupon')->first();
        $coupon_price = $coupon_price->cprice;



        return view('home.orders.index_cart',['countCart'=>CartController::countCart(),
                                         'addres'=>$addres,
                                         'data'=>$data,
                                         'coupon'=>$coupon,
                                         'countPrice'=>$coupon_price,
                                         'links_data'=>GetdateController::getLink(),
                                         'allPrice'=>$allPrice,
                                         'allNum'=>$allNum,
                                        ]);
       

    }

    public function cart_pay(Request $request)
    {
        //检测是否登陆
            if (session('IndexLogin')) {
                $uid = session('IndexUser')->uid;
            
            } else {
                echo '<script>alert("未登录,请登录");location.href="/login"</script>';
            }

            DB::beginTransaction();
          
            //开始压入数据
            $data['num'] = $request->input('num');
            $data['prices'] = $request->input('price');
            $data['addr'] = $request->input('aname').' '.$request->input('dname');
            $data['uname'] = $request->input('name');
            $data['phone'] = $request->input('aphone');

            $data['ctimes'] = date('Y-m-d H:i:s', time());
            $data['order'] = date('YmdHis',time()).mt_rand(1,1000);
            $data['uid'] = $uid;

            //压入数据库

            $oid = DB::table('orders')->insertGetId($data);

            //开始压入详细数据
            $info_data = DB::table('carts')->where('uid', $uid)->where('status', 1)->get();
            foreach($info_data as $k=>$v){
                $data_info = [];
                $info_data[$k]->sub = DB::table('goods')->where('id',$v->gid)->first();
                DB::table('goods')->where('id', $v->gid)->decrement('gnum',$v->num);
                $data_info['oid'] = $oid;
                $data_info['gid'] = $info_data[$k]->sub->id;
                $data_info['num'] = $v->num;
                $data_info['gname'] = $info_data[$k]->sub->gname;
                $data_info['price'] = $info_data[$k]->sub->gprice;
                $res = DB::table('orders_info')->insert($data_info);
            }

            if($res == 0){
                DB::rollBack();
            }
            DB::table('carts')->where('uid', $uid)->delete();
            DB::commit();

           echo '<script>alert("交易成功");location.href="/home/ordersinfo/index"</script>';
    }
}
