<?php


namespace ng169\lib;


checktop();
class Lang
{

  private static $lang;
  public static  function init()
  {
 
    $defult   = 'index'.G_EXT;
    $fielname = LANG.FG.G_LANG.FG.$defult;//框架默认加载语言
    if(file_exists($fielname)){
		self::$lang     = include($fielname);
	}
    
   
  }
  public static  function load($file)
  {


  }
  public static  function get($index)
  {
    if (isset(self::$lang[$index]))return self::$lang[$index];
    return $index;
  }
}

?>
