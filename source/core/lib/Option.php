<?php


namespace ng169\lib;
use ng169\Y;

checktop();
class Option extends Y
{

  private static $config = [];
  /**
  * 获取配置
  * @param string $optionname
  * $optionname支持点号分割
  * @return array
  */
  public static function get($optionname = '')
  {
    if (!$optionname) {
      return $config;
    }
    $options = explode('.',$optionname);
    $conf    = self::$config;

    foreach ($options as  $level=>$index) {
    	
      if (isset($conf[$index])) {
        $conf = $conf[$index];
      }
    }
    
    return $conf;
  }

  /**
  * 加载配置文件
  * inc就加入conf
  * 非inc就引入
  * @return
  */
  public static  function init()
  {
  	Y::$conf=&self::$config;
    $dir = CONF;
    if (!is_dir($dir)) {
      error($dir.__('目录不存在'));
    }

    $dir = new \DirectoryIterator($dir);

    foreach ($dir as $F) {
      if ($F->isFile()) {

        $conffile = $F->getPathname();
        $name     = pathinfo($conffile,PATHINFO_BASENAME );
        $names    = explode('.',$name);
        if ($names[1] == 'inc') {
          $conf = include($conffile);
          self::$config[$names[0]] = $conf;
        }
        else {
          im($conffile);
        }

      }
    }
	
  }

}

?>
