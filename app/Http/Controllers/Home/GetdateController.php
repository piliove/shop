<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Goods;
use App\Models\Recommends;
use App\Models\Activity;
use DB;

class GetdateController extends Controller
{
    public static function getCate($pid = 0)
    {
        $data = Cates::where('pid',$pid)->get();

        foreach ($data as $k=>$v) {
            $data[$k]->sub = self::getCate($v->id);
        }

        return $data;
        
    }

    public static function getRec()
    {
        $data = Recommends::orderBy('updated_at','desc')->take(3)->get();
        
        foreach($data as $k=>$v){
            $rec = Recommends::find($v->id);
            $data[$k]['sub'] = $rec->goods->gthumb_1;
        }

        return $data;
    }

    public static function getActivity($lim = 'all')
    {
       if( $lim !='all' && is_int($lim) ){

            $data = Activity::orderBy('created_at','desc')->take($lim)->get();
       } else {
            $data = Activity::orderBy('created_at','desc')->get();
       }

       return $data;
    }

    //取得商品id
    public static function getCate_list_goods($cid)
    {
        $goods = Cates::find($cid)->goods()->paginate(1);
        return $goods;
    }

    public static function getCate_de($cid)
    {
        $cates = Cates::find($cid);
        $data = Cates::where('pid', $cates->pid)->get();
        return $data;
    }


    

    
}
