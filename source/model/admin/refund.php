<?php

namespace ng169\model\admin;
use ng169\Y;


checktop();
class refund extends Y{
 
	public function addmsg($id,$uid,$mark){
		$inser['refundid']=$id;
		$inser['remark']=$mark;
		$inser['apptime']=time();
		$inser['issystem']=1;
		$inser['uid']=$uid;
		$inser['adminid']=parent::$wrap_admin['adminid'];
		T('refund_detail')->add($inser);
	}
    
	public function addmsg2($id,$muid,$mark){
		$user=T('merchant')->get_one(array('muid'=>$muid));
        
		$inser['refundid']=$id;
		$inser['uid']=$user['uid'];
		$inser['remark']=$mark;
		$inser['apptime']=time();
		$inser['issystem']=1;
		$inser['adminid']=parent::$wrap_admin['adminid'];
		T('refund_detail')->add($inser);
	}
	public function tk($refundid){
		if(!$refundid)return false;
		$data=T('order_refund')->set_field('*,v.cash')->join_table(array('t'=>'order_product','refundid','refundid'),1)->join_table(array('t'=>'order','ordernum','ordernum'),1)->get_one(array('refundid'=>$refundid));
		if(!$data)return false;
		if(!$data['cash'])return false;
		/*if($data['status']>3)return false;*/
		if($data['orderstatus']==4)return false;
		$sx=$data['paytotal']-$data['tksums'];
		if($sx<$data['cash'])return false;
		
		
	
	
	
	if($data['stype']==1){
		T('order_product')->update(array('shflag'=>2),array('refundid'=>$data['refundid'],'ordernum'=>$data['ordernum']));
		T('order_refund')->update(array('orderstatus'=>4),array('refundid'=>$data['refundid']));
		$this->addmsg($refundid,$data['uid'],'买家确认完成售后');	
	}
	else{
		if($data['status']<3){
		M('cash','im')->setuid($data['uid'])->add($data['cash'],$data['soleid'],$data['ordernum'].'退款');}
		T('order_refund')->update(array('orderstatus'=>4),array('refundid'=>$data['refundid']));
		if($sx==$data['cash'] && $data['status']<3){
		$i['status']=4;
	}
		
		$i['tksums']=$data['tksums']+$data['cash'];
		T('order')->update($i,array('ordernum'=>$data['ordernum']));
		T('order_product')->update(array('tkflag'=>2),array('refundid'=>$data['refundid'],'ordernum'=>$data['ordernum']));
		$this->addmsg($refundid,$data['uid'],'退款成功，金额：￥'.rmb($data['cash']).'元');
	}
	
	return true;
}
 	public function close($refundid){
 	if(!$refundid)return false;
		$data=T('order_refund')->get_one(array('refundid'=>$refundid,'orderstatus'=>array('0,1,2,3')));
	if(!$data)return false;	
	T('order_refund')->update(array('orderstatus'=>5),array('refundid'=>$refundid));
 	}
}
?>
