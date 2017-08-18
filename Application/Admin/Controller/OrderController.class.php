<?php
namespace Admin\Controller;
use Admin\Common\AdminController;
class OrderController extends AdminController{
    //订单列表展示页面
    public function showlist(){
        $info=D('Order')->order('order_id desc')->select();
        $this->assign('info',$info);
        $this->display();
    }
    //订单详情页面展示
    public function detail(){
        //接收order_id
        $order_id=I('get.order_id');
        //连表user获得会员名称
        //连表consignee获得会员收货地址
        $orderInfo=D('Order')
            ->alias('o')
            ->join('__USER__ as u on u.user_id=o.user_id')
            ->join('__CONSIGNEE__ as c on c.cgn_id=o.cgn_id')
            ->field('o.*,u.username,c.*')
            ->find($order_id);
        //dump($orderInfo);
        $this->assign('paymethod',array('0'=>'支付宝','1'=>'微信','2'=>'银行卡'));
        $this->assign('orderInfo',$orderInfo);
        //获取订单相关商品信息
        $goodsInfo=D('OrderGoods')
            ->alias('o')
            ->join('__GOODS__ as g on g.goods_id=o.goods_id')
            ->field('o.*,g.goods_name')
            ->where(array('o.order_id'=>$order_id))
            ->select();
        //dump($goodsInfo);
        $this->assign('goodsInfo',$goodsInfo);
        $this->display();
    }
    public function showData(){
        $data=D('Order')->order('order_id desc')->select();
        $name = "Order";
        $this->export_execl($name,$data);
    }

    /**
     * 导出类
     * author Fox
     */
    public function export_execl($name,$data){
            //设置php运行时间
            //set_time_limit(0);
            /**
             * 大数据导出①
             * 设置php可使用内存
             * ini_set("memory_limit", "1024M");
             */

            Vendor('PHPExcel.PHPExcel');
            Vendor('PHPExcel.PHPExcel.Writer.Excel2007');
            $objExcel  = new \PHPExcel();
            $objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
            $objProps  = $objExcel->getProperties();
            $objProps->setCreator("tpshop");
            $objProps->setTitle("tpshop订单表");
            $objExcel->setActiveSheetIndex(0);
            $objActSheet = $objExcel->getActiveSheet();
            $objActSheet->getColumnDimension('A')->setWidth(20);
            $objActSheet->getColumnDimension('B')->setWidth(20);
            $objActSheet->getColumnDimension('C')->setWidth(20);
            $objActSheet->getColumnDimension('D')->setWidth(20);
            $objActSheet->getColumnDimension('E')->setWidth(20);
            $objActSheet->getColumnDimension('F')->setWidth(20);
            $objActSheet->setCellValue('A1', '订单ID');
            $objActSheet->setCellValue('B1', '订单编号');
            $objActSheet->setCellValue('C1', '订单价格');
            $objActSheet->setCellValue('D1', '是否付款');
            $objActSheet->setCellValue('E1', '是否发货');
            $objActSheet->setCellValue('F1', '下单时间');
            foreach ($data as $key => $value) {
                $i = $key + 2;
                $objActSheet->setCellValue('A' . $i, $value['order_id']);
                $objActSheet->setCellValue('B' . $i, $value['order_number']);
                $objActSheet->setCellValue('C' . $i, $value['order_price']);
                $objActSheet->setCellValue('D' . $i, $value['order_status'] == '0' ? '未付款' : '已付款');
                $objActSheet->setCellValue('E' . $i, $value['is_send'] == '否' ? '未发货' : '已发货');
                $objActSheet->setCellValue('F' . $i, $value['add_time']);
            }

            $fileName = $name . date("Y-m", time()) . '_tpshop.xlsx';
            $objWriter->save($fileName); Vendor('PHPExcel.PHPExcel');
            Vendor('PHPExcel.PHPExcel.Writer.Excel2007');
            $objExcel  = new \PHPExcel();
            $objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
            $objProps  = $objExcel->getProperties();
            $objProps->setCreator("tpshop");
            $objProps->setTitle("tpshop");
            $objExcel->setActiveSheetIndex(0);
            $objActSheet = $objExcel->getActiveSheet();
            $objActSheet->getColumnDimension('A')->setWidth(20);
            $objActSheet->getColumnDimension('B')->setWidth(20);
            $objActSheet->getColumnDimension('C')->setWidth(20);
            $objActSheet->getColumnDimension('D')->setWidth(20);
            $objActSheet->getColumnDimension('E')->setWidth(20);
            $objActSheet->getColumnDimension('F')->setWidth(20);
            $objActSheet->setCellValue('A1', '订单ID');
            $objActSheet->setCellValue('B1', '订单编号');
            $objActSheet->setCellValue('C1', '订单价格');
            $objActSheet->setCellValue('D1', '是否付款');
            $objActSheet->setCellValue('E1', '是否发货');
            $objActSheet->setCellValue('F1', '订单时间');
            foreach ($data as $key => $value) {
                $i = $key + 2;
                $objActSheet->setCellValue('A' . $i, $value['order_id']);
                $objActSheet->setCellValue('B' . $i, $value['order_number']);
                $objActSheet->setCellValue('C' . $i, $value['order_price']);
                $objActSheet->setCellValue('D' . $i, $value['order_status'] == '0' ? '未付款' : '已付款');
                $objActSheet->setCellValue('E' . $i, $value['is_send'] == '否' ? '未发货' : '已发货');
                $objActSheet->setCellValue('F' . $i, date('Y-m-d H:is',$value['add_time']));
            }
            $fileName = $name . date("Y-m", time()) . '_tpshop.xlsx';
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name=$fileName');
        header("Content-Disposition:attachment;filename=$fileName"); //attachment新窗口打印inline本窗口打印
        $objWriter->save('php://output');
        exit;

    }
    public function kuaidi(){
        $order_id=I('get.order_id');
        $res=I('get.res');
        //$reg='/^[a-z]+/gi';
        $arr=explode('-',$res);
        $compney=$arr[0];
        $port_id=$arr[1];
        $allow_com=array('shunfeng','yuantong','zhongtong','shentong','quanfeng');
        if(!in_array($compney,$allow_com)){
            echo json_encode(array('status'=>001));die;
        }else{
            //第三方API接口查询数据。此处做假的数据
            //快递单号入库
            $res=$this->kuaidi_id($port_id,$order_id);
            echo json_encode($res);
        }
        //dump($arr);
    }
    private function kuaidi_id($port_id,$order_id){
        $back=D('Backage');
        $info=$back->find($order_id);
        if($info){
            $data['backage_state']='已签收';
            $data['order_id']=$order_id;
            $data['backage_number']=$port_id;
            $back->save($data);
        }else{
            $data['backage_state']='快递已打包，正在通知快递公司揽件';
            $data['order_id']=$order_id;
            $data['backage_number']=$port_id;
            $back->add($data);
            D('Order')->save(['is_send'=>'是','order_id'=>$order_id]);
            return array('status'=>002);
        }
        return array('status'=>003);
    }
}