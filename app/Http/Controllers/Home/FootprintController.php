<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\SearchController;
use App\Models\Goods;
use App\Models\Footprint;
use DB;
class FootprintController extends Controller
{
    public function index(Request $request)
    {
    	
    	$footprint = Footprint::all();
    	// $uid = $footprint->uid;
    	// dump($footprint);
    	// 获取商品表中具体的某一个值
    	 // 获取前台首页提交的搜索结果
        $search = $request->input('search','');

        // 获取数据库中的所有商品数据
        // $goods = Goods::where('gtitle','like','%'.$search.'%')->paginate(5);

        /* 利用中文分词获取查询结果 开始*/
        if (!empty($search)) {
            $gid = DB::table('view_goods_word')->select('gid')->where('word',$search)->get();
        
            $gids = [];
            foreach($gid as $k => $v){
                $gids[] = $v->gid;
            }
    
            $data = DB::table('goods')->whereIn('id',$gids)->get();
        } else {
            $data = DB::table('goods')->get();
        }
        
        // 使用CartController控制器下的countCart方法
        $countCart = CartController::countCart();
       
    	return view('home.footprint.index',['footprint'=>$footprint,'search'=>$search,'data'=>$data,'countCart'=>$countCart]);
    }
    /**
     * 执行删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          //接收传值
        $id = $request->input('id');
        //查询id对应用户
        $img = Footprint::find($id);
        //执行删除操作
        $footprint = Footprint::destroy($id);
        if ($footprint) {
            echo '删除成功';
        } else {
            echo '删除失败';
        }
    }
}
