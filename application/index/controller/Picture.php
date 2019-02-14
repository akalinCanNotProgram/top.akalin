<?php
namespace app\index\controller;
use app\index\common\Base;
use app\index\model\Picture as PictureModel;
use app\index\model\Label;
use app\index\model\Grade;
use app\index\model\User;
use app\index\model\Comment;
use think\Session;
use think\Request;
use think\Db;
class Picture extends Base
{
    protected $type = [
        'time'  =>  'timestamp:Y/m/d'
    ];

    public function index(Request $request)
    {
        $this->loginCheck();
        $picId=$request->get('id');
        //壁纸信息  $picInfo:被浏览的壁纸的信息
        $picInfo=PictureModel::where('Pic_id',$picId)->find();
        //壁纸的喜欢与不喜欢数量
        $grade=Grade::where('Pic_id',$picId)->find();
        //壁纸标签
        $labels=Label::where('Pic_id',$picId)->distinct(true)->column('Pic_label');
        //根据壁纸id查询上传者
        $userName=User::getUserInfoByPicId($picId)->value('name');
        //自增壁纸的浏览量
        PictureModel::where('Pic_id',$picId)->setInc('hits',1,1);
        //加载壁纸评论
        $comments = Db::table('comment')->alias('c')->where('Pic_id',$picId)->join('user u','c.User_id=u.user_id')->field(['c.Pic_id','c.User_id','c.time','c.Content','u.name'])->order('time','desc')->paginate(10,false,[
                                            'query'=>request()->param(),
                                            ]);

        // dump($comments);
        $this->assign([
        	'picInfo'=>$picInfo,
        	'grade'=>$grade,
        	'labels'=>$labels,
        	'user'=>$userName,
            'comments'=>$comments,
        	
        ]);
        return $this -> view ->fetch('picture');
    }
    //点踩处理函数
    public function like(Request $request){
         $picId=$request->get('id');
         $hits=Session::get($picId);
        if(is_null($hits)){
            Grade::where('Pic_id',$picId)->setInc('Pic_Like',1);
            Session::set($picId,1);
            $massage='感谢您参与的评论！';
            $status=1;
            $like=Grade::where('Pic_id',$picId)->value('Pic_Like');
        }else{
            if($hits){
                $massage='你已经评论过了，请不要重复评论，谢谢！';
                 $status=0;
                  $like=0;
            }else{
                Grade::where('Pic_id',$picId)->setInc('Pic_Like',1);
                $massage='感谢你的评论!';
                $status=1;
                $like=Grade::where('Pic_id',$picId)->value('Pic_Like');
            }
        }
        return ['massage'=>$massage,'status'=>$status,'like'=>$like];
    }
    
    //点赞处理函数
    public function unlike(Request $request){
        $picId=$request->get('id');
        $hits=Session::get($picId);
        //判断是否已经评价过了
        if(is_null($hits)){  
            Grade::where('Pic_id',$picId)->setInc('Pic_Unlike',1);
            Session::set($picId,1);
            $massage='感谢您参与的评论！';
            $status=1;
            $unlike=Grade::where('Pic_id',$picId)->value('Pic_Unlike');
        }else{
            if($hits){
                $massage='你已经评论过了，请不要重复评论，谢谢！';
                 $status=0;
                 $unlike=0;
            }else{
                Grade::where('Pic_id',$picId)->setInc('Pic_Unlike',1);
                $massage='感谢你的评论!';
                $status=1;
                $unlike=Grade::where('Pic_id',$picId)->value('Pic_Unlike');
            }
        }
        return ['massage'=>$massage,'status'=>$status,'unlike'=>$unlike];
    }

    //添加标签
    public function labelsAdd(Request $request){
        $picId=$request->get('id');
        $comments = Db::table('comment')->alias('c')->where('Pic_id',$picId)->join('user u','c.User_id=u.user_id')->field(['c.Pic_id','c.User_id','c.time','c.Content','u.name'])->paginate(10);
        dump($comments);

    }
    //评论添加
    public function commentAdd(Request $request){
        if($this->commentLoginCheck()){
            $result=$request->param();
            $comment=new Comment;
            $comment->data($result);
            $comment->time = time();
            $status=$comment->save();
        }else{
            $status=0;
        }
        
        return $status;
        // return $result;
        // $userId=$request->post('user_id');
        // $picId=$request->post('Pic_id');
        // $picId=$request->post('Content');

    }
}