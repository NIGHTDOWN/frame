<?php
$apiid=3;
//支付宝异步支付回调；
define('ROOT',dirname(dirname(__FILE__)).'/');
#相对URL路径
define('PATH_URL','/');
require_once ROOT.'source/core/enter.php';
$apiinfo=T('payapi')->get_one(array('flag'=>0,'apiid'=>$apiid));
if(!$apiinfo)error('API不存在');
Y::loadAPI($apiid);
$api=new payapi($apiinfo['api_name'],$apiinfo['api_key']);
$bool=$api->sync();
$orderurl=geturl('',null,'order','user');
if(!$bool){
	error('支付失败',$orderurl);
}else{	im('affair.php');
	$where=array('soleid'=>$bool['soleid']);
	$info=T('pay')->get_one($where);
	if(!$info)error('支付记录不存在',$orderurl);
	if($info['paystatus']==1)out('支付成功',$orderurl,null,1);
	if($info['paystatus']==2)error('交易已经关闭，请勿支付',$orderurl);
	if($info['paystatus']==0){
		switch($info['for']){
			case 0:
			product_back($bool);
				break;
			case 1:
			recharge_back($bool);
			
			
				break;
			
		}
	}
}
die();

?>
