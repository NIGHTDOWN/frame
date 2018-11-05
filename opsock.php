<?php

/*
header('Access-Control-Allow-Origin:*'); 
// 响应类型 
header('Access-Control-Allow-Methods:POST'); 
// 响应头设置 
header('Access-Control-Allow-Headers:x-requested-with,content-type');*/
define('ROOT',dirname(__FILE__).'/');
#相对URL路径

define('PATH_URL','/');




require_once ROOT.'source/core/enter.php';


ignore_user_abort();
			set_time_limit(0); 
			error_reporting(E_ALL);
	ini_set('display_errors', '1');
	im(LIB.'/class.socket.php');
		$ipx='0.0.0.0';
		$ip=$_SERVER['SERVER_ADDR']?$_SERVER['SERVER_ADDR']:$ipx;
		$ip=$ip=='127.0.0.1'?$ipx:$ip;
		
		socketClass::start($ip,DB_SOCKPOST);
?>
