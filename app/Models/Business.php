<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    // 指定商家表
    public $table = 'business';

    // public function goods()
    // {
    //     return $this->hasOne('App\Models\Goods', 'gid');
    // }
}
