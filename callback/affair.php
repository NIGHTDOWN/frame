<?php
//支付回调日志
function paylog(){
	if(G_DEBUG_PAY_LOG){
		$content = file_get_contents('php://input', 'r'); 
		YLog::txt($content,LOG.'支付异步调试_'.date('Y-m-d').'.log');
	}
}
paylog();
function product_back($bool){
$orderurl=geturl('',null,'order','user');
	$where=array('soleid'=>$bool['soleid']);
	$info=T('pay')->get_one($where);
	if(!$info)error('支付记录不存在',$orderurl);
	if($info['paystatus']==1)out('支付成功',$orderurl,null,1);
	if($info['paystatus']==2)error('交易已经关闭，请勿支付',$orderurl);
	if($info['paystatus']==0){
		$data=$bool;
		$data['paystatus']=1;
		$f=T('pay')->update($data,$where);
		$ordernum=explode(',',$info['ordernums']);
		$orderwhere=array('ordernum'=>$ordernum);
		$update['status']=1;
		$update['payflag']=1;
		$update['paytime']=time();
		/*$update['autocommenttime']=$update['paytime']+(Y::$conf['order_sure_day']*G_DAY);*/
		$update['soleid']=$data['soleid'];
		/*$update['autocommenttime']=time()+7*G_DAY;*/
		T('order')->update($update,$orderwhere);
		$product=T('product')->join_table(array('t'=>'order_product','productid','productid'))->get_all($orderwhere);
		$productlist=array_column($product,'productid');
		$upwhere['productid']=$productlist;
		$upwhere['status']=0;
		$upwhere['pflag']=1;
		$up=array('sells'=>'sells+1','count'=>'count-1');
		T('product')->updata(array('w'=>$upwhere,'v'=>$up),0);
		//通知
		 $url=geturl(null,'shop_product_pay','asyn','admin');
		$array=array('muid'=>$product[0]['muid'],'ordernum'=>$product[0]['ordernum']);
		YAsyn::start($url,$array);
		
		return $orderurl;
		/*out('支付成功',$orderurl,null,1);*/
	}
}
function recharge_back($bool){
	$orderurl=geturl('',null,'index','pay');
	$where=array('soleid'=>$bool['soleid']);
	$info=T('pay')->get_one($where);
	if(!$info)error('支付记录不存在',$orderurl);
	if($info['paystatus']==1)out('支付成功',$orderurl,null,1);
	if($info['paystatus']==2)error('交易已经关闭，请勿支付',$orderurl);
	if($info['paystatus']==0){
		$data=$bool;
		$data['paystatus']=1;
		$f=T('pay')->update($data,$where);
		M('cash','im')->setuid($info['uid'])->add($info['paycash'],$info['soleid'],'充值');
		/*out('充值成功',$orderurl,null,1);*/
		return $orderurl;
	}
}


?>
