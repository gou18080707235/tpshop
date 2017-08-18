<?php
namespace Home\Controller;
use Think\Controller;
class KillController extends Controller{
    public function kill_list(){
        $nowtime=time();
        $info=D('Kill')->alias('k')->field('k.start_time,k.end_time,k.kill_price,g.*')->join('__GOODS__ as g on g.goods_id=k.goods_id')->where(array('k.end_time'=>array('gt',$nowtime)))->select();
        foreach ($info as $v){
            $v['nowtime']=$nowtime;
            $goodsInfo[]=$v;
        }
        //dump($goodsInfo);
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }
    public function sec_kill(){
        $goods_id=I('get.goods_id');
        $nowtime=time();
        $goodsInfo=D('Kill')->alias('k')->field('k.key,k.start_time,k.end_time,k.kill_price,g.*')->join('__GOODS__ as g on g.goods_id=k.goods_id')->where(array('g.goods_id'=>$goods_id,'k.end_time'=>array('gt',$nowtime)))->find();
        session('kill_price',$goodsInfo['kill_price']);
        $redis=new \Redis();
        $redis->connect('192.168.83.129');
        $sy_num=$redis->get($goodsInfo['key']);
        $goodsInfo['sy_num']=$sy_num;
        //dump($goodsInfo);
        //获取商品唯一信息
        $onlyInfo=D('GoodsAttr')
            ->alias('ga')
            ->join('__ATTRIBUTE__ as a on ga.attr_id=a.attr_id')
            ->where(array('ga.goods_id'=>$goods_id,'a.attr_sel'=>'only'))
            ->field('a.attr_id,a.attr_name,ga.attr_value')
            ->select();
        //获得商品单选属性
        $manyInfo=D('GoodsAttr')
            ->alias('ga')
            ->join('__ATTRIBUTE__ as a on a.attr_id=ga.attr_id')
            ->where(array('ga.goods_id'=>$goods_id,'a.attr_sel'=>'many'))
            ->field('a.attr_id,a.attr_name,group_concat(ga.attr_value) as attr_values')
            ->group('a.attr_id')
            ->select();
        foreach ($manyInfo as $k => $v){
            $manyInfo[$k]['value']=explode(',',$v['attr_values']);
        }
        //获取相册信息
        $picInfo=D('GoodsPics')
            ->where(array('goods_id'=>$goods_id))
            ->select();
        $this->assign('picInfo',$picInfo);
        //dump($picInfo);
        $this->assign('manyInfo',$manyInfo);
        //dump($manyInfo);
        $this->assign('onlyInfo',$onlyInfo);
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }
    public function check_num(){
        $key=I('post.key');
        $num=I('post.num');
        $redis=new \Redis();
        $redis->connect('192.168.83.129');
        $check_num=$redis->get($key);
        if($check_num-$num<0){
            echo json_encode(array('status'=>201,'msg'=>'您买的数量大于剩余数量啦'));
        }else if($check_num-$num>0){
            session('buy_num',$num);
            $res=$redis->decrBy($key,$num);
            echo json_encode(array('status'=>200,'sy_num'=>$res));
        }else{
            echo json_encode(array('status'=>202,'msg'=>'服务器繁忙，请稍后再试'));
        }
    }
    public function addCart(){
        if (IS_AJAX){
            //根据商品id查询数据库
            $goods_id = I('get.goods_id');
            $num=session('buy_num');
            //dump($num);
            $price=session('kill_price');
            //将查询到的信息封装成数组，以交给CART类处理
            $info =  M('goods')->find($goods_id);
            $data['goods_id'] = $info['goods_id'];
            $data['goods_name'] = $info['goods_name'];
            $data['goods_price'] = $price;
            $data['goods_buy_number'] = $num;
            $data['goods_total_price'] = $num*$price;


            //实例化CART类
            $cart = new \Home\Common\Cart();
            $cart -> add($data);
            //获取到数量和价格
            $number_price  = $cart->getNumberPrice();
            //将CART类返回的数量和价格通过JSON返回给模板
            exit(json_encode($number_price ));

        }
    }
}