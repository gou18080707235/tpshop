<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class ManagerController extends AdminController {
    //生成验证码‘
    public function verifyImg(){
        $cfg=array(
            'fontSize'  =>  18,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  40,               // 验证码图片高度
            'imageW'    =>  130,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        $vry=new \Think\Verify($cfg);
        $vry->entry();
    }
    public function login(){
        if(IS_POST){
            $code=I('post.manager_verify');
            $vry=new \Think\Verify();
            if($vry->check($code)){
                $name=I('post.manager_name');
                $pwd=md5(I('post.manager_pwd'));
                $info=D('Manager')->where(array('mg_name'=>$name,'mg_pwd'=>$pwd))->find();
                if($info){

                    session('admin_id',$info['mg_id']);
                    session('admin_name',$info['mg_name']);
                    $this->redirect('Admin/Index/index');

                }
                $this->assign('errorinfo','用户名或密码错误');
            }else{
                $this->assign('errorinfo','验证码错误');
            }
        }
        $this->display();
    }
    //用户退出系统
    public function logout(){
        session(null);
        $this->redirect('Manager/login');
    }
}