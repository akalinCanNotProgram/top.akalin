<?php

//前台模块基类

namespace app\index\common;
use think\Controller;
use app\index\model\Picture;
use app\index\model\User;
use think\View;
use think\Request;
use think\Session;

class Base extends Controller{   	
    	protected function _initialize()
    {
    	$styleList = Picture::distinct(true)->column('Pic_style');
    	// 赋值全局模板变量
		View::share('styleList',$styleList);
		define('USER_ID', Session::get('userId'));
		define('USER_PASSWORD', Session::get('userInfo')['password']);
    }

    	protected function loginCheck()
    	{
    		if(is_null(USER_ID)){
    			$this->assign('userInfo',null);
    		}else{
    			$map=['user_id'=>USER_ID];
    			$userInfo=User::get($map);
    			if($userInfo -> password == md5(USER_PASSWORD)){
    				$this->assign('userInfo',$userInfo);
    			}else{
    				$this->assign('userInfo',null);
    			}

    		}
    	}
    	protected function commentLoginCheck()
    	{
    		if(is_null(USER_ID)){
    			$status=0;
    		}else{
    			$map=['user_id'=>USER_ID];
    			$userInfo=User::get($map);
    			if($userInfo -> password == md5(USER_PASSWORD)){
    				$status=1;
    			}else{
    				$status=0;
    			}

    		}
    		return $status;
    	}
    	protected function alreadyLogin(){
    		if(!is_null(USER_ID)){
    			$this->error('您已经登陆，请不要重复登陆！','index/index');
    		}
    	}
}