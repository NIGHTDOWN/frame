<?php
namespace ng169;
use ng169\tool\Filter;
use ng169\tool\Request;
checktop();
class APP
{

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
    \ng169\tool\Url::resolve();//路由
    $m = Filter::filterXSS(Request::getGpc('m'));
    $a = Filter::filterXSS(Request::getGpc('a'));
    $c = Filter::filterXSS(Request::getGpc('c'));
    $m = $m?$m:'index';$c = $c?$c:'index';$a = $a?$a:'run';

/* if (isset(Y::$conf['rewrite']) && Y::$conf['rewrite']) {
      \ng169\tool\Url::back();
    }*/

    if (!defined('D_GROUP')) {
      define('D_GROUP',$m);

    }
    if (!defined('D_MEDTHOD')) {
      define('D_MEDTHOD',$c);
    }
    if (!defined('D_FUNC')) {
      define('D_FUNC',$a);
    }


    $appfile = ROOT . "./source/".D_GROUP.".php";

    if (!file_exists($appfile)) {
      error("Application ".D_GROUP." is not found!");
    }
    else {

      self::execControl();
    }


  }

  private static function execControl()
  {
    $cls = "ng169\\control\\".D_GROUP.'\\'.D_MEDTHOD;
    $act = G_ACTION_PRE.D_FUNC;

    try {
      $control = new $cls;
    }catch (\Exception $e) {
      error($e.__('控制器类不存在'));
    }catch (\Error $e) {
      error($e.__('控制器类不存在'));
    }
    //启动控制器
    if (method_exists($control, $act) && $act{0} != '_') {
      $control->$act();
    }
    else {
      error($act.__('操作动作不存在'));

    }


  }

}
?>
