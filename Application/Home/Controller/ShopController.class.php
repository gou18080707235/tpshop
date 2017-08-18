<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends Controller{
    public function addCart(){
        if (IS_AJAX){
            //根据商品id查询数据库
            $goods_id = I('get.goods_id');
            $goods_new_price=session('goods_new_price');
            //将查询到的信息封装成数组，以交给CART类处理
            $info =  M('goods')->find($goods_id);
            $data['goods_id'] = $info['goods_id'];
            $data['goods_name'] = $info['goods_name'];
            if(empty($goods_new_price)){
                $data['goods_price'] = $info['goods_member_price'];
                $data['goods_total_price'] = $info['goods_member_price'];
            }else{
                $data['goods_price'] = $goods_new_price;
                $data['goods_total_price'] =$goods_new_price;
            }

            $data['goods_buy_number'] = 1;

            //实例化CART类
            $cart = new \Home\Common\Cart();
            $cart -> add($data);
            //获取到数量和价格
            $number_price  = $cart->getNumberPrice();
            //将CART类返回的数量和价格通过JSON返回给模板
            exit(json_encode($number_price ));

        }
    }
    //购物车详情页面
    public function viewCart(){
        //从cookie中获取回来信息
        $cart=new \Home\Common\Cart();
        $cartInfo=$cart->getCartInfo();
        //dump($cartInfo);
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
        $this->assign('cartInfo',$cartInfo);
        //获取商品数量以及价格
        $number_price=$cart->getNumberPrice();
        $this->assign('number_price',$number_price);
        $this->display();
    }
    //购物车中商品数量改变以及价格的改变
    public function changeNumber(){
        //接收数据
       if(IS_AJAX){
           $goods_id=I('post.goods_id');
           $num=I('post.num');
           $cart= new \Home\Common\Cart();
           $xiaoji_price=$cart->changeNumber($num,$goods_id);
           $number_price=$cart->getNumberPrice();
           echo json_encode(array(
               'total_price'=>$number_price['price'],
               'xiaoji_price'=>$xiaoji_price
           ));
       }
    }
    //购物车中删除商品
    public function delGoods(){
        if(IS_AJAX){
            $goods_id=I('get.goods_id');
            $cart= new \Home\Common\Cart();
            $cart->del($goods_id);
            $number_price=$cart->getNumberPrice();

            echo json_encode($number_price);

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
            echo '订单生成中';
        }else{
            //判断用户是否已经登陆
            $username=session('username');
            if(empty($username)){
                session('back_url','Shop/goodsOrder');
                $this->redirect('User/login');
            }
            $cart=new \Home\Common\Cart();
            $cartInfo=$cart->getCartInfo();
            dump($cartInfo);die;
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

        $this->display();
    }
}