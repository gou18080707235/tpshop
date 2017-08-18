<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class IndexController extends AdminController {
    public function index(){
        $this->display();
        C('SHOW_PAGE_TRACE',false);
    }
    public function top(){$this->display();C('SHOW_PAGE_TRACE',false);}
    public function down(){$this->display();C('SHOW_PAGE_TRACE',false);}
    public function center(){$this->display();C('SHOW_PAGE_TRACE',false);}
    public function left(){
        //获取session会话信息’
        $admin_id=session('admin_id');
        $admin_name=session('admin_name');
        if($admin_name!=='admin'){
            //manager表与role表联表查询
            $info=D('Manager')
                ->alias('m')
                ->join('__ROLE__ as r on m.role_id=r.role_id')
                ->where(array('m.mg_id'=>$admin_id))
                ->field('r.role_auth_ids')
                ->find();
            //将查询得到的IDS赋值给字符串
            $authids=$info['role_auth_ids'];
            //获取的顶级权限信息
                $authinfoA=D('Auth')->where(array('auth_level'=>'0','auth_id'=>array('in',$authids)))->select();
                //获得子权限信息
                $authinfoB=D('Auth')->where(array('auth_level'=>'1','auth_id'=>array('in',$authids)))->select();
        }else{
            //超级管理员获取所有的权限
            //获取的顶级权限信息
                echo 'admin';
                $authinfoA=D('Auth')->where(array('auth_level'=>'0'))->select();
                //获得子权限信息
                $authinfoB=D('Auth')->where(array('auth_level'=>'1',))->select();
        }
        $this->assign('authinfoA',$authinfoA);
        $this->assign('authinfoB',$authinfoB);

        $this->display();
    }
    public function right(){$this->display();C('SHOW_PAGE_TRACE',false);}
}