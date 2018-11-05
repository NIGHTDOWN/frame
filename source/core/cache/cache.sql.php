<?php


checktop();
class csqlClass
{
    #缓存目录
    private $table ;
    #超时时长
    private $timeout;
    #编码设置
	private $charset;
    private $value;
    private $key;
    private $dbobj;
    private
    function _unSerialize($string)
    {
    	return unserialize($string);
        /*if (!empty($string)) {
            if (strtolower($this->charset) == 'utf-8') {
                return $this->_utf_unserialize($string);

            }else {
                return $this->_gbk_unserialize($string);
            }
        }else {
            return '';
        }*/
    }
    private
    function _utf_unserialize($serial_str)
    {
        /*$serial_str = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'",
            $serial_str);*/
             $serial_str = preg_replace_callback('!s:(\d+):"(.*?)";!s', function($s){return "s:".strlen($s[2]).":\"".$s[2]."\";";},
            $serial_str);
        $serial_str = str_replace("\r", "", $serial_str);
        return @unserialize($serial_str);
    }
    private
    function _gbk_unserialize($serial_str)
    {
        /*$serial_str = preg_replace('!s:(\d+):"(.*?)";!se', '"s:".strlen("$2").":\"$2\";"',
            $serial_str);*/
            $serial_str = preg_replace_callback('!s:(\d+):"(.*?)";!s', function($s){return "s:".strlen($s[2]).":\"".$s[2]."\";";},
            $serial_str);
        $serial_str = str_replace("\r", "", $serial_str);
        return @unserialize($serial_str);
    }
    public
    function __construct($table=null,$key=null,$value=null,$timeout = null,$charset='utf-8')
    {
        $this->timeout = $timeout?$timeout:CACHE_DB_TIMEOUT;
		$this->charset = $charset;
        $this->table = $table?$table:CACHE_SQL_TABLE;
        $this->key = $key?$key:CACHE_SQL_KEY;
        $this->value = $value?$value:CACHE_SQL_VALUE;
        $this->dbobj = new daoClass();
        return $this;
    }
    public
    function set($name,$value,$timeout = null)
    {
        if (!$name)return false;
        $db    = $this->dbobj;
        $where = array($this->key=>$name);
        
        $time=$timeout!==null?$timeout:$this->timeout;
        //设置0未一直缓存
       
        if($time>0){
			 $timeout=time()+$time;
		}else{
			$timeout=0;
		}
       
        $data = array('time'   =>$_SERVER['REQUEST_TIME'],'timeout'=>$timeout,'data'   =>$value);
    
        $cacheData =(base64_encode(serialize($data)));
       
        $insert    = array($this->value=>$cacheData);
        $bool = $db->t($this->table)->w($where)->s(1);
   
        if ($bool) {
            $db->u($this->table,$insert,$where);
        }else {
            $insert=array_merge($where,$insert);
           ;
            $db->i($this->table,$insert);
        }
        return true;
    }
    public
    function get($name)
    {
    	$false=array(false,false);
        if (!$name)return $false;
        $cache_data = null;
        $db    = $this->dbobj;
        $where = array($this->key=>$name);
        $bool = $db->t($this->table)->w($where)->s(1);
        
        if ($bool && $bool[$this->value]!='') {
            $data       = $bool[$this->value];
        /*    d($data);
             d((base64_decode(gzuncompress($data))));
             d($this->_unSerialize(base64_decode(gzuncompress($data))));*/
            $cache_data = $this->_unSerialize(base64_decode(($data)));
         
          
            list($bool,$data)   = $this->_cehck($cache_data);
           /* d($bool);
            d($data);*/
            if(!$bool){
            
            	$this->del($name);
				 return ($false);
			}else{
				return array($bool,$data);
			}
        }
       
        return ($false);
    }
    public
    function del($name=null)
    {
        $db    = $this->dbobj;
        $where = array($this->key=>$name);
		$db->t($this->table)->d($where);
    }
    private
    function _cehck($value)
    {
    	$false=array(false,false);
    	
        if (is_array($value)) {
            if ($value['timeout'] != 0 && $value['timeout']  > time()) {
            	
                return array(true,$value['data']);
            }else
                if ($value['timeout'] == 0) {
                	
                    return array(true,$value['data']);
                }else {
                	
                  /*  return ($false);*/
                }
        }
        return ($false);
    }
}
?>
