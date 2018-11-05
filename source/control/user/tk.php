<?php





checktop();
class control extends userbase{

	public
	function control_apply(){
		$get=get(array('string'=>array('oid'=>1,'id'=>1)));
		$where['ordernum']=$get['oid'];
		$where['id']=$get['id'];
		$where['order.uid']=$this->get_userid(1);
		
		$data=T('order_product')->join_table(array('t'=>'order','ordernum','ordernum'),1)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','order.uid','uid'),1)->get_one($where);
		if(!$data)error('订单不存在');
		if($data['tkflag']==1){
			gourl(geturl($get,'detail','tk'));
		}
		$data['list']=T('refund_detail')->join_table(array('t'=>'user','uid','uid'))->get_all(array('refundid'=>$data['refundid']));
		if(!($data['status']==1 || $data['status']==2))error('订单不可操作退款');
		if($_POST){
			$get2=get(array('int'=>array('servertype'=>1,'price'=>1),'string'=>array('reason'=>1),'array'=>array('upload-button')));
			$get2['price']=$get2['price']*100;
			switch($get2['servertype']){
				case 1:
				//退款
				break;
				case 2://退货
				break;
				case 3:error('申请服务类型错误');
				break;
				default:error('申请服务类型错误');
				break;
			}
			if($get2['price']>$data['subtotal'] || $get2['price']>$data['paytotal'] ){
				error('退款金额不能大于支付金额');
			}
			$insert['ordernum']=$data['ordernum'];
			$insert['productid']=$data['productid'];
			$insert['muid']=$data['muid'];
			$insert['uid']=$this->get_userid(1);
			$insert['stype']=0;
			$insert['servertype']=$get2['servertype'];
			$insert['remark']=$get2['reason'];
			$insert['apptime']=time();
			$insert['orderid']=$data['orderid'];
			$insert['orderstatus']=0;
			$insert['cash']=$get2['price'];
			
			// if($get2['upload-button']){
			// 	$insert['userimg']=implode(',',$get2['upload-button']);
			// }
			if($get2['upload-button'] && is_array($get['upload-button'])){
				
				$insert['userimg']=implode(',',$get2['upload-button']);
			}else{
				$insert['userimg']=$get2['upload-button'];
			}
		
			// if($get2['upload-button'] && is_array($get2['upload-button'])){
			// 	$up['userimg']=implode(',',$get2['upload-button']);
			// }else{
			// 	$up['userimg']=$get2['upload-button'];
			// }
			
			$id=T('order_refund')->add($insert);

			$up['tkflag']=1;
			$up['tktime']=time();
			$up['refundid']=$id;
			$up['tkcash']=$get2['price'];
			unset($where['order.uid']);
			T('order_product')->update($up,$where);
			gourl(geturl($get,'detail','tk'));

			
			
			
		}
		$var_array=array('data'=>$data);
		
		
		
		$this->view(null, $var_array);
	}
	public
	function control_tkhd(){
		
		
		
		if($_POST){
			$get=get(array('string'=>array('refundid'=>1,'remark'=>1),'array'=>array('userimg')),array('refundid'=>'ID','remark'=>'原因','userimg'=>'图片附件'));
			
			$where['uid']=$this->get_userid(1);
			$where['refundid']=$get['refundid'];
			$id=T('order_refund')->join_table(array('t'=>'order_product','refundid','refundid'))->get_one($where);
if(!$id)error('信息不存在');
if($id['tkflag']==2)error('申请已完成');
if($id['tkflag']==4)error('申请已关闭');
			$up=$where;
			$up['apptime']=time();
			$up['remark']=$get['remark'];
			if($get['userimg'] && is_array($get['userimg'])){
				$up['userimg']=implode(',',$get['userimg']);
			}else{
				$up['userimg']=$get['userimg'];
			}
			
			T('refund_detail')->add($up);
			$ids['oid']=$id['ordernum'];
			$ids['id']=$id['id'];
			gourl(geturl($ids,'detail','tk'));

			
			
			
		}
		gourl(geturl(null,'run','index'));
	/*	$var_array=array('data'=>$data);
		
		
		
		$this->view(null, $var_array);*/
	}
public
	function control_close(){
		
		
		
	
			$get=get(array('int'=>array('refundid'=>1)),array('refundid'=>'ID'));
			$where['uid']=$this->get_userid(1);
			$where['refundid']=$get['refundid'];
			$id=T('order_refund')->get_one($where);
			if(!$id)error('信息不存在');
			/*$up=$where;
			$up['apptime']=time();*/
			$w['ordernum']=$id['ordernum'];
			$w['productid']=$id['productid'];
			$u['tkflag']=4;
			$u['tktime']=time();
			
			T('order_product')->update($u,$get);
			T('order_refund')->update(array('orderstatus'=>4),$get);
			M('refund','am')->addmsg2($id['refundid'],$id['muid'],'买家已经取消了申请');		 
		/*	$ids['oid']=$id['ordernum'];
			$ids['pid']=$id['productid'];*/
			gourl(geturl(null,'run','order'));

	
	}
public
	function control_platform(){

			$get=get(array('int'=>array('refundid'=>1)));
			$where['uid']=$this->get_userid(1);
			$where['refundid']=$get['refundid'];
			$where['jr']=0;
			$id=T('order_refund')->get_one($where);
			if(!$id)error('信息不存在');
			/*$up=$where;
			$up['apptime']=time();*/
			/*$w['ordernum']=$id['ordernum'];
			$w['productid']=$id['productid'];
			$u['tkflag']=4;
			$u['tktime']=time();*/
				$u['jr']=1;
			T('order_refund')->update($u,$where);
			
			M('refund','am')->addmsg($id['refundid'],$id['uid'],'买家已经平台介入');	
			out('申请成功',geturl(null,'run','order'));
		/*	$ids['oid']=$id['ordernum'];
			$ids['pid']=$id['productid'];*/
			

	
	}
public
	function control_detail(){
		$get=get(array('string'=>array('oid'=>1,'id'=>1)));
		$where['ordernum']=$get['oid'];
		$where['id']=$get['id'];
		$where['order.uid']=$this->get_userid(1);
		$where['stype']=0;
		
		$data=T('order_product')->join_table(array('t'=>'order','ordernum','ordernum'),1)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'order_refund','refundid','refundid'),1)->join_table(array('t'=>'user','order.uid','uid'),1)->order_by(array('f'=>'optime','s'=>'dwon'))->set_field('*,order_refund.cash as cash')->get_one($where);
		if(!$data)error('信息不存在');
		$data['list']=T('refund_detail')->order_by(array('s'=>'down','f'=>'apptime'))->join_table(array('t'=>'user','uid','uid'))->get_all(array('refundid'=>$data['refundid']));
		$var_array=array('data'=>$data);
		

		$this->view(null, $var_array);
	}
}
?>
