<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CartController extends Controller
{
    // 记载 购物车列表 首页
    public function index()
    {
        // 清空SESSION缓存数据
        // $_SESSION['cart'] = null;
        // exit;

        // 判断session值是否存在
        if (!empty($_SESSION['cart'])) {
            $data = $_SESSION['cart'];            
        } else {
            $data = [];
        }

        // 获取购物车的商品数量
        $countCart = self::countCart();

        // 获取商品总的价格
        $countPrice = self::countPrice();

        // 渲染 购物车列表页面
        return view('home.cart.index',['data'=>$data,'countCart'=>$countCart,'countPrice'=>$countPrice]);
    }

    // 加载 添加 购物车页面
    public function add(Request $request)
    {
        // 获取指定的商品id
        $id = $request->input('id',0);

        if (empty($_SESSION['cart'][$id])) {
            // 获取商品表中具体的某一个值
            $data = DB::table('goods')->select('id','gtitle','gdesc','gprice','gprices','gthumb_1')->where('id',$id)->first();
            // 商品数量
            $data->num = 1;
            // 商品小计
            $data->xiaoji = ($data->num * $data->gprices);

            // 将数据压入数组中
            $_SESSION['cart'][$id] = $data;

        } else {
            // 当前数量
            $_SESSION['cart'][$id]->num = $_SESSION['cart'][$id]->num + 1;
            // 当前商品小计
            $_SESSION['cart'][$id]->xiaoji = ($_SESSION['cart'][$id]->num * $_SESSION['cart'][$id]->gprices);
        }

        // 返回
        return back();
        
    }

    // 计算 加入购物车的商品数量
    public static function countCart()
    {
        // 判断购物车是否为空
        if (empty($_SESSION['cart'])) {
            $count = 0;
        } else {
            $count = 0;
            foreach($_SESSION['cart'] as $key => $value){
                $count += $value->num;
            }
        }
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
        // 获取指定的id值
        $id = $request->input('id','');

        // 判断session值是否为空
        if (empty($_SESSION['cart'])) {
            return back();
        } else {
            $n = $_SESSION['cart'][$id]->num+1;
            $gprices = $_SESSION['cart'][$id]->gprices;

            $_SESSION['cart'][$id]->num = $n;
            $_SESSION['cart'][$id]->xiaoji = ( $n * $gprices );

            return back();
        }
    }

    // 减少 商品数量
    public function descNum(Request $request)
    {
        $id = $request->input('id','');

        if (empty($_SESSION['cart'])) {
            return back();
        } else {
            // 判断商品数量是否为0
            if ($_SESSION['cart'][$id]->num <= 1) {
                return back();
            }

            $n = $_SESSION['cart'][$id]->num-1;
            $gprices = $_SESSION['cart'][$id]->gprices;

            $_SESSION['cart'][$id]->num = $n;
            $_SESSION['cart'][$id]->xiaoji = ($n * $gprices );

            return back();
        }
    }

    // 执行 删除指定的商品
    public function delete(Request $request)
    {
        // 获取要删除的id
        $id = $request->input('id','');

        // 判断SESSION是否为空
        if (empty($_SESSION['cart'][$id])) {
            return back();
        } else {
            unset($_SESSION['cart'][$id]);
            return back();
        }
    }

}
