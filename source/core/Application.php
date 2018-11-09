<?php
namespace ng169;

checktop();
class APP
{
  #载入Application白名单
  public function loadValidApplication()
  {
    $apppath = ROOT . './source/roll/app/';
    $handle  = @opendir($apppath);
    $da      = array();
    while ($file = @readdir($handle)) {
      if (preg_match("/^[\w\.\/]+\.php$/", $file)) {
        $d = null;
        $d = require_once ($apppath . $file);
        if (is_array($d)) {
          if (is_array($da)) {
            $da = array_merge($da, $d);
          }
          else {
            $da = $d;
          }
        }
      }
    }
    if (!empty($da)) {
      return array('app'=> $da);
    }
    else {
      return array('app'=> '');
    }
  }
  #载入控制器白名单
  public static function loadingValidController($type = 'index')
  {
    $cpath = ROOT . './source/roll/validc/';
    if ($type == 'index') {
      $cpath .= 'index/';
    }
    elseif ($type == 'admin') {
      $cpath .= 'admin/';
    }
    $handle = @opendir($cpath);
    $data   = array();
    while ($file = @readdir($handle)) {
      if (preg_match("/^[\w\.\/]+\.php$/", $file)) {
        $d = null;
        $d = require_once ($cpath . $file);
        if (is_array($d)) {
          if (is_array($data)) {
            $data = array_merge($data, $d);
          }
          else {
            $data = $d;
          }
        }
      }
    }
    return $data;
  }
  #载入Hook所有文件
  public static function initHook()
  {
    $hookpath = CORE . '/hook/';
    $handle   = @opendir($hookpath);
    while ($item = @readdir($handle)) {
      $ext = pathinfo($item);
      if ($ext['extension'] == 'php') {
        require_once ($hookpath . $item);
      }
    }
  }
  public static function run()
  {

    $m = YFilter::filterXSS(YRequest::getGpc('m'));
    $a = YFilter::filterXSS(YRequest::getGpc('a'));
    $c = YFilter::filterXSS(YRequest::getGpc('c'));
    $m = $m?$m:'index';$c = $c?$c:'index';$a = $a?$a:'run';

    if (!defined(D_GROUP)) {
      define('D_GROUP',$m);

    }
    if (!defined(D_MEDTHOD)) {
      define('D_MEDTHOD',$c);
    }
    if (!defined(D_FUNC)) {
      define('D_FUNC',$a);
    }
    if (Y::$conf['rewrite']) {
      YUrl::back();
    }

    $appfile = ROOT . "./source/".D_GROUP.".php";

    if (!file_exists($appfile)) {
      die("Application ".D_GROUP." is not found!");
    }
    else {

      im ($appfile);
    }


  }
  #初始化Application
  #定义参数常量D_GROUP D_MEDTHOD  D_FUNC


}
?>
