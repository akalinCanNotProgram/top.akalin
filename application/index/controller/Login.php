<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\User;
use think\Request;
use think\Session;

class Login extends Base
{
    // 渲染登陆界面
    public function index()
    {
        $this->alreadyLogin();
        return $this -> view ->fetch('login');
    }
    //验证登陆
    public function check(Request $request){
    	// 设置状态
    	$status=0;
    	$result=$request -> param();
    	$email=$result['email'];
    	$password=md5($result['password']);
    	$map = ['email' => $email];
    	$user = User::get($map);
    	  // dump($password);
    	if(is_null($user)){
    		$massage='此账号不存在或不正确！';
    	}elseif ($user ->password !=  $password) {
    		$massage = '密码不正确！请重新输入！';
            $status=2;
    	}else{
    		$status = 1;
    		$massage = '验证成功！正在跳转。。。';
    		$user ->setInc('login_count');
    		$user ->save(['last_time'=>time()]);
    		$userId=$user -> user_id;
    		Session::set('userId',$userId);
    		Session::set('userInfo',$result);
    	}

    	return ['status'=>$status,'massage'=>$massage];
        // dump($status);

    }
    //退出登陆
    public function loginOut(){
    	session::delete('userId');
    	session::delete('userInfo');
    	$this->success('注销成功，正在返回');
    }
}