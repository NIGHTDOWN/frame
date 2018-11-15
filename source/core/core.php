<?php
namespace ng169;
use ng169\lib\Widget;
use ng169\lib\Option;
use ng169\lib\Lang;
checktop();
class Y
{

  protected static $instance = array();

  public static $wrap_admin = array();

  public static $wrap_merchant = array();

  public static $wrap_where = array();

  public static $wrap_page = array();

  public static $wrap_user = array();

  public static $wrap_city = array();

  public static $urlpath = null;
  public static $conf = array();
  public static $urlsuffix = 'php';
  public static $tplpath = 'tpl/templets/';
  public static $skinpath = null;
  public $seo = array('desc'   =>'','keyword'=>'','title'  =>'');
  #全局缓存对象
  public static $cache = null;
  public static $dao = null;
  //需要登入的方法(空表示禁止所有，*表示允许所有)
  protected  $noNeedLogin = [];
  //需要验权限方法(空表示禁止所有，*表示允许所有)
  protected $noNeedPower = [];
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
    #载入全局缓存
    #载入模板
    Option::LoadSiteCache();
    self::_runView();
    #载入钩子
    APP::initHook();
    self::$dao = new \ng169\db\daoClass;
    #载入异步组件
    Y::loadTool('asyn');
  }


  #smarty
  public static
  function _runView()
  {

    #载入模板文件
    im(CORE.'tpl.php');
    /*im(CORE.'smarty/class.smarty.php');*/
    TPL::__run();
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
    if (isset(Y::$conf['conf'][$type])) {
      return Y::$conf['conf'][$type].'/'.$class_name . '.php';
    }
    return false;
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
    return $class_name ;
  }

//加载模型
  public static
  function model($model_name, $type)
  {
  	
  	$typedir=['im'=>'index','am'=>'admin'];
  	$dir=$type;
  	if(isset($typedir[$type])){
		$dir=$typedir[$type];
	}
	$index=$model_name.$type;
  	$modelcls="ng169\\model\\$dir\\$model_name";
  
    if (!isset(self::$instance['model'][$index])) {
  
      if (!class_exists($modelcls)) {
        
         error($modelcls.__('模型不存在'));
      }
      $my_model = new $modelcls;
      self::$instance['model'][$index] = $my_model;
    }
    return self::$instance['model'][$index];
  }




  public static
  function getparm($arr,$data = null)
  {

    im(SERVICE.'service.php');
    $get = new service($arr,$data);
    return $get;
  }



  private static
  function _getServicePath($service_name, $type)
  {
    $service_path = dirname(dirname(__FILE__)).'/'.self::$source_path[$type] . 'service.' . $service_name . '.php';
    $service_path = $service_path;
    return $service_path;
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
    $calss = "\\ng169\\model\\".$file;
    return new $calss($name);
  }




}




?>
