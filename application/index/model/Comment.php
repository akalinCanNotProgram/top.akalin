<?php

namespace app\index\model;

use think\Model;

class Comment extends Model
{
    //时间戳自动转换
    protected $type = [
        'time'  =>  'timestamp'
    ];
    
}
