<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Picture;
use think\Config;
// use think\Db;
// use think\Contorller;
class Recommendation extends Base
{
    public function index()
    {
        $this->loginCheck();
        $home=["","","","",""," id='home'"];
        $allList=Picture::name('picture')->paginate(30);
        $this->assign(['home'=> $home,
			    		'list' => $allList,
    				 ]);
        return $this -> view ->fetch('recommendation');
    }
}