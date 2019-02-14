<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Picture;
use think\Request;
use think\Session;
class Mobile extends Base
{
    public function index(Request $request)
    {
        $this->loginCheck();
        $home=["",""," id='home'","","",""];
        $result = $request-> param();
        if($result == null){
            $mobileList=Picture::getpictureByTypeAndNumber('mobile',10);
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
                $mobileList=Picture::getpictureByTypeAndNumber('mobile',10);
                dump('全为all');
            }else{
                $mobileList=Picture::where('Pic_type','mobile')->where(function($query) use ($style,$color){
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

        // $mobileList=Picture::getpictureByTypeAndNumber('mobile',40);
        // dump($computerList);
        $this->assign(['home'=> $home,
			    		'list' => $mobileList,
                        'type' => 'mobile',
                         'color' => $color,
                        'style' => $style,
    				 ]);
        return $this -> view ->fetch('mobile');
    }

}