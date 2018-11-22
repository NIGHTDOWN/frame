<?php



namespace ng169\control\pay;
use ng169\control\userbase;



checktop();

class cz extends userbase{
	public function control_run(){
		$data=T('user_rz')->get_one(array('uid'=>$this->get_userid(1)));
		if($_POST){
			$get=get(array('string'=>array('realname'=>1,'sfznum'=>1,'sfzsc'=>1,'sfzimgzm'=>1,'sfzimgfm'=>1)));
			if(!$data){
				$get['addtime']=time();
				$get['uid']=$this->get_userid(1);
				$get['ckflag']=1;
				T('user_rz')->add($get);
				out('提交完成',geturl('',null,'rz'));
			}else{
				if($data['ckflag']==3 ||$data['ckflag']==1){
					error('当前阶段不能编辑');
				}
				$get['ckflag']=1;
				T('user_rz')->update($get,array('uid'=>$this->get_userid(1)));
				out('重新更新完成');
				
			}
			
			
		}
		
		
		
		$this->view('prz',array('data'=>$data));
	}
	
}
?>
