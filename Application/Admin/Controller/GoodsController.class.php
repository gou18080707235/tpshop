<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class GoodsController extends AdminController {
    //商品列表页面
    public function showlist(){
        //实例化Goods对象
        $goods=D('Goods');
        //通过goods_id进行排序查询所有记录
        $info=$goods->getAllGoods();
        //将结果分配到模板文件中进行展示
        $this->assign('info',$info);
        $this->display();
    }
    //商品添加页面
    public function tianjia(){
        //通过IS_POST来判断是否是通过POST方式提交
        $goods=D('Goods');
        if(IS_POST){
            $this->deal_log();
            //接收数据
            $data=I('post.');//收集信息，安全过滤

            //因为是富文本编辑器，不可以过滤数据
            $data['goods_introduce']=\fangXSS($_POST['goods_introduce']);
            $data['add_time']=$data['upd_time']=time();//添加时间与修改时间一致
            //判断是否添加成功
            if($newid=$goods->add($data)){
                $this->del_attr($newid);
                $this->deal_pics($newid);
                $this->member_del($newid,$data['goods_member']);
                $this->success('添加成功',U('showlist'));
            }else{
                $this->error('添加失败',U('tianjia'));
            }
        }else{
            $typeInfo=D('Type')->select();
            $this->assign('typeInfo',$typeInfo);
            $memberInfo=D('MemberLevel')->select();
            $this->assign('memberInfo',$memberInfo);

            //如果不是通过POST提交则直接展示添加页面
            $this->display();
        }

    }
    //商品修改页面
    public function upd(){
        //接收ID
        $goods_id=I('get.goods_id');
        if(IS_POST){
            //调用私有方法处理图片
            $this->deal_log($goods_id);
            //修改相册信息
            $this->deal_pics($goods_id);
            //修改商品属性信息
            $this->del_attr($goods_id);
            $data=I('post.');
            //商品介绍进行防止XSS攻击
            $data['goods_introduce']=\fangXSS($_POST['goods_introduce']);
            $data['upd_time']=time();
            if(D('Goods')->where(array('goods_id'=>$goods_id))->save($data)){
               $this->success('商品修改成功',U('showlist'));
            }else{
                $this->error('商品修改失败',U('upd',array('goods_id'=>$goods_id)));
            }
        }
        //不是通过POST提交表单，展示修改页面，并将要修改的信息传给模板文件
        //根据接收的到的ID进行数据库查询
        $info=D('Goods')->find($goods_id);
        $typeInfo=D('Type')->select();
        $this->assign('typeInfo',$typeInfo);
        $this->assign('info',$info);
        //根据接收到的ID查询相册信息
        $picsinfo=D('Goods_pics')->where(array('goods_id'=>$goods_id))->select();
        $this->assign('picsinfo',$picsinfo);
        $this->display();
    }
    //商品删除
    public function del(){
        //接收信息
        $goods_id=I('get.goods_id');
        $goods=D('Goods');
        //删除商品
        $res=$goods->where('goods_id='.$goods_id)->delete();
        if($res){
            $this->redirect('/Admin/Goods/showlist');
        }else{
            $this->redirect('/Admin/Goods/showlist');
        }
    }
    //公用图片处理方法
    private function deal_pics($goods_id){
        //设置该图片能否被处理
        $havePics=false;
        foreach ($_FILES['goods_pics']['error'] as $v){
            if($v===0){
                $havePics=true;
                break;
            }
        }
        //判断图片能否被处理
        if($havePics==true){
            //1,大图上传
            //配置路径信息
            $cfg2=array(
                'rootPath'=>'./Public/Uploads/pics/',
            );
            //实例化图片长传类
            $up2= new \Think\Upload($cfg2);
            //uploadOne()方法会返回文件路径和名字
            $z2=$up2->upload(array($_FILES['goods_pics']));
            //2,给相册制作缩略图
            $im2=new \Think\Image();
            //遍历获取路径信息
            foreach ($z2 as $k=>$v){
                $yuan_pics=$up2->rootPath.$v['savepath'].$v['savename'];
                $im2->open($yuan_pics);//打开原图
                //制作三个缩略图：
                //800*800，350*350，50*50
                //800*800
                $im2->thumb(800,800,6);
                $pics_big=$up2->rootPath.$v['savepath'].'big_'.$v['savename'];
                $im2->save($pics_big);
                //350*350
                $im2->thumb(350,350,6);
                $pics_mid=$up2->rootPath.$v['savepath'].'mid_'.$v['savename'];
                $im2->save($pics_mid);
                //50*50
                $im2->thumb(50,50,6);
                $pics_sma=$up2->rootPath.$v['savepath'].'sma_'.$v['savename'];
                $im2->save($pics_sma);
                //删除无用的原图
                unlink($yuan_pics);
                //把缩略图相册储存给数据库
                $data=array(
                    'goods_id'=>$goods_id,
                    'pics_big'=>$pics_big,
                    'pics_mid'=>$pics_mid,
                    'pics_sma'=>$pics_sma,
                );
                D('Goods_pics')->add($data);

            }
        }
    }
    //商品名称校验
    public function checkName(){
        $goods_name=I('get.goods_name');
        $goods=D('Goods');
        $info=$goods->where(array('goods_name'=>$goods_name))->find();
        if($info){
            echo json_encode(array('status'=>0));
        }else{
            echo json_encode(array('status'=>1));
        }
    }
    //实现商品Logo图片上传处理
    //使用$_POST，而不能使用$data,因为$data是局部变量，不是全局变量，而$_POST是全部变量
    //$goods_id=0表示是图片新增操作
    //$goods_id不为零表示是图片修改操作
    private function deal_log($goods_id){
        //给商品实现logo上传
        if($_FILES['goods_logo']['error']===0){
            //修改商品时则删除以前的图片
            if($goods_id!==0){
                $goods_info=D('Goods')->find($goods_id);
                if(file_exists($goods_info['goods_big_log'])){
                    unlink($goods_info['goods_big_log']);
                }
                if(file_exists($goods_info['goods_small_log'])){
                    unlink($goods_info['goods_small_log']);
                }
            }
            //1，正常上传的图片
            $cfg=array(
                'rootPath'=>'./Public/Uploads/logo/',
            );
            //实例化图片长传类
            $up= new \Think\Upload($cfg);
            //uploadOne()方法会返回文件路径和名字
            $z=$up->uploadOne($_FILES['goods_logo']);
            //将上传好的文件信息保存到数据库
            $_POST['goods_big_logo']=$up->rootPath.$z['savepath'].$z['savename'];
            //2，对图片制作缩略图
            //实例化缩略图对象
            $im=new \Think\Image();
            //打开文件
            $im->open($_POST['goods_big_logo']);
            //设置缩略图比例
            $im->thumb(130,130,6);
            //设置缩略图路径
            $smallPathName=$up->rootPath.$z['savepath'].'small_'.$z['savename'];
            //保存路径
            $im->save($smallPathName);
            //添加到DATA数组中
            $_POST['goods_small_logo']=$smallPathName;

        }

    }
    //后台AJAX发送的删除相册请求方法
    public function delPics(){
        $pics_id=I('post.pics_id');
        //根据ID作为条件对数据库进行查询
        $picsinfo=D('Goods_pics')->find($pics_id);
        //删除照片
        if(file_exists($picsinfo['pics_big'])){unlink($picsinfo['pics_big']);}
        if(file_exists($picsinfo['pics_mid'])){unlink($picsinfo['pics_mid']);}
        if(file_exists($picsinfo['pics_sma'])){unlink($picsinfo['pics_sma']);}
        if(D('Goods_pics')->delete($pics_id)){
            //删除成功
            echo json_encode(array('status'=>0));
        }else{
            //删除失败
            echo json_encode(array('status'=>1));
        }
    }
    //通过AJAX发送的请求，当前类型的数据
    public function getAttrByType(){
        $type_id=I('get.type_id');
        $attrInfo=D('Attribute')
            ->where(array('type_id'=>$type_id))
            ->select();
        //返回json数据
        echo json_encode($attrInfo);
    }
    //添加商品属性时属性维护
    private function del_attr($goods_id){
        D('GoodsAttr')->where(array('goods_id'=>$goods_id))->delete();
        foreach ($_POST['attr_info'] as $k=>$v){
            foreach ($v as $vv){
                if(!empty($vv)){
                    $arr['goods_id']=$goods_id;
                    $arr['attr_id']=$k;
                    $arr['attr_value']=$vv;
                    D('goods_attr')->add($arr);
                }
            }
        }
    }
    public function getAttrByType2(){
        if(IS_AJAX){
            $goods_id=I('get.goods_id');
            $type_id=I('get.type_id');
            $arrinfo=D('Attribute')
                ->alias('a')
                ->field('a.*,(select group_concat(ga.attr_value) from sp_goods_attr as ga where ga.attr_id=a.attr_id and ga.goods_id='.$goods_id.') as attr_values')
                ->where(array('a.type_id'=>$type_id))
                ->select();
            echo json_encode($arrinfo);
        }
    }
    private function member_del($goods_id,$memberInfo){
        foreach($memberInfo as $k=>$v){
            $v=(float)$v;
            //if($v==0)continue;
            D('MemberPrice')->add(array('goods_id'=>$goods_id,
                                        'level_id'=>$k,
                                        'price'=>$v,
                ));
        }
    }
    public function staticHtml(){
        //获取商品ID
        $goods_id=I('get.goods_id');
        $username=session('username');
        $user_id=session('user_id');
            $goodsInfo=D('Goods')
                ->find($goods_id);
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
        $this->assign('$manyInfo',$manyInfo);
        $this->assign('onlyInfo',$onlyInfo);
        $this->assign('goodsInfo',$goodsInfo);

        $res=file_put_contents('./Public/StaticHtml/goods_'.$goods_id.'_show.html',$this->fetch('static/detail'));

        //echo $res;
        dump($res);
    }

}