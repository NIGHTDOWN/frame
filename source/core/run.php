<?php
namespace ng169;
define(INSTALL, true);
//弃用
/*$_init_mictime = explode(' ', microtime());
$_start_time = $_init_mictime[1] + $_init_mictime[0];*/
if(!function_exists('get_magic_quotes_gpc')){
	define('MAGIC_QUOTES_GPC', false);
}else{
	define('MAGIC_QUOTES_GPC', @get_magic_quotes_gpc());
}

/*if(PHP_VERSION < '4.1.0'){
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_ENV = &$HTTP_ENV_VARS;
	$_FILES = &$HTTP_POST_FILES;
}*/
#加上反斜杠
function _daddslashes($string){
	#没有开启魔镜，自动加上反斜杠
	if(!MAGIC_QUOTES_GPC){
		if(is_array($string)){
			foreach($string as $key => $val){
				$string[$key] = _daddslashes($val);
			}
		}else{
			$string = addslashes($string);
		}
	}
	return $string;
}
if(isset($_REQUEST['GLOBALS']) or isset($_FILES['GLOBALS'])){
	exit('Request tainting attempted.');
}
#外部提交自动加上反斜杠

#判断是否安装
if(!defined(INSTALL)){
	header("Location:".G_INSTALL_URL);
}

#初始化入口类
require_once CORE . 'core.php';
/*Y::loadTool('runtime');

YRunTime::start();*/

#设置时区
if(PHP_VERSION >= '5.1'){
	date_default_timezone_set(G_TIMEZONE);
}
#设置单个文件大小
ini_set('memory_limit', G_MEMORY_LIMIT);
#初始化插件
/*$plugin_hooks = array();
if(G_ERROR_REPORTING){
	@error_reporting(E_ALL & ~ E_NOTICE);
}else{
	error_reporting(0);
	ini_set('display_errors', 'off');
}*/
#载入配置

im(CONF.'global/config.inc.php');
//im(CONF.'global/db.inc.php');

#载入数据库扩展
im(DB.'mysql.php');

im(DB.'dao.php');

#摘入app入口
im(CORE.'Application.php');
#载入Util包

im(TOOL.'static.request.php');
im(TOOL.'static.filter.php');
im(TOOL.'static.out.php');
im(TOOL.'static.url.php');
im(LIB.'static.log.php');

#映入工具包
#核心载入



#自动载入快捷名shortcut/下的php文件
#载入缓存模块文件缓存；nosql缓存；数据库缓存

im(CORE.'cache/nosql.php');
im(CORE.'cache/sql.php');
im(CORE.'cache/file.php');
#开启全局缓存对象

switch (CACHE_TYPE)
{
	case 'nosql':
        Y::$cache=new \ng169\cache\Nosql();
     
        ;break;
    case 'mysql':
        Y::$cache=new \ng169\cache\Mysql();
               
        ;break;
    case 'file':
        Y::$cache=new \ng169\cache\File();
              
        ;break;
    
}

Y::__run();	
#开启安全模式
if(G_SAFE_FILTER){
	im(CORE.'safe/safe.php');
	new safe();
}
#伪静态解码

if(Y::$conf['rewrite']){
	YUrl::back();
}

?>
