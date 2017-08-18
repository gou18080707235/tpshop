<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class RoleController extends AdminController {
    //展示角色页面
    public function showlist(){
        $role=D('Role');
        $info=$role->select();
        $this->assign('info',$info);
        $this->display();
    }
    //分配权限方法
    public function distribute(){
        $role=D('Role');
        //如果是POST表单提交的数据则表示是分配权限
        if(IS_POST){
            //判断用户是否非法操作
            $role_dis_id=session('role_dis_id');
            if($role_dis_id===$_POST['role_id']){
                //调用模型文件进行相关数据处理,并有返回值flag
                $z=$role->saveAuth($_POST['role_id'],$_POST['auth_id']);
                //根据返回值判断是否分配权限成功
                if($z){
                    $this->success('更新成功',U('Admin/Role/showlist'));
                }else{
                    $this->error('更新失败',U('Admin/Role/distribute',array('role_id'=>$_POST['role_id'])));
                }
            }else{
                //用户非法操作的处理
                $this->error('相关参数有问题，请联系管理员',U('showlist'));
            }

        }
        //用户不是Post表单则展示可以分配的权限页面
        //接受数据‘
        $role_id=I('get.role_id');
        //将角色ID写入Session中防止用户非法操作
        session('role_dis_id',$role_id);
        //根据角色ID查找角色表的所有信息
        $role_info=D('Role')->find($role_id);
        $this->assign('role_info',$role_info);
        //操作权限表获得权限信息
        //获取的顶级权限信息
        $authinfoA=D('Auth')->where(array('auth_level'=>'0'))->select();
        //获得子权限信息
        $authinfoB=D('Auth')->where(array('auth_level'=>'1',))->select();
        $this->assign('authinfoA',$authinfoA);
        $this->assign('authinfoB',$authinfoB);
        $this->display();
    }
}