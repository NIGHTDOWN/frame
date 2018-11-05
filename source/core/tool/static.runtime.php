<?php


checktop();
class YRunTime{
    private static $_starttime = 0;
    private static $_stoptime = 0;
    private static $_spendtime = 0;

    public static function getmicrotime()
	{
        list($usec, $sec)=explode(" ",microtime());
        return ((float)$usec + (float)$sec);
	}
	public static function start()
	{
      
		self::$_starttime = self::getmicrotime();
	}

    public static function display()
	{
		self::$_stoptime = self::getmicrotime();
		self::$_spendtime = self::$_stoptime-self::$_starttime;
        return round(self::$_spendtime, 6);
	}
}
?>
