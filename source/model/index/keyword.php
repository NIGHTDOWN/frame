<?php



namespace ng169\model\index;
use ng169\Y;
use ng169\tool\Request as YRequest;
checktop();

class keyword extends Y
{
 public function search($word){	
 	if(!$word)return false;
 	$info=T('keyword')->get_one(array('word'=>$word));
 	if($info){
		if($this->log($info['sid'])){
			T('keyword')->update(array('hits'=>$info['hits']+1),array('sid'=>$info['sid']));
		}
	}else{
		$insert['word']=$word;
		$insert['addtime']=time();
		$insert['flag']=0;
		$insert['hits']=1;
		$sid=T('keyword')->add($insert);
		$this->log($sid);
	}	
	return $this->wordofcate($word);
 }
 private function log($sid){
 	$insert['stime']=date('ymdH');
 	$insert['ip']=YRequest::getip();
 	$insert['sid']=$sid;
 	$isexist=T('keyword_log')->get_one($insert);
 	if($isexist)return false;
 	return T('keyword_log')->add($insert);
 }
 private function wordofcate($word){
 	if(!$word)return false;
 	$info=T('product_category')->set_where(array('catname'=>$word,'metakeyword'=>$word),null,null,'or')->get_all();
 	return $info;	
 }
}

?>
