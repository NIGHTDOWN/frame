<?php





checktop();

class sendinfoModel extends Y
{
	/**
	* 
	* @param undefined $tempid 模板id
	* @param undefined $uid    用户ID
	* 
	* @return
	*/
	private $user=null;
public function send($tempid,$uid){
	if(!$uid || !$tempid )return false;
	$user=T('user')->get_one(array('uid'=>$uid));
	if(!$user)return false;
	$this->$user=$user;
	
}

// 获取模板信息；
//发送站内通知；
//发送短信通知
//发送邮件通知；

	

}

?>
