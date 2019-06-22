<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommends extends Model
{
    protected $table = 'recommends';

    //建立属于关系
    public function goods()
    {
        return $this->belongsTo('App\Models\Goods', 'goods_id');
    }
}
