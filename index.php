<?php
namespace ng169;
/*
header('Access-Control-Allow-Origin:*'); 
// 响应类型 
header('Access-Control-Allow-Methods:POST'); 
// 响应头设置 
header('Access-Control-Allow-Headers:x-requested-with,content-type');*/
define('ROOT',__DIR__.'/');



require_once ROOT.'source/core/enter.php';

APP::run();
die();
?>
