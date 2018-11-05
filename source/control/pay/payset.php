<?php






checktop();

class control extends userbase{
	public function control_pwd(){
if(!parent::$wrap_user['safepwd'])gourl(geturl(null,'pwd2','payset'));
if($_POST){
	
	$get=get(array('string'=>array('pass'=>'md5','oldpwd'=>'md5')));
	if($get['pass'] && $get['oldpwd']){
		if($get['oldpwd']!=parent::$wrap_user['safepwd']){
			error('原始支付密码不正确');
		}
		$up=array('safepwd'=>$get['pass']);
		$where=array('uid'=>$this->get_userid(1));
		T('user')->update($up,$where);
		out('支付密码设置成功',geturl(null,null,'index','pay'));
	}
	
}
		$this->view(null,$data);
	}
	public function control_pwd2(){
if(parent::$wrap_user['safepwd'])gourl(geturl(null,'pwd','payset'));
if($_POST){
	
	$get=get(array('string'=>array('pass'=>'md5')));
	if($get['pass']){
		$up=array('safepwd'=>$get['pass']);
		$where=array('uid'=>$this->get_userid(1));
		T('user')->update($up,$where);
		out('支付密码设置成功',geturl(null,null,'index','pay'));
	}
	
}
		$this->view(null,$data);
	}
}
?>
