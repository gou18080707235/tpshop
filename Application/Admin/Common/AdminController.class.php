<?php
namespace Admin\Common;
use Think\Controller;
class AdminController extends Controller {
    //构造方法
    public function __construct() {
        S(array(
           'type'=>'memcache',
            'host'=>'localhost',
            'port'=>8888
        ));
        parent::__construct();
        $admin_id=session('admin_id');
        $admin_name=session('admin_name');
        //获取用户访问的控制器与方法
        $nowAC=CONTROLLER_NAME.'-'.ACTION_NAME;
        if(!empty($admin_name)){

            //通过ADMIN_ID作为条件进行连表查询
            $roleinfo=D('Manager')
                ->alias('m')
                ->join('__ROLE__ as r on m.role_id=r.role_id')
                ->field('r.role_auth_ac')
                ->where(array('m.mg_id'=>$admin_id))
                ->find();
            $have_auth=explode(',',$roleinfo['role_auth_ac']);
            //公共允许访问的权限
            $allow_auth=array('Manager-login','Manager-verifyImg','Index-index','Index-left','Index-top','Index-right','Manager-logout','Index-center','Index-down');
            if(in_array($nowAC,$have_auth)===false && in_array($nowAC,$allow_auth)===false &&$admin_name!=='admin'){
                die('您没有权限操作');
            }
        }else{
            //未登录状态
            $allow_ac=array('Manager-login','Manager-verifyImg');
            if(in_array($nowAC,$allow_ac)===false && !IS_AJAX){
                $js=<<<str
                <script>
                window.top.location.href='/index.php/Admin/Manager/login'
</script>
str;
echo $js;
            }
        }


    }
}