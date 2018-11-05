<?php






checktop();

class control extends indexbase{

	private $mod = null;

	public function control_run(){
		if($_POST){
			$w=get(array('string'=>array('yzm'=>'1','code'=>1)));
			$user=get(array('string'=>array('username','mobile'=>'ismobile','password'=>'md5')));
			check_verifycode(intval($w['yzm']),1);
			M('sms','im')->check($user['mobile'],$w['code']);
			// if(T('user')->get_one(array('username'=>$user['username']))){
			// 	error('用户名已经存在');
			// }
			if(T('user')->get_one(array('mobile'=>$user['mobile']))){
				error('用户号码已经被注册');
			}
			$user['regtime']=time();
			$user['username']=$user['mobile'];
			$user['regip']=YRequest::getip();
			$user['mobilerz']=1;
			$uid=T('user')->add($user);
			if($uid){
				out('注册成功',geturl(null,null,'login'));
			}else{
				error('注册失败');
			}
		}
		$this->vlog($this->get_userid());
		$this->view();
	}
	public function control_send(){
		$w=get(array('int'=>array('mobile'=>'ismobile')));
		if($w['mobile']==''){
			error('手机号码不能留空');
		}
		$isin=T('user')->get_one($w);
		if($isin){error('手机号码已被注册');}
		
		M('sms','im')->sendcode($w['mobile']);
		
	}

}

?>
