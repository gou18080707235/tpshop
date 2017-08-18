<?php
namespace Admin\Model;
use Think\Model;
class RoleModel extends Model {
    //分配权限信息方法
    //$role_id,int  要分配的角色ID
    //$auth_id  array  要分配的权限Id
    public function saveAuth($role_id,$auth_id){
        //将传过来的auth_id数组转换为字符串，符合数据库要求
        $auth_ids=implode(',',$auth_id);
        //根据auth_ids查询对应的全选，组装role表中role_auth_ac字段
        $authinfo=D('Auth')
            ->where(array('auth_level'=>array('gt','0'),'auth_id'=>array('in',$auth_ids)))
            ->select();
        //dump($authinfo);die;
        //定义一个空数组，将遍历的结果装到该数组中
        $s=array();
        //遍历$authinfo二维数组
        foreach ($authinfo as $v) {
            //将数组中的'auth_c'与'auth_a'取出来，并将其组装成role表role_auth_ids字段格式
            $s[]=$v['auth_c'].'-'.$v['auth_a'];
        }
        //最后将其数组转换为字符串格式，此时已经与数据表所要求的格式一致
        $auth_ac=implode(',',$s);
        $arr=array(
            'role_id'=>$role_id,
            'role_auth_ids'=>$auth_ids,
            'role_auth_ac'=>$auth_ac,
        );
        //存储数据并将结果返回
        return $this->save($arr);

    }
}