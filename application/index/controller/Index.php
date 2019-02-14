<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Picture;
class Index extends Base
{
    public function index()
    {
    	$this->loginCheck();
        $computerList=Picture::where('Pic_type','computer')->limit(9)->select();
    	$mobileList=Picture::where('Pic_type','mobile')->limit(18)->select();
    	$ipadList=Picture::where('Pic_type','iPad')->limit(15)->select();

    	$home=[" id='home'","","","","",""];
    	$this->assign(['home'=> $home,
			    		'computerList' => $computerList,
			    		'ipadList'=> $ipadList,
			    		'mobileList'=> $mobileList
    				 ]);
        return $this -> view ->fetch();
    }
    
}
