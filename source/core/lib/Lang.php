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
    if (file_exists($fielname)) {
      self::$lang = include($fielname);
    }


  }
  public static  function load()
  {
    //加载模块公共语言
    //加载control语言
    $dir        = LANG.FG.G_LANG.FG.D_GROUP.FG;
    $baselang   = $dir.D_GROUP.'_index'.G_EXT;
    $methodlang = $dir.D_MEDTHOD.'_index'.G_EXT;
    
    if (file_exists($baselang)) {
      $lang = include($baselang);
      self::$lang=array_merge(self::$lang,$lang);
    }
    if (file_exists($methodlang)) {
      $method = include($methodlang);
      self::$lang=array_merge(self::$lang,$method);
    }
  }
  public static  function get($index)
  {
    if (isset(self::$lang[$index]))return self::$lang[$index];
    return $index;
  }
}

?>
