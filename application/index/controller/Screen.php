<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Picture;
use think\Request;
use think\Session;
// use think\Db;
class Screen extends Base
{
    public function index(Request $request)
    {
        $this->loginCheck();
        $home=["","","",""," id='home'",""];
       
        $result = $request-> param();
        if($result == null){
        	$allList=Picture::name('picture')->paginate(30);
        	Session::set('style','all');
        	Session::set('color','all');
        	$style = Session::get('style');
        	$color = Session::get('color');
        }else{

        	if($request->get('style') != null){
        		Session::set('style',$request->get('style'));
        	}
        	if($request->get('color') != null){
        		Session::set('color',$request->get('color'));
        		}
        	$style = Session::get('style');
        	$color = Session::get('color');
        	dump($color);
        	dump($style);
        	if($style=='all' && $color=='all'){
        		$allList=Picture::name('picture')->paginate(20);
        		dump('全为all');
        	}else{
	        	$allList=Picture::where(function($query) use ($style,$color){
	        		$query->where([
	        			'Pic_style'=>$style,
	        			'Pic_color'=>$color
	        		]);
	        	})
	        	->whereXOr(function($query)use($style,$color){
	        		$query->whereXor([
	        			'Pic_style'=>$style,
	        			'Pic_color'=>$color
	        		]);
	        	})->paginate(10);  		
        	}

        }
        
        $this->assign(['home'=> $home,
			    		'list' => $allList,
			    		'type' => 'screen',
			    		'color' => $color,
			    		'style' => $style,
    				 ]);
        return $this -> view ->fetch('screen');
    }

}