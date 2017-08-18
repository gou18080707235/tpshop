<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model{
    public function getAllGoods(){
        $count      = $this->count();
        $prev='prev';
        $next='next';
        $Page       = new \Think\Page($count,3);
        $Page->setConfig($prev,'上一页');
        $Page->setConfig($next,'下一页');
        $show       = $Page->show();
        $list=$this->order('add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        return ['show'=>$show,'list'=>$list];
    }
}