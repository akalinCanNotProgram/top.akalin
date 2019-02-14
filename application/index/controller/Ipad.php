<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Picture;
use think\Request;
use think\Session;
class Ipad extends Base
{
    public function index(Request $request)
    {
    	$this->loginCheck();
        $home=["","",""," id='home'","",""];
        $result = $request-> param();
       //判断是否有筛选参数
        if($result == null){
            $ipadList=Picture::getpictureByTypeAndNumber('iPad',10);
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
            // if($style=='all' && $color=='all'){
            //     $ipadList=Picture::getpictureByTypeAndNumber('iPad',10);
            //     dump('全为all');
            // }else{
            //     $ipadList=Picture::where('Pic_type','iPad')->where(function($query) use ($style,$color){
            //         $query->where([
            //             'Pic_style'=>$style,
            //             'Pic_color'=>$color
            //         ]);
            //     })
            //     ->whereXOr(function($query)use($style,$color){
            //         $query->whereXor([
            //             'Pic_style'=>$style,
            //             'Pic_color'=>$color
            //         ]);
            //     })->paginate(10);       
            // }
            
            if($style=='all' && $color=='all'){
                $ipadList=Picture::getpictureByTypeAndNumber('iPad',10);
                dump('全为all');
            }elseif ($style!='all' && $color!='all') {
                $ipadList=Picture::where([
                        'Pic_type'=>'iPad',
                        'Pic_style'=>$style,
                        'Pic_color'=>$color
                    ])->paginate(10);
                dump($style);
                dump($color);
            }else{
                $ipadList=Picture::where('Pic_type','iPad')->where(function($query) use ($style,$color){

                    $query->where('Pic_style',$style)->whereOr( 'Pic_color',$color);

                          })->paginate(10);
                dump($style);
                dump($color);
            }

        }
        // $home：定位所在页面  $list：图片信息列表  $color：筛选栏目颜色参数  $style：筛选栏目风格参数
        $this->assign(['home'=> $home,
                        'list' => $ipadList,
                        'type' => 'iPad',
                        'color' => $color,
                        'style' => $style,
                     ]);
        return $this -> view ->fetch('ipad');
    }
}