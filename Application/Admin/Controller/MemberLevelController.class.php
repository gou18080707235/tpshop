<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class MemberLevelController extends AdminController{
    //会员界别列表展示
    public function showlist(){
        $info=D('MemberLevel')->where(array('flag'=>'1'))->select();
        $this->assign('info',$info);
        $this->display();
    }
    //添加会员级别
    public function  addMember(){
        if(IS_AJAX){
            $member=D('MemberLevel');
            $data=I('post.');
           // $data=$member->create();
                if($member->add($data)){
                    echo json_encode(array('status'=>200));
                }else{
                    echo json_encode(array('status'=>202));
                }
            }else{
            $this->display();
        }

    }
    //修改会员级别
    public function upd(){
        if(IS_AJAX){
            $data=I('post.');
            $id=session('id');
            $data['id']=$id;
            //dump($data);
            if(D('MemberLevel')->save($data)){
                echo json_encode(array('status'=>200));
            }else{
                echo json_encode(array('status'=>202));
            }
        }else{
            //接收数据
            $id=I('get.id');
            session('id',$id);
            $info=D('MemberLevel')->find($id);
            $this->assign('info',$info);
            $this->display();
        }


    }
    //删除会员级别
    public function del(){
        if(IS_AJAX){
            $id=I('get.id');
            $data['flag']=0;
            $data['id']=$id;
            if(D('MemberLevel')->save($data)){
                echo json_encode(array('status'=>200));
            }else{
                echo json_encode(array('status'=>202));
            }

        }
    }
}