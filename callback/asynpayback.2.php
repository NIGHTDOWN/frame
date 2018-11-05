<?php
$apiid=2;
//支付宝异步支付回调；

define('ROOT',dirname(dirname(__FILE__)).'/');
#相对URL路径
define('PATH_URL','/');
require_once ROOT.'source/core/enter.php';
$apiinfo=T('payapi')->get_one(array('flag'=>0,'apiid'=>$apiid));
if(!$apiinfo)error('API不存在');
Y::loadAPI($apiid);
$api=new payapi($apiinfo['api_name'],$apiinfo['api_key'],$apiinfo['public_key']);

$bool=$api->asyn();

/*$orderurl=geturl('',null,'order','user');*/




die();

?>
