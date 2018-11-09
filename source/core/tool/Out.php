<?php


namespace ng169\tool;
use ng169\Y;
use ng169\tool\Url as YUrl;

checktop();
class Out
{


  private static function _html404($msg = null)
  {

    if ($msg == null) {
      $msg = "非常抱歉，您要查看的页面没有办法找到";
    }
    $var_array = array('msg'=> $msg);
    TPL::assign($var_array);

    TPL::display(Y::$path['general_tpl'] . '404/index.html',1);
  }
  public static function page404($msg = null)
  {

    @header("http/1.1 404 not found");
    @header("status: 404 not found");
    self::_html404();
    die();
  }
  public static function development($msg = null)
  {
    if ($msg == null) {
      $msg = "功能开发中，敬请期待";
    }
    $var_array = array('msg'=> $msg);
    TPL::assign($var_array);
    TPL::display(Y::$path['general_tpl'] . '/development/index.html');
  }
  public static function error($error)
  {

    echo "<meta http-equiv='Content-Type' content='text/html; charset=" .
    OEPHP_CHARSET . "' />
    <style>body{font-size:12px;line-height:25px;}</style>
    <body>
    " . $error . "
    </body>
    ";
    die();
  }


  public static function redirect($url, $time = 0)
  {
    if (!headers_sent()) {
      if ($time === 0)
      header("Location:{$url}");
      header("refresh:" . $time . ";url=" . $url . "");
      die();
    }
    else {
      exit("<meta http-equiv='Refresh' content='{$time};URL={$url}'>");
      die();
    }
  }

  public static function out($message, $url = null, $flag = true, $auto_go_url = true)
  {
    /* M('log','am')->logtxt($message,$flag);*/

    if (!YUrl::isAjax()) {
      if ($url == null) {
        $url = @$_SERVER['HTTP_REFERER'];
      }
      if (YUrl::ismoible()) {
        require_once ROOT.Y::$path['general_tpl'] . '/mhalt/halt.php';
      }
      else {
        require_once ROOT.Y::$path['general_tpl'] . '/halt/halt.php';
      }

    }
    else {

      if (!$flag) {

        $ret = array('error' => array('errormsg'=> $message),'flag' => $flag,'url'  =>$url);

      }
      else {

        $ret = array('data'=> $message,'flag'=> $flag,'url' =>$url);
      }
      echo json_encode($ret);
    }
    die();
  }


}

?>
