<?php




global $config;

$config=array(
    
    'source'=>ROOT."/source/",
    'tpl'=>ROOT."/tpl/",
    'data'=>ROOT."/data/",
    'conf'=>ROOT."/conf/",
    'core'=>ROOT."/source/core/",
    'control'=>ROOT."/source/control/",
    'hook'=>ROOT."/source/core/hook/",
    'model'=>ROOT."/source/model/",
     'plugin'=>ROOT."/source/core/plugin/",
     'service'=>ROOT."/source/core/service/",
    'db'=>ROOT."/source/core/db/",
    'api'=>ROOT."/source/core/api/",
    'lib'=>ROOT."/source/core/lib/",
    'tool'=>ROOT."/source/core/tool/",
    'shortcut'=>ROOT."/source/core/shortcut/",
     'log'=>ROOT."/data/log/",
     'G_siteurl'=>'http://'.$_SERVER['SERVER_NAME'],
    
    'install'=>'NG',
    
    'checktop'=>false,

    'g_charset'=>'utf-8',
    'source_encode'=>1,
    'g_error_reporting'=>1,
    'g_memory_limit'=>'128m',
    'g_timezone'=>'PRC',
    #安装地址
    'g_install_url'=>'install/index.php',
   
  
    'g_safe_filter'=>'0', 
    #control前缀
	'G_ACTION_PRE'=>'control_',
    #模板配置
    'g_static'=>PATH_URL.'tpl/static/',#模板静态库路径
	'g_admintpl'=>PATH_URL.'tpl/admin/',#后台模板路径
	'g_indextpl'=>PATH_URL.'tpl/templets/',#前台模板路径
	'g_usertpl'=>PATH_URL.'tpl/user/',#用户模板路径'g_static'=>PATH_URL.'tpl/static/',#模板静态库路径
	'g_realstatic'=>ROOT.'tpl/static/',#模板静态库路径
	'g_realadmintpl'=>ROOT.'tpl/admin/',#后台模板路径
	'g_realindextpl'=>ROOT.'tpl/templets/',#前台模板路径
	'g_realusertpl'=>ROOT.'tpl/user/',#用户模板路径
	'g_realtplpre'=>'html' ,#模板后缀
    #id关联
    'g_uid'=>'uid',
    'g_aid'=>'adminid',
    #版权
	'g_powerby'=>'思铭',
	'copyright_header'=>'',
	'copyright_author'=>'思铭',
	#版本消息
    'G_copyright_type'=>'@',
	'g_copyright_version'=>'0120151025',
	'g_copyright_release'=>'',
    #分割标志
	'g_break'=>'_',
	'img404'=>PATH_URL.'tpl/static/images/404img.png',
	#常用常量
	'g_day'=>'86400',
	#模板缓存
	'g_smarty_cache'=>'1',
            );

?>
