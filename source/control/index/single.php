<?php






checktop();

class control extends indexbase{
	public function control_show(){
		$w=get(array('int'=>array('abid'=>1)));
		$this->vlog($this->get_userid());
		$info=T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->get_one($w);
		if(!$info)error('数据不存在');
		$other=T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->get_all(array('catid'=>$info['catid'],'flag'=>0));
		$this->view(null,array('data'=>$info,'other'=>$other));
	}
    
    
}
?>
