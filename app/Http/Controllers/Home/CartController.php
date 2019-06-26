<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{
    // 获取指定用户的id

    // 记载 购物车列表 首页
    public function index(Request $request)
    {
        //渲染页面数据
        if(session('IndexLogin')){
           $uid =  session('IndexUser')->uid;
        }


        $countCart = self::countCart();
        
        

        $data = DB::table('carts')->where('uid', $uid)->get();
        DB::table('carts')->where('uid', $uid)->update(['status'=>1]);
        $allNum = 0;
        $allPrice = 0;
        foreach($data as $k=>$v){
            $data[$k]->sub = DB::table('goods')->where('id', $v->gid)->first();
            $allPrice += $v->sub->gprice * $v->num; 
            $allNum += $v->num;
            
        }
        
        //商品总数

       
        // 渲染 购物车列表页面
        return view('home.cart.index',['allNum'=>$allNum, 'allPrice'=>$allPrice,'countCart'=>$countCart,'data'=>$data, 'links_data'=>GetdateController::getLink()]);
    }

    // 加载 添加 购物车页面
    public function add(Request $request)
    {
        // 获取用户id
        $idss = $request->input('idss',0);

        
        // 判断如果有登录用户,则
        if(!$idss == true){
            echo '请登录';
            exit;
        }

        //搜索库内DB是否有相同物品
        $goods_id = DB::table('carts')->where('gid', $request->input('id'))->get();
        
        if( count($goods_id) != 0 ){
            DB::table('carts')->where('gid', $request->input('id'))->increment('num');
            echo '添加成功';
            exit;
        }
        //压入数据
        $data['uid'] = $idss;
        $data['gid'] = $request->input('id');
        $data['num'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s', time());
        
        //购物车压入数据
        $res = DB::table('carts')->insert($data);

        if($res){
            echo '添加成功';
        }else{
            echo '添加失败';
        }
        
    }

    // 计算 加入购物车的商品数量
    public static function countCart()
    {
        
        //用户
        if(session('IndexLogin')){
            $uid =  session('IndexUser')->uid;
         }else {
             $uid = '';
             $count = 0;
         }

         $count = DB::table('carts')->where('uid',$uid)->count();
        // 返回统计个数
        return $count;
    }

    // 计算 购物车的商品小计价格
    public static function countPrice()
    {
        // 判断购物车是否为空
        if (empty($_SESSION['cart'])) {
            $countPrice = 0;
        } else {
            $countPrice = 0;
            foreach($_SESSION['cart'] as $key => $value){
                $countPrice += $value->xiaoji;
            }
        }
        // 返回统计个数
        return $countPrice;
    }

    // 添加 商品数量
    public function addNum(Request $request)
    {
        //接受id
        $id = $request->input('id');
        

        //增加数量
        $res = DB::table('carts')->where('id', $id)->increment('num');
        
        
        //判断成功
        if($res){
            echo 'ok';
        } else {
            echo 'err';
        }
    }

    // 减少 商品数量
    public function descNum(Request $request)
    {
       //接受id
       $id = $request->input('id');
        

       //减少数量
       $res = DB::table('carts')->where('id', $id)->decrement('num');
       
       
       //判断成功
       if($res){
           echo 'ok';
       } else {
           echo 'err';
       }
    
    }

    // 执行 删除指定的商品
    public function delete(Request $request)
    {
        // 获取要删除的id
        $id = $request->input('id','');

        $res = DB::table('carts')->where('id', $id)->delete();

        if($res){
            echo '删除成功';
        } else {
            echo '删除失败';
        }
    }

    public function change(Request $request)
    {
       $flag = $request->input('flag');
       $oid = $request->input('id');
        
       if($flag == 'on'){
           
          $res =  DB::table('carts')->where('id', $oid)->update(['status'=>'1']);
       } else {
          $res =  DB::table('carts')->where('id', $oid)->update(['status'=>'0']);
       }
       
       if($res){
           echo 'ok';
       } else {
           echo 'off';
       }
    }

}
