<?php


namespace ng169\service;

checktop();
class Output 
{
	private static $header;
	private static $outtype;
	private static $body;
	private static function sethead(){
		
	}
	/**
	* 输出内容
	* @param string $body
	* 
	* @return void
	*/
	public static function out($body){
		
	}
	/**
	* 添加输出内容体
	* @param string $body
	* 
	* @return void
	*/
	public static function set($body){
		self::$body.=$body;
	}
}

?>
