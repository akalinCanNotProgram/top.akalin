<?php
/**
 * 搜索框处理
 */
namespace app\index\controller;
use app\index\model\Label;
use think\Request;
use think\Controller;
class Search extends Controller {
    
    public function index(Request $request){
    	$string=$request->param();
    	$statu=0;
    	$response=null;
				$labels=Label::distinct('Pic_label')->field('Pic_label')->select();
				foreach ($labels as $v) {
					if (stristr($v->toArray()['Pic_label'],$string['pic_label'])!=false)
					{
						$response[]=$v->toArray()['Pic_label'];
						$statu=1;
					}
				};

    	return ['statu'=>$statu,'suggestions'=>$response];
    }
}