<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Picture;
use think\Request;
use think\Session;
class Computer extends Base
{
    public function index(Request $request)
    {
        //校验是否登陆
        $this->loginCheck();
        $home=[""," id='home'","","","",""];
        // $computerList=Picture::getpictureByTypeAndNumber('computer',10);
        
        $result = $request-> param();
       //判断是否有筛选参数
        if($result == null){
            $computerList=Picture::getpictureByTypeAndNumber('computer',10);
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
            // dump($color);
            // dump($style);
        //     if($style=='all' && $color=='all'){
        //         $computerList=Picture::getpictureByTypeAndNumber('computer',10);
        //         dump('全为all');
        //     }else{
        //         $computerList=Picture::where(function($query) use ($style,$color){
        //             $query->where([
        //                 'Pic_style'=>$style,
        //                 'Pic_color'=>$color
        //             ]);
        //         })
        //         ->whereXOr(function($query)use($style,$color){
        //             $query->whereXor([
        //                 'Pic_style'=>$style,
        //                 'Pic_color'=>$color
        //             ]);
        //         })->where('Pic_type','computer')->paginate(10);       
        //     }


            if($style=='all' && $color=='all'){
                $computerList=Picture::getpictureByTypeAndNumber('computer',10);
                dump('全为all');
            }elseif ($style!='all' && $color!='all') {
                $computerList=Picture::where([
                        'Pic_type'=>'computer',
                        'Pic_style'=>$style,
                        'Pic_color'=>$color
                    ])->paginate(10);
                dump($style);
                dump($color);
            }else{
                $computerList=Picture::where('Pic_type','computer')->where(function($query) use ($style,$color){

                    $query->where('Pic_style',$style)->whereOr( 'Pic_color',$color);

                          })->paginate(10);
                dump($style);
                dump($color);
            }
        }

        // $home：定位所在页面  $list：图片信息列表  $color：筛选栏目颜色参数  $style：筛选栏目风格参数
        $this->assign(['home'=> $home,
			    		'list' => $computerList,
                        'type' => 'computer',
                        'color' => $color,
                        'style' => $style,
    				 ]);
        return $this -> view ->fetch('computer');
    }
}