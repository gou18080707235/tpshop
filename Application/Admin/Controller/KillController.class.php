<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class KillController extends AdminController{
    public function sec_kill(){
        $goods_id=I('get.goods_id');
        if(IS_POST){
            $info=I('post.');
            $end_time=strtotime($info['end_time']);
            $start_time=strtotime($info['start_time']);
            $data['end_time']=$end_time;
            $data['start_time']=$start_time;
            $data['goods_id']=$goods_id;
            $data['kill_num']=$info['kill_num'];
            $data['key']=md5($goods_id.time());
            $data['kill_price']=$info['kill_price'];
            $res=D('Kill')->add($data);
            if($res){
                $nowtime=time();
                $lifi_time=$data['end_time']-$nowtime;
                $redis=new \Redis();
                $redis->connect('192.168.83.129');
                $redis->set($data['key'],$data['kill_num']);
                $redis->setTimeout($data['key'],$lifi_time);
                //$red=$redis->decrBy($data['key'],100);
                //dump($red);
                $this->redirect('showlist');
            }else{
                $this->redirect('Goods/showlist');
            }
        }
        $this->display();
    }
}