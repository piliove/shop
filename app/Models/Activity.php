<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //设置表
    protected $table = 'activity';
    
    //设置一对多关系
    public function goods()
    {
        return $this->hasMany('App\Models\Goods','activity_id');
    }
}
