<?php

namespace app\index\model;

use think\Model;
use app\index\model\Own;

class User extends Model
{
    //自动进行时间戳的转换
    protected $type = [
        'last_time'  =>  'timestamp:Y/m/d'
    ];
    //根据图片ID获取用户信息
     public static function getUserInfoByPicId($picId)
    {
        $userId=Own::where('Pic_id',$picId)->value('User_id');
        $userInfo = User::where('user_id',$userId)->find();
        return $userInfo;
    }
}
