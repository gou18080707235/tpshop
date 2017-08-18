<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
use Boris\DumpInspector;

class UserController extends AdminController{
    //用户列表
    public function showlist(){
        $userInfo=D('User')->select();
        $this->assign('userInfo',$userInfo);
        $this->display();
    }
    //冻结会员
    public function dj_user(){
        //接收数据

            $time=I('post.time');
            $user_id=I('post.user_id');
            $time=$time*3600*24;
            $info=D('User')->field('dongjie_time,flag')->find($user_id);

            if($info['flag']==1){
                //没有被冻结过
                $dj_time=time()+$time;
                $data['user_id']=$user_id;
                $data['flag']=2;
                $data['dongjie_time']=$dj_time;
                $res=D('User')->save($data);
                if($res){
                    echo json_encode(array('status'=>200));
                }else{
                    echo json_encode(array('status'=>202));
                }
            }else{
                //被冻结过
                $dj_time=$info['dongjie_time']+$time;
                $data['user_id']=$user_id;
                $data['dongjie_time']=$dj_time;
                $res=D('User')->save($data);
                if($res){
                    echo json_encode(array('status'=>200));
                }else{
                    echo json_encode(array('status'=>202));
                }
            }
        }
        //解除冻结
    public function jiechu(){
        $user_id=I('post.user_id');
        $data['user_id']=$user_id;
        $data['flag']=1;
        $data['dongjie_time']=0;
        if(D('User')->save($data)){
            echo json_encode(array('status'=>200));
        }else{
            echo json_encode(array('status'=>202));
        }
    }

}