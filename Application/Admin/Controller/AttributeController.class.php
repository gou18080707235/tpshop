<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class AttributeController extends AdminController{
    //属性页面
    public function showlist(){
        //获取要获取类型的ID
        $type_id=I('get.type_id');
        $attr=D('Attribute');
        //连表查询，当前类型的所有属性
        $info=$attr->alias('a')
                ->join('__TYPE__ as t on a.type_id=t.type_id')
                ->field('a.*,t.type_name')
                ->where(array('a.type_id'=>$type_id))
                ->select();
        $typeInfo=D('Type')->select();
        //分配到模板页面中
        $this->assign('typeInfo',$typeInfo);
        $this->assign('info',$info);
        $this->display();
    }
    //添加属性
    public function tianjia(){
        $attr=D('Attribute');
        if(IS_POST){
            //表单自动验证
            $data=$attr->create();
            if($data!==false){
                //将用户提交的中文逗号替换为英文逗号
                $data['attr_vals']=str_replace('，',',',$data['attr_vals']);
                if($attr->add($data)){
                    $this->success('添加成功',U('showlist'));
                }else{
                    $this->success('添加失败',U('showlist'));
                }
            }else{
                //表单验证失败，将错误信息分配到模板页面
                $this->assign('errorInfo',$attr->getError());
            }

        }
        //不是POST提交则展示相关页面
        $typeinfo=D('Type')->select();
        $this->assign('typeinfo',$typeinfo);
        $this->display();
    }
    //通过AJAX查询当前类型所对应的属性
    public function getAttrInfoByType(){
        if(IS_AJAX){
            $type_id=I('get.type_id');
            if($type_id>0){
                //如果用户传的有ID则显示当前类型所对应的属性
                //连表查询
                $info=D('Attribute')
                    ->alias('a')
                    ->join('__TYPE__ as t on a.type_id=t.type_id')
                    ->field('a.*,t.type_name')
                    ->where(array('a.type_id'=>$type_id))
                    ->select();
                echo json_encode($info);
            }else{
                //获取所有的类型
                $info=D('Attribute')
                    ->alias('a')
                    ->join('__TYPE__ as t on a.type_id=t.type_id')
                    ->field('a.*,t.type_name')
                    ->select();
                echo json_encode($info);
            }

        }
    }
}