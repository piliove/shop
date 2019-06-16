<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    //表名
    protected $table = 'links';
    //关闭时间限定条件
    public $timestamps = false;
}
