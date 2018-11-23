<?php


namespace ng169\tool;
use ng169\lib\Option;
checktop();

class Init
{
  private static $action_name = array('list'    =>'列表','add'     =>'添加','edit'    =>'编辑','save'    =>'保存','show'    =>'详情','run'     =>'列表','add_view'=>'添加','cgpwd'   =>'修改密码','del'     =>'删除');


  public static function mod($mod_dir)
  {

    $mod_dir = CONTROL.$mod_dir;

    if (is_dir($mod_dir)) {
      if ($dh = opendir($mod_dir)) {
        while (($file = readdir($dh)) !== false) {
          $file_absolute = $mod_dir.'/'.$file;
          if (file_exists($file_absolute)&&!is_dir($file_absolute) && pathinfo($file_absolute,PATHINFO_EXTENSION) == 'php') {
            $index = pathinfo($file_absolute,PATHINFO_FILENAME);
            $mod[$index]['alias'] = '';
            $mod[$index]['action'] = self::action($file_absolute);
          }
        }
        closedir($dh);
        return $mod;
      }
    }
  }
  private static function action($file)
  {
    $prefix = G_ACTION_PRE;
    if (file_exists($file)&&!is_dir($file) && pathinfo($file,PATHINFO_EXTENSION) == 'php') {
      $buffer = file_get_contents($file);
      $ptter  = "/public+\s+function+\s+".$prefix."(\w+)\(\)/";
      preg_match_all($ptter, $buffer,$out,PREG_PATTERN_ORDER);
      if (is_array($out[1])) {
        $action = array();
        foreach ($out[1] as $a) {
          $action[$a]['alias'] = self::$action_name[$a]?self::$action_name[$a]:'';
          $action[$a]['seo'] = 1;
        }
      }
      return $action;
    }
  }
  /**
  * 获取模块控制器下面的别名
  * @param string $mod
  *
  * @return array 
  */
  public static function get($mod)
  {
    if (!$mod)return false;
    $conf = Option::get('admin');
    return $conf;
  }
  public static function load($mod_dir)
  {
    $path = $path ? $path : 'conf/';

    $file = $path.'/'.$mod_dir.".inc.php";
    if (is_file($file)) {
      return include($file);
    }
    return false;
  }
}

?>
