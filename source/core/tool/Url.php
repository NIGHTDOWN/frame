<?php


namespace ng169\tool;

class Url{
	private static $debar = array('admin');
	private static $ssl="http://";
	private static $http="https://";
	private static $ip='';
	private static function gethttp(){
		return 'http://';
	/*	if($_SERVER['HTTPS']=='off')
		return 'http://';
		return 'https://';*/
	}
	public static
	function isstatic($group){
		$group = $group?$group:$_GET['m'];
       
		if((!in_array($group,self::$debar)) && Y::$conf['rewrite']){
			return true;
		}else{
			return false;
		}
	}
	public static
	function back(){
			
		$group = $group?$group:$_GET['m'];
		if(!self::isstatic($group)){
			return false;
		}
	
		$param = urldecode($_SERVER["REQUEST_URI"]);
		$param=preg_replace('/\/index.php/','',$param);
		$param = trim($param,'/');
		$arr   = array_filter(explode('/',$param));
		$case  = sizeof($arr);
		switch($case){
			case '0':
			$ar = array();
			self::setget($ar);break;
			case '1':
			if(self::isparam($arr[0])){
				$p = self::catparam($arr[0]);
               
				$ar= $p;
			}else{
				$ar = array('c'=>$arr[0]);
			}

      
			self::setget($ar);break;
			case '2':
			$ar = array('c'=>$arr[0]);

			if(self::isparam($arr[1])){
				$p = self::catparam($arr[1]);
				$ar= array_merge($ar,$p);
			}else{
				$ar['alias'] = $arr[1];
			}
          
			self::setget($ar);break;
			case '3':
			$ar = array('c'    =>$arr[0],'alias'=>$arr[1]);
			$p = self::catparam($arr[2]);
			$ar= array_merge($ar,$p);

			self::setget($ar);
			break;
		}

		return true;
	}
	private static 
	function isparam($parm){
		return stripos($parm,'-') || stripos($parm,'=');
	}

	private static 
	function catparam($p){

		$ret = array();
		$pre = '.'.Y::$conf['rewritepre'];
		$ar   = explode($pre,$p);
       
		$need = $ar[0];
		$ar   = preg_split("/(-|=)/", $need );

		$max  = sizeof($ar);
		for($i = 0; $i <= $max ; $i += 2 ){
			if($ar[$i] && $ar[$i + 1]){
				$ret[trim(trim($ar[$i],'?'),'&')] = $ar[$i + 1];
			}
		}
		return $ret;
	}
	private static 
	function setget($p){
		$_GET = array_merge($p,$_GET);
	}
	public static
	function url($args = null, $action = null, $mod = null, $group = null,$ip=null){
		
		$group = $group?$group:D_GROUP;
		if(is_array($args)){
			if(isset($args['a'])){
				unset($args['a']);
			}
			if(isset($args['m'])){
				unset($args['m']);
			}
			if(isset($args['c'])){
				unset($args['c']);
			}
		}
		
		if($ip){
			self::$ip=$ip;
		}else{
			self::$ip=$_SERVER["SERVER_NAME"];
		}
		if(isset($args['alias']) && isset($args['catid'])){
			unset($args['catid']);
		}
		
		if(self::isstatic($group) && !in_array($group,self::$debar) && $ip==null){
			$url = self::get_url_static($args, $action, $mod, $group,$ip);
		}else{
			$url = self::get_url_dynamic($args, $action, $mod, $group,$ip);
		}
		return $url;
	}
	private static
	function get_url_dynamic($args = null, $action = null, $mod = null,
		$group = null,$ip=null){
		$a    = defined('D_FUNC')?D_FUNC:'run';
		$c    = defined('D_MEDTHOD')?D_MEDTHOD:'index';
		$file = 'index.php?';
		$fh   = '&';
		$param='';
		if(is_array($args)){
			foreach($args as $name => $vaal){
				if($name != null && $vaal != null){
					$param .= "{$fh}{$name}={$vaal}";
				}
			}
		}
       
		$group = $group?$group:D_GROUP;
		if($group != 'index' && $group != ''){
			$m = 'm='. $group. $fh;
		}
		$mod    = $mod?$mod:$c;

		$action = $action?$action:'run';
		if($ip=='/' || $ip==null){
			$ip=$_SERVER["SERVER_NAME"];
		}
		
	
		$url    = self::gethttp().$ip.'/'.$file .$m. 'c='.$mod. $fh.'a=' . $action . $param;
		return $url;
	}
	private static
	function get_url_static($args = null, $action = null, $mod = null,
		$group = null,$ip=null,$preflag = 1){
		$a      = defined('D_FUNC')?D_FUNC:'run';
		$c      = defined('D_MEDTHOD')?D_MEDTHOD:'index';
		$file   = 'index.php?';
		$fh     = '/';
		$group  = $group?$group:D_GROUP;
		$mod    = $mod?$mod:$c;
		$action = $action?$action:'run';
		$alias  = null;
		$city = null;

		if($mod == 'index'){
			$mod = '';
		}

		if($mod != null){
			$mod = $mod.'/';
		}

		if(isset($args['alias'])){
			$alias = $args['alias'].'/';
		}
		if(isset($args['alias'])){
			unset($args['alias']);
		}

		$url = self::gethttp().$_SERVER["SERVER_NAME"].'/';

		if(is_array($args)){
			foreach($args as $name => $vaal){
				if($name != null && $vaal != null){
					$param .= "-{$name}-{$vaal}";
				}
			}
		}
		if($group != null && $group != 'index'){
			$param = '-m-'.$group.$param;
		}
		if($action != null && $action != 'run'){
			$param = '-a-'.$action.$param;
		}
		$param = urlencode(trim($param,'-'));

		if($param != null && Y::$conf['rewritepre'] != null && $preflag){
			$pre = '.'.Y::$conf['rewritepre'];
		}

		$url = self::gethttp().$_SERVER["SERVER_NAME"].'/'.$mod.$alias.$param.$pre;
		return $url;
	}
    
	public static
	function load_static(){

		$file = '/.htaccess';
		Y::loadTool('file');
		$msg  = '<IfModule mod_rewrite.c>
		RewriteEngine On
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
		</IfModule>';
		YFile::writeFile($file,$msg);
	}
    
	public static
	function unload_static(){
		$file = '/.htaccess';
		Y::loadTool('file');
		YFile::delFile($file);
	}
	public static
	function ismoible(){ 
		if ( (@$_GET['windows']=='mobile'))
		{
			return true;
		} 
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
   
    if (isset ($_SERVER['HTTP_VIA']))
    { 
      
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
  
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
      
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
  
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 
	public static
	function isAjax(){

		if(@$_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest'){

			return true;
		}
		if(!empty($_POST['ajax']) || !empty($_GET['ajax']))
		return true;
		return false;

	}
}
?>
