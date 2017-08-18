<?php
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model{
    public function getAllGoods(){
        $info=$this->order('goods_id desc')->select();
        return $info;
    }
}