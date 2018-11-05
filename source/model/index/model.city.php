<?php





checktop();
class cityModel extends Y
{
	
	
	public function getinfo($ip=null){
		$ip=$ip?$ip:YRequest::getip();
		
		
		$info=$this->getcity();
		
		if($info){
			return $info;
		}else{
			
			$info=M('ip','am')->getip($ip);
			$this->savecity($info);
			return $info;
		}
		//先取cookie
		//无cooki就取数据记录在保存进cookie
		//数据库无记录取远程数据
	}
	

	public function getcity()
	{

		Y::loadTool('cookie');
		$area = YCookie::get('city');
		$Xcode =Y::import('code', 'tool');
		$area = $Xcode->authCode($area, 'DECODE');
        $area = unserialize($area);
		return $area;
	}
	public function savecity($city)
	{
		
		
		
		$Xcode =Y::import('code', 'tool');
        $city = serialize($city);
		$city = $Xcode->authCode($city, 'ENCODE');
		Y::loadTool('cookie');
        $domain=Y::import('domain','tool');
        $arr = $domain->getDomain();
        YCookie::set('city', $city,null,null,null,$arr);
	}


  


}

?>
