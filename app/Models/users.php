<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //指定数据表
    public $table = 'users';

    public function userinfo()
    {
        return $this->hasOne('App\Models\UserInfos', 'uid');
    }
}
