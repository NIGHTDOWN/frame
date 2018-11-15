<?php


namespace ng169\model\index;
use ng169\Y;


checktop();

class ad extends Y
{
 public function log($adid){
 	$info=T('ad')->get_one(array('adid'=>$adid));
 	if(!$info)return false;
 	T('ad')->update(array('hits'=>$info['hits']+1));
 	$insert=array('adid'=>$adid,'ip'=>YRequest::getip(),'addtime'=>time(),'provinceid'=>parent::$wrap_city['provinceid'],'cityid'=>parent::$wrap_city['cityid']);
 	 T('ad_log')->add($insert);
 	 return $info;
 }
}

?>
