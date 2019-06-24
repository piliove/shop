<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Goods;
use App\Models\Recommends;

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
        
    }
}
