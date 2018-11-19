<?php


namespace ng169\service;

checktop();
class Output
{
  private static $header;
  private static $outtype;
  private static $body;
  private static $data = [];
  private static function sethead()
  {
	
  }
  /**
  * 输出内容
  * @param string $body
  *
  * @return void
  */
  public static function show($html)
  {
    if ($html)echo $html;
    echo self::$body;
    
  }
  public static function get($key = null)
  {
    if (!$key)return self::$data;
    if (isset(self::$data[$key]))return self::$data[$key];
    return false;
  }
  /**
  * 添加输出内容体
  * @param string $body
  *
  * @return void
  */
  public static function set($key,$value)
  {
    self::$data[$key] = $value;
  }
  /**
  * 设置输出html内容
  * @param undefined $body
  *
  * @return
  */
  public static function setHtml($body)
  {
    self::$body .= $body;
  }
  	public static function out($data){
  	echo $data;
  
  	die();
  }
}

?>
