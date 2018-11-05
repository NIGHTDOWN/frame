<?php



checktop();
class YLog
{

    #记录txt消息
    public static function txt($msg,$file = null,$show=null)
    {
        $date     = date('Ymd');
        $filename = $file?$file:LOG.$date.D_MEDTHOD.'__'.D_FUNC.md5($date).'.txt';
        $url      = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $time     = date('Y-m-d H:i:s',time());
        $parm     = json_encode($_POST);
      
        /*$text     = is_array($msg)?serialize($msg):$msg;*/
         $text     = is_string($msg)?$msg:serialize($msg);
        $onetent  = "\r\n\r\n时间:\r$time\r\n请求URL:\r$url\r\n提交参数:\r$parm\r\nCOOKIES:\r$cookie\r\n消息:\r$text\r\n-------------------------------------";
        $handel   = @fopen($filename,'a');
  
        if ($handel) {
 
$onetent="\xEF\xBB\xBF".$onetent; 
  if($show){
  	$onetent="\xEF\xBB\xBF".$text; 
  }
            fputs($handel, $onetent); 
            @fclose($handel);
        }else {
            error($filename.'不存在或者没权限');
        }
        return 0;
    }
    #记录成html消息
    public static function html($msg,$file = null)
    {
        $date     = date('Ymd');
        $filename = $file?$file:LOG.$date.D_MEDTHOD.'__'.D_FUNC.md5($date).'.html';
        $url      = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $time     = date('Y-m-d H:i:s',time());
        $parm     = json_encode($_POST);
     
        $text     = is_string($msg)?$msg:serialize($msg);
        $onetent  = "<br />时间:\r$time<p>请求URL:\r$url<p>提交参数:\r$parm<p>COOKIES:\r$cookie<p style='    word-wrap: break-word;'>消息:\r$text<p><hr />";
        $handel   = @fopen($filename,'a');
        if ($handel) {
            fwrite($handel,$onetent);
            @fclose($handel);
        }else {
            error($filename.'不存在或者没权限');
        }
        return 0;
    }
}
?>
