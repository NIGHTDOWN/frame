<?php



namespace ng169\model\index;
use ng169\Y;

checktop();

class order  extends Y{
	private function get_userid(){
		$uid=parent::$wrap_user['uid'];
		if(!$uid)die();
		return $uid;
	}
	public function getwaitpay(){
		return T('order')->get_count(array('uid'=>$this->get_userid(),'delflag'=>0,'status'=>0));
	}
	public function getwaitsure(){
		return T('order')->get_count(array('uid'=>$this->get_userid(),'delflag'=>0,'status'=>2));
	} 
	public function getwaitfh(){
		return T('order')->get_count(array('uid'=>$this->get_userid(),'delflag'=>0,'status'=>1));
	} 
	public function getwaitcomment(){
		return T('order')->set_where(array('uid'=>$this->get_userid(),'delflag'=>0,'status'=>3,'cflag'=>0))->get_count();
	} 
	public function getwaittk(){
		return T('order')->get_count(array('delflag'=>0,'uid'=>$this->get_userid(),'status'=>5));
	} 
	public function create($products,$nums){
	
		
		$this->seoadd('确认订单');
		$uid=$this->get_userid();
		$get=get(array('int'=>array('num'=>1,'pid'=>1,'addid'=>1),'string'=>array('spec','logis','mark')),array('num'=>'数量','mark'=>'备注','addid'=>'收货地址','pid'=>'产品编号','spec'=>'产品规格','logis'=>'物流类型'));
		$product=T('product')->join_table(array('t'=>'merchant','muid','muid'))->set_where(array('pflag'=>1,'shelves'=>1,'status'=>0,'productid'=>$get['pid']))->get_one();
		if(!$product){
			error('产品不存在');
		}
		if($get['num']>$product['count']){
			error('库存不足');
		}
		$logisfee=M('logisfee','im')->getprice($product['productid'],$get['num']);
		if($logisfee){
			if(!$logisfee[$get['logis']]){
				error('物流选择错误');
			}
			$logisfee=$logisfee[$get['logis']];
		}
		
		$insert['uid']=$uid;
		$insert['addid']=$get['addid'];
		$address=T('user_address')->join_table(array('t'=>'province','provinceid','provinceID'),1)->join_table(array('t'=>'city','cityid','cityID'),1)->join_table(array('t'=>'area','areaid','areaID'),1)->get_one($insert);
		if(!$address)error('收货地址错误');
		$insert['ordernum']=$this->get_ordernum();
		$insert['addid']=$address['addid'];
		$insert['address']=$address['province'].$address['city'].$address['area'].$address['address'];
		$insert['realname']=$address['realname'];
		$insert['phone']=$address['recvphone'];
		$insert['mobile']=$address['recvmobile'];
		$insert['status']=0;
		$insert['mark']=$get['mark'];
		$insert['createtime']=time();
		T('order')->add($insert);
		$insert2['ordernum']=$insert['ordernum'];
		$insert2['productid']=$product['productid'];
		$insert2['productname']=$product['productname'];
		$insert2['smallimg']=$product['smallimg1'];
		$insert2['spec']=$get['spec'];
		$insert2['num']=$get['num'];
		$insert2['price']=$product['price'];
		$insert2['logisfee']=$logisfee;
		$insert2['logis']=$get['logis'];
		$insert2['muid']=$product['muid'];
		$insert2['bid']=M('snapshot','im')->make($product['productid']);
		$insert2['subtotal']=$product['price']*$get['num']+$logisfee;
		
		T('order_product')->add($insert2);
		T('order')->update(array('totals'=>$insert2['subtotal'],'paytotal'=>$insert2['subtotal']),array('ordernum'=>$insert['ordernum']));
		//支付成功在减库存
		/*T('product')->update(array('count'=>$product['count']-$insert2['num']),array('productid'=>$product['productid']));*/
		//跳转到支付页面
		gourl(geturl(array('oid'=>$insert['ordernum']),'product','pay','pay'));
	}
	public function usersure($ordernum){
	
		$get['status']=2;
		$get['ordernum']=$ordernum;
		$get['uid']=$this->get_userid(1);
		/*$get['status']=2;*/
		$data=T('order')->get_one($get);
		
		if(!$data)error('订单不存在');
		if($data['status']!=2)error('订单不能操作');
		//订单状态改变 
		//通知卖家状态
		//跳转到评价页面
		//商户钱包加钱
		$up['status']=3;
		$up['sure']=1;
		$up['suretime']=time();	
		T('order')->update($up,$get);
		$refund=T('order_refund')->get_all(array('orderid'=>$data['orderid'],'orderstatus'=>array(0,1,2,3)));
		foreach($refund as $v){
			M('refund','am')->addmsg($v['refundid'],$v['uid'],'订单状态变化，【用户确认付款】，申请关闭');
			M('refund','am')->close($v['refundid']);
			T('order_product')->update(array('tkflag'=>4),array('refundid'=>$v['refundid'],'tkflag'=>1));
		}
		$info=T('merchant')->get_one(array('muid'=>$data['muid']));
		M('cash','im')->setuid($info['uid'])->add($data['paytotal']-$data['tksums'],$data['soleid'],$data['ordernum'].'交易完成');
		$where=array('ordernum'=>$ordernum);
		$geturl=geturl(null,'order_sure','asyn','admin');
		YAsyn::start($geturl,$where);
		return 1;
	}
	public function adminsure($ordernum){
		$get['status']=array(1,2);;
		$get['ordernum']=$ordernum;
	/*	$get['uid']=$this->get_userid(1);*/
		/*$get['status']=2;*/
		$data=T('order')->get_one($get);
		if(!$data)error('订单不存在');
		/*if($data['status']!=2)error('订单不能操作');*/
		//订单状态改变 
		//通知卖家状态
		//跳转到评价页面
		//商户钱包加钱
		$up['status']=3;
		$up['sure']=2;
		$up['suretime']=time();	
		$up['closeadminid']=parent::$wrap_admin['adminid'];	
		T('order')->update($up,$get);
		$refund=T('order_refund')->get_all(array('orderid'=>$data['orderid'],'orderstatus'=>array(0,1,2,3)));
		foreach($refund as $v){
			M('refund','am')->addmsg($v['refundid'],$v['uid'],'订单状态变化，【用户确认付款】，申请关闭');
			M('refund','am')->close($v['refundid']);
			T('order_product')->update(array('tkflag'=>4),array('refundid'=>$v['refundid'],'tkflag'=>1));
		}
		$info=T('merchant')->get_one(array('muid'=>$data['muid']));
		M('cash','im')->setuid($info['uid'])->add($data['paytotal']-$data['tksums'],$data['soleid'],$data['ordernum'].'交易完成');
		$where=array('ordernum'=>$ordernum);
		$geturl=geturl(null,'order_sure','asyn','admin');
		YAsyn::start($geturl,$where);return 1;
	}
	public function autosure($ordernum){
		$get['status']=2;
		$get['ordernum']=$ordernum;
	/*	$get['uid']=$this->get_userid(1);*/
		/*$get['status']=2;*/
		$data=T('order')->get_one($get);
		if(!$data)error('订单不存在');
		if($data['status']!=2)error('订单不能操作');
		//订单状态改变 
		//通知卖家状态
		//跳转到评价页面
		//商户钱包加钱
		$up['status']=3;
		$up['sure']=3;
		$up['suretime']=time();	
		T('order')->update($up,$get);
		$info=T('merchant')->get_one(array('muid'=>$data['muid']));
		M('cash','im')->setuid($info['uid'])->add($data['paytotal'],$data['soleid'],$data['ordernum'].'交易完成');
		$where=array('ordernum'=>$ordernum);
		$geturl=geturl(null,'order_sure','asyn','admin');
		YAsyn::start($geturl,$where);return 1;
	}
	
}

?>
