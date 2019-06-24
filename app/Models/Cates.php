<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cates extends Model
{
    //设置表名
    protected $table = 'cates';

    //设置时间限定
    public $timestamps = false;

    //设置一对多关系,关于商品
    public function goods()
    {
        return $this->hasMany('App\Models\Goods', 'cid');
    }
}
