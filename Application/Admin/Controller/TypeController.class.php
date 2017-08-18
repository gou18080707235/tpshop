<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class TypeController extends AdminController {
    //列表展示
    public function showlist(){
        $info=D('Type')->select();
        $this->assign('info',$info);
        $this->display();
    }
    //添加类型
    public function tianjia(){
        $type=D('Type');
        if(IS_AJAX && !empty($_POST)){
            $data=I('post.');
            if($type->add($data)){
                exit(json_encode(['status'=>200,'message'=>'分类添加成功']));
            }else{
                exit(json_encode(['status'=>202,'message'=>'分类添加失败']));
            }
        }

        $this->display();
    }
}