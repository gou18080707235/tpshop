<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class AuthController extends AdminController{
    //权限列表显示页面
    public function showlist(){
        $info=D('Auth')->select();
        //调用公共函数遍历无限极分类
        $info=generateTree($info);
        $this->assign('info',$info);
        $this->display();
    }
    //添加权限
    public function tianjia(){
        //dump($_POST);
        $auth=D('Auth');
        if(IS_AJAX && !empty($_POST)){
           $data=I('post.');
           //根据auth_pid判断level字段是否为0
           $data['auth_level']=$data['auth_pid']=='0'?'0':'1';
           if($auth->add($data)){
               exit(json_encode(['status'=>200,'message'=>'权限添加成功']));
           }else{
               exit(json_encode(['status'=>202,'message'=>'权限添加失败']));
           }
        }
        //将顶级权限分配给模板
        $info=D('Auth')->where(array('auth_level'=>'0'))->select();
        $this->assign('info',$info);

        $this->display();
    }
}