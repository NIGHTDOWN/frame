<?php


@set_time_limit(0);
global $Stime;
$Stime = microtime(true);
function getip(){
	return $_SERVER['SERVER_ADDR']?$_SERVER['SERVER_ADDR']:$_SERVER['LOCAL_ADDR'];
}
function im($F_file){
    if(file_exists($F_file)){
		require_once $F_file;
        return true;
    }else{
		
        return false;
    }
}

function loaddir($F_path,$A_filename=null){
    if(is_array($A_filename)){
        foreach($A_filename as $F){
            $realfile=$F_path.$F.'.php';
            im($realfile);
        }
        return true;
    }
	if(!is_dir($F_path)){
        d($F_path.'不是有效的目录');
	}
    $dir = new DirectoryIterator(($F_path));
    foreach ($dir as $F){
        if ($F->isFile())
        {
            im($F->getPathname());
        }
    }
    return true;
}

function loadsysconf(){
    $F_compile=ROOT.'source/compile/define.inc.php';
    $F_config=ROOT.'conf/conf.php';
    if(!im($F_compile)){
        im($F_config);
        global $config;
        foreach($config as $k=>$v){
            $index=strtoupper($k);
            $S_text.="define('{$index}','{$v}');\n";
        }
        $S_content="<?php \n".$S_text."\n?>";
        $O_handle=fopen($F_compile,'w');
        fwrite($O_handle,$S_content);
        fclose($O_handle);
    }
}

function checktop(){
    if (!defined(INSTALL) && CHECKTOP)
    {
        exit('['.INSTALL.'] Access Denied');
    }
}

function debugtime(){
    global $Stime;
    $msg=debug_backtrace();
    $backinfo="(文件:{$msg[0]['file']}; 代码行号:{$msg[0]['line']}; 调用函数名称:{$msg[0]['function']})";
    $Etime = microtime(true);
    $Ttime = $Etime - $Stime;
    $str_total = var_export($Ttime, true);
    if (substr_count($str_total, "E")) { 
        $float_total = floatval(substr($str_total, 5));
        $Ttime = ($float_total / 100000);
    }
    d('语句耗时：<b style="color:red">' . ($Ttime*1000) . '</b>毫秒   '.'消息'.$backinfo);
}

function d($name=null, $interrupt=false,$format=true)
{
    $msg=debug_backtrace();
    $backinfo="(文件:{$msg[0]['file']}; 代码行号:{$msg[0]['line']}; 调用函数名称:{$msg[0]['function']})";
    if($format){
        echo "<pre >";
    } else{
		echo "<div >";
	}
    $name=$format?var_export($name):$name;
    echo $name;
    if($format){
        echo "{$backinfo}</div>";
    } else{
		echo "{$backinfo}</pre>";
	}
    if($interrupt)
    {
        die();
    }
}

loadsysconf();

header("Content-type:text/html;charset=".G_CHARSET); 
@set_time_limit(0);
im(SHORTCUT.'function.php');

im(CORE.'run.php');



?>
