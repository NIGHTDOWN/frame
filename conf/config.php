<?php

#非系统开发商请勿随意修改参数；否则导致数据错乱；我们不提供修复
define('G_DB_DEBUG',0);#sql调试
define('G_DEBUG',1);#全局调试
define('G_TEMP_DEBUG',1);#模板调试
/*define('G_CLEAR_CACHE',1);#强制重新写模版缓存*/
define('G_DEBUG_PAY_LOG',1);#支付调试日志开关
define('G_COMPILE_TPL',1);#强制重新更新编译模板,测试环境开启

define('GET_SERVER_DEBUG',0);#显示接收参数name或则映射名

#nosql缓存设置
define('CACHE_NOSQL_START',false);#开启memcache
define('CACHE_NOSQL_HOST','127.0.0.1');#memcache服务器
define('CACHE_NOSQL_PORT','11211');#memcache端口
#sql缓存设置
define('CACHE_SQL_START',true);#开启sql缓存
define('CACHE_SQL_TABLE','cache');#缓存表
define('CACHE_SQL_KEY','key');#缓存键
define('CACHE_SQL_VALUE','value');#缓存值
define('CACHE_TIMEOUT',G_DAY);#缓存超时时长
define('CACHE_DB_TIMEOUT',3600);#数据库缓存超时时长

#默认表前缀
define('DB_PREFIX','a_');
define('DB_SOCKPOST','7777');

#默认缓存类型 类型有3中nosql mysql file
define('CACHE_TYPE','mysql');
#全局密钥
define('AUTH_CODE_KEY','vvnjgyghohjnbhgdtnkllkjtfhg');
?>
