<?php






checktop();

class control extends indexbase{
	public function control_ad(){
		$id=get(array('int'=>array('urlid'=>1,'adid'=>1)));
		$info=M('ad','im')->log($id['adid']);
		if(!$info)YOut::page404();
		if(!$id['urlid'])YOut::page404();
		$info=T('url_encode')->get_one(array('urlid'=>$id['urlid']));
		if(!$info)YOut::page404();
		//广告点击统计
		
		if (!preg_match('/(http:\/\/)|(https:\/\/)/i', $info['url'])) {
			// $source = preg_replace('/(http:\/\/)|(https:\/\/)/i', '', $source);
			// 去掉 h t t p: //和 h t t ps: //前缀
			$info['url']='http://'.$info['url'];
			}
		gourl($info['url']);
	}
    
    
}
?>
