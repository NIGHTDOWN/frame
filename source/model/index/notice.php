<?php



namespace ng169\model\index;
use ng169\Y;

checktop();

class notice  extends Y
{


 public function getlist(){
 	$info=T('article')->join_table(array('t'=>'article_category','catid','catid'))->set_limit(5)->order_by(array('s'=>'down','f'=>array('orders','addtime')))->get_all(array('alias'=>'notice','flag'=>0,'elite'=>1));
 /*	if(!$info)return false;*/
 	/*$insert=array('adid'=>$adid,'ip'=>YRequest::getip(),'addtime'=>time(),'provinceid'=>parent::$wrap_city['provinceid'],'cityid'=>parent::$wrap_city['cityid']);*/
 	return $info;
 }
}

?>
