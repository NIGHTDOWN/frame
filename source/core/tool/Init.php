<?php


namespace ng169\tool;

checktop();

class Init{
	private static $action_name=array('list'=>'列表','add'=>'添加','edit'=>'编辑','save'=>'保存','show'=>'详情','run'=>'列表','add_view'=>'添加','cgpwd'=>'修改密码','del'=>'删除');
    
    
	public static function mod($mod_dir){

		$mod_dir=CONTROL.$mod_dir;
        
		if(is_dir($mod_dir)){
			if($dh = opendir($mod_dir)){
				while(($file = readdir($dh)) !== false){
					$file_absolute=$mod_dir.'/'.$file;
					if(file_exists($file_absolute)&&!is_dir($file_absolute) &&pathinfo($file_absolute,PATHINFO_EXTENSION)=='php'){
						$index=pathinfo($file_absolute,PATHINFO_FILENAME);
						$mod[$index]['alias']='';
						$mod[$index]['action']=self::action($file_absolute);
					}
				}
				closedir($dh);
				return $mod;
			}
		}
	}
	private static function action($file){
		$prefix=G_ACTION_PRE;
		if(file_exists($file)&&!is_dir($file) &&pathinfo($file,PATHINFO_EXTENSION)=='php'){
			$buffer=file_get_contents($file);
			$ptter="/public+\s+function+\s+".$prefix."(\w+)\(\)/";
			preg_match_all($ptter, $buffer,$out,PREG_PATTERN_ORDER);
			if(is_array($out[1])){
				$action=array();   
				foreach($out[1] as $a){
					$action[$a]['alias']=self::$action_name[$a]?self::$action_name[$a]:'';
					$action[$a]['seo']=1;
				}
			}
			return $action;
		}
	}
	public static function make_conf_file($mod_dir,$path=null){
		$path=$path ? $path : 'conf/';
		$file=$path.'/'.$mod_dir.".inc.php";
		Y::loadTool('file');
		if(file_exists($file))return include($file);
		$conf=self::mod($mod_dir);
		$conf="<?php\n \n return  ".var_export($conf,true)."\n?>";
        
		YFile::createFile($file);
		YFile::writeFile($file,$conf);
		return $conf;
	}
	public static function load($mod_dir){
		$path=$path ? $path : 'conf/';
		 
		$file=$path.'/'.$mod_dir.".inc.php";
		if(is_file($file)){
			return include($file);
		}
		return false;
	}
}

?>
