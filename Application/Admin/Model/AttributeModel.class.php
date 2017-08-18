<?php
namespace Admin\Model;
use Think\Model;
class AttributeModel extends Model{
    //开启批量验证
    protected $patchValidate  =  true;//对多个项目同时验证
    protected $_validate=array(
        //属性名称验证
        array('attr_name','require','属性名称必须设置'),
        array('type_id','0','商品类型ID不能为0',0,'notequal'),
    );
}