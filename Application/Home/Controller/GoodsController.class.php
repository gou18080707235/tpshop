<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
    private $no_user_last_look;
    private $user_last_look;
    //商品列表页面
    public function showlist(){
        //获取所有商品信息
        $goodsInfo=D('Goods')
            ->order('goods_id desc')
            ->field('goods_id,goods_name,goods_price,goods_small_logo,goods_member_price')
            ->select();
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }
    //商品详情页面
    public function detail(){
        //接收数据
        $goods_id=I('get.goods_id');
        $username=session('username');
        $user_id=session('user_id');
        if(empty($username)){
            $goodsInfo=D('Goods')
                ->find($goods_id);
            $redis=new \Redis();
            $redis->connect('192.168.83.129');
            $this->no_user_last_look='no_user_last_look';
            $data['goods_name']=$goodsInfo['goods_name'];
            $data['goods_price']=$goodsInfo['goods_price'];
            $data['goods_small_logo']=$goodsInfo['goods_small_logo'];
            //dump($data);
            $res=$redis->lPush($this->no_user_last_look,serialize($data));
            //dump($res);
        }else{

            //获取当前用户的积分
            $jifen=D('User')->field('jifen')->find($user_id);
            $jifen=$jifen['jifen'];
            //获取会员等级列表信息
            $memberInfo=D('MemberLevel')->select();
            //调用方法确认用户的等级ID和折率
            $level_rate_id=$this->getRange($memberInfo,$jifen);
            //获得商品信息
            $goodsInfo=D('Goods')
                ->find($goods_id);
            $redis=new \Redis();
            $redis->connect('192.168.83.129');
            $this->user_last_look='user_'.$user_id.'_last_look';
            $data['goods_name']=$goodsInfo['goods_name'];
            $data['goods_price']=$goodsInfo['goods_peice'];
            $data['goods_small_logo']=$goodsInfo['goods_small_logo'];
            $redis->lSet($this->user_last_look,$data);
            //查询用户折扣金额
            $member_price=D('MemberPrice')->where(array('goods_id'=>$goods_id,'level_id'=>$level_rate_id['id']))->find();
            //判断用户填写的折扣金额是否0，则按默认打折，否则按照用户自定义打折
            if($member_price['price']=='0'){
                $goodsInfo['goods_member_price']=$level_rate_id['level_rate']*0.01*$goodsInfo['goods_price'];
                session('goods_new_price',$level_rate_id['level_rate']*0.01*$goodsInfo['goods_price']);
                $this->updShop();

            }else{
                $goodsInfo['goods_member_price']=$member_price['price'];
                session('goods_new_price',$member_price['price']);
            }
            $this->updShop();

        }

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
        $redis=new \Redis();
        $redis->connect('192.168.83.129');
        $username=session('username');
        if($username){
            $lastinfo=unserialize($redis->lRange($this->user_last_look,0,5));
        }else{
            $lastinfo=$redis->lRange($this->no_user_last_look,0,4);
            foreach ($lastinfo as $v ){
                $v=unserialize($v);
                $last_info[]=$v;
            }
        }
        //获取相册信息
        $picInfo=D('GoodsPics')
            ->where(array('goods_id'=>$goods_id))
            ->select();
        dump($last_info);
        $this->assign('last_info',$last_info);
        $this->assign('picInfo',$picInfo);
        //dump($picInfo);
        $this->assign('manyInfo',$manyInfo);
        //dump($manyInfo);
        $this->assign('onlyInfo',$onlyInfo);
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }
    //获取用户的折扣率和会员级别ID
    public function getRange($memberInfo,$jifen){
        foreach($memberInfo as $v){
            //查询当前积分所在的级别；若果匹配到则立即return折扣率和会员级别ID
            if($jifen<=$v['jifen_top'] && $jifen>=$v['jifen_bottom']){
                return ['level_rate'=>$v['level_rate'],'id'=>$v['id']];
            }
        }
    }
    //用户登陆后更新购物车
    public function updShop(){
        $cart=new \Home\Common\Cart();
        $cartInfo=$cart->getCartInfo();
        $user_id=session('user_id');
        //获取当前用户的积分
        $jifen=D('User')->field('jifen')->find($user_id);
        $jifen=$jifen['jifen'];
        //获取会员等级列表信息
        $memberInfo=D('MemberLevel')->select();
        //dump($memberInfo);
        //调用方法确认用户的等级ID和折率
        $level_rate_id=$this->getRange($memberInfo,$jifen);
        //dump($level_rate_id);
        if(!empty($cartInfo)){
            foreach ($cartInfo as $k => $v){
                //获取商品信息
                $goodsInfo=D('Goods')->find($k);
                //获取用户填写的折扣价格
                $member_price=D('MemberPrice')->where(array('goods_id'=>$k,'level_id'=>$level_rate_id['id']))->find();
               // dump($member_price);
                if($member_price['price']=='0'){
                    $data['goods_id'] = $k;
                    $data['goods_name'] = $v['goods_name'];
                    $data['goods_price'] = $level_rate_id['level_rate']*$goodsInfo['goods_price']*0.01;
                    $data['goods_buy_number'] = $v['goods_buy_number'];
                    $data['goods_total_price'] =$level_rate_id['level_rate']*$goodsInfo['goods_price']*0.01*$v['goods_buy_number'];

                    $cart->del($k);
                    $cart->add($data);
                    //dump($data);
                }else if($member_price['price']!='0'){
                    //dump($v);
                    $data['goods_id'] = $k;
                    $data['goods_name'] = $v['goods_name'];
                    $data['goods_price']=$member_price['price'];
                    $data['goods_buy_number'] =$v['goods_buy_number'];
                    $data['goods_total_price']=$member_price['price']*$v['goods_buy_number'];
                    $cart->del($k);
                    $cart->add($data);
                }
            }
            //dump($data);
        }

    }
    //订单生成页面
    public function goodsOrder(){
        if(IS_POST){
            //收集信息
            //订单表入库
            $cart=new \Home\Common\Cart();
            $number_price=$cart->getNumberPrice();
            $data=I('post.');
            $data['user_id']=session('user_id');
            $data['order_number']='sijiu-'.date('YmdHis').'-'.mt_rand(1000,9999);
            $data['order_price']=$number_price['price'];
            $data['add_time']=$data['upd_time']=time();
            $order_id=D('Order')->add($data);
            //订单关联商品表入库
            $cartInfo=$cart->getCartInfo();
            // dump($cartInfo);
            $data2=array();
            foreach ($cartInfo as $k => $v){
                $data2['order_id']=$order_id;
                $data2['goods_id']=$k;
                $data2['goods_price']=$v['goods_price'];
                $data2['goods_number']=$v['goods_buy_number'];
                $data2['goods_total_price']=$v['goods_total_price'];
                D('OrderGoods')->add($data2);
            }
            $cart->delAll();
            $this->redirect('Shop/orderDetail');
        }else{
            //判断用户是否已经登陆
            $username=session('username');
            if(empty($username)){
                session('back_url','Goods/goodsOrder');
                $this->redirect('User/login');
            }
            $this->updShop();
            $cart=new \Home\Common\Cart();
            $cartInfo=$cart->getCartInfo();
            //dump($cartInfo);
            //dump($cartInfo);die;
            //获取商品ID
            $goods_ids=implode(',',array_keys($cartInfo));
            //获取小图
            $logoInfo=D('Goods')->field('goods_id,goods_small_logo')->select($goods_ids);
            //dump($logoInfo);
            //将图片信息追加到cartInfo数组中
            foreach($cartInfo as $k =>$v){
                foreach($logoInfo as $vv){
                    if($k==$vv['goods_id']){
                        $cartInfo[$k]['logo']=$vv['goods_small_logo'];
                    }
                }
            }
            //dump($cartInfo);
            //dump($goods_ids);
            $user_id=session('user_id');
            $address=D('Consignee')->where(array('user_id'=>$user_id))->select();
            //dump($address);
            $this->assign('address',$address);
            $this->assign('cartInfo',$cartInfo);
            //获取商品数量以及价格
            $number_price=$cart->getNumberPrice();
            $this->assign('number_price',$number_price);
        }

        $this->display('Shop/goodsOrder');
    }
}