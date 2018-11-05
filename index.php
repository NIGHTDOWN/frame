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

APP::run();
die();
?>
