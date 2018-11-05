<?php



checktop();
class control extends adminbase{
	public function control_run(){

		$this->view(null,null);

	}
	 public function control_startyfk()
    {
      
        Y::loadTool('asyn');
        $url = geturl(null,'yfk','aysnqian','admin');
    /*    d($url,1);*/
        YAsyn::start($url,null);
        out('匹配完成');
        return  0;
    }
	
	
	public function control_order(){ 
		Y::loadTool('asyn');
		$array = get(array('int'=>array('payid')));
		$url = geturl(null,'asyndoorder','aysnqian');
		YAsyn::start($url,$array);
		out('匹配完成');
		return  0;
	}
	public function control_process(){
		Y::loadTool('asyn');
		$url = geturl(null,'process','aysnqian');

		YAsyn::start($url);

		out('开启成功');
		return  0;
	}
    
	public function control_closeprocess(){
		Y::$cache->set('looplockprocess',-1);
		out('退出成功，2分钟生效');
		return  0;
	}
   
	public function control_start(){
        
		Y::loadTool('asyn');
		$url = geturl(null,'asyndo','aysnqian');
        
		YAsyn::start($url,null);
     
		out('匹配完成');
		return  0;
	}



	public function control_startone(){
		Y::loadTool('asyn');
		$iid = get(array('int'=>array('iid'=>1)));
		$url = geturl($iid,'asyndo','aysnqian');
		YAsyn::start($url,$iid);
		out('匹配完成');
		return  0;
	}
    
	public function control_in(){
		$iid = get(array('int'=>array('iid'=>1)));
		$bool = M('in','am')->check($iid['iid']);
		if($bool){
			out('完成');
		}else{
			error('不满足完成条件');
		}
	}
	public function control_out(){
		$oid = get(array('int'=>array('oid'=>1)));
		$bool = M('out','am')->check($oid['oid']);
		if($bool){
			out('完成');
		}else{
			error('不满足完成条件');
		}
	}
}
?>
