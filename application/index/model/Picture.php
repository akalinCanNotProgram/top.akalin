<?php

namespace app\index\model;

use think\Model;

class Picture extends Model
{
    
     protected $type = [
        'time'  =>  'timestamp:Y/m/d'
    ];
    //获取个页面数据
    public static function getpictureByTypeAndNumber($type,$number){
    	$list=Picture::where('Pic_type',$type)->paginate($number);
    	return $list;
    }
    public static function getAllData(){
    	$origlist = Picture::all();
    	foreach ($origlist as $k => $v) {
    		$list[$k]=$v -> getData();
    	}
    	return $list;
    }
}
