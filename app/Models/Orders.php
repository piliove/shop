<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    // 指定 订单表
    public $table = 'orders';

    // 一对多关系
    public function orderinfos()
    {
        return $this->hasMany('App\Models\OrderInfos', 'oid');
    }
}
