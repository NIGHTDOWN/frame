<?php

namespace ng169\control\user;

use ng169\control\userbase;



checktop();
class set extends userbase{
	
	public
	function control_run(){
		$data     = T('user')->join_table(array('t'=>'user_attr','uid','uid'))->set_where(array('uid'=>$this->get_userid()),'=')->get_one();
		$this->view(null,array('user'=>$data));
	}
	public
	function control_user(){
	$f=YUrl::ismoible();
	$data     = T('user')->join_table(array('t'=>'user_attr','uid','uid'))->set_where(array('uid'=>$this->get_userid()),'=')->get_one();
	if($f){$this->view(null,array('user'=>$data));}
		
	}
	public
	function control_address(){
		$model     = T('user_address')->order_by(array('f'=>array('mflag','addtime'),'s'=>'down'))->set_where(array('uid'=>$this->get_userid()),'=');
		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$this->view(null,array('data'=>$data,'page'=>$page));
	}
	public
	function control_addaddress(){
		if(!$_POST && YUrl::ismoible()){
			$this->view();
				die();
			}


		$uid=$this->get_userid(1);
		$get=get(array('int'=>array('provinceid'=>1,'cityid','recvnum','mflag','areaid'),'string'=>array('realname'=>1,'recvphone','recvmobile'=>1,'address'=>1)),
		array('recvnum'=>'邮政编码','provinceid'=>'省份','cityid'=>'城市','areaid'=>'地区','realname'=>'收件人姓名','recvphone'=>'收件人电话','recvmobile'=>'收件人手机号码','address'=>'收件人详细地址'));
		if($get['mflag']){
			T('user_address')->update(array('mflag'=>0),array('uid'=>$uid));
		}
		$f=T('user_address')->add(array_merge($get,array('uid'=>$uid,'addtime'=>time())));
		if($f){
			out('地址添加成功',geturl(null,'address','set'));
		}
		error('地址添加失败');
		/*$data     = T('user_address')->join_table(array('t'=>'user','uid','uid'))->set_where(array('uid'=>$this->get_userid()),'=')->get_all();*/
		/*$this->view(null,array('user'=>$data));*/
	}
	public
	function control_save(){
		$insert=get(array('string'=>array('address','ww','qq','wx'),'int'=>array('provinceid','areaid','cityid','gender')),array());
		$headimg=get(array('string'=>array('headimg','nickname'=>1)),array('headimg'=>'头像','nickname'=>'昵称'));
		/*$data     = T('user')->join_table(array('t'=>'user_attr','uid','uid'))->set_where(array('uid'=>$this->get_userid()),'=')->get_one();*/
		$w=array('uid'=>$this->get_userid(1));
		if(T('user_attr')->get_one($w)){
			T('user_attr')->update($insert,$w);
		}else{
			T('user_attr')->add(array_merge($insert,$w));
		}
		/*if($headimg['headimg']!=parent::$wrap_user['headimg']){*/
		T('user')->update($headimg,$w);
		/*}*/
		/*$this->view(null,array('user'=>$data));*/
		out('保存成功');
	}
	public
	function control_cgpwd(){
		if(!$_POST && YUrl::ismoible()){
		$this->view();
			die();
		}
		$uid=$this->get_userid(1);
		$get=get(array('string'=>array('oldpass'=>'md5','newpass'=>'md5')));
		if(T('user')->get_one(array('password'=>$get['oldpass'],'uid'=>$uid))){
			$f=T('user')->update(array('password'=>$get['newpass']),array('uid'=>$uid));
		}
		if($f){
			out('密码修改成功');
		}else{
			error('密码修改失败');
		}
		
	}
	public
	function control_getmailcode(){
		$w=get(array('string'=>array('email'=>'email')));
		
		if($w['email']==''){
			error('邮箱不能留空');
		}
		if(T('user')->get_one($w)){
			error('邮箱已经使用');
		}
		$m      = M('tmpcode', 'am');
		$code   = $m->make($w['email']);
		$m = M('send', 'im');
		$s = $m->sendmail(array('from'=> Y::$conf['site_name'],'to'  => $w['email']),'mail_code', array('code'=>$code));
		out('发送成功');
	}
	public
	function control_getmobilecode(){
		$w=get(array('string'=>array('mobile'=>'ismobile')));
		if($w['mobile']==''){
			error('手机号码不能留空');
		}
		if(T('user')->get_one($w)){
			error('手机号码已经使用');
		}
		M('sms','im')->sendcode($w['mobile']);
		out('发送成功');
	}
	public
	function control_cgemail(){
		if(!$_POST && YUrl::ismoible()){
			$this->view();
				die();
			}
		$w=get(array('string'=>array('yzm'=>'1','email'=>'email')),array('yzm'=>'验证码','email'=>'邮箱'));
		M('send','im')->check($w['email'],$w['yzm']);
		$uid=$this->get_userid(1);
		T('user')->update(array('email'=>$w['email'],'emailrz'=>1),array('uid'=>$uid));
		out('更新成功');
		
	}
	public
	function control_cgmobile(){

		if(!$_POST && YUrl::ismoible()){
			$this->view();
				die();
			}
			$w=get(array('string'=>array('yzm'=>'1','mobile'=>'mobile')),array('yzm'=>'验证码','mobile'=>'手机号码'));
			M('sms','im')->check($w['mobile'],$w['yzm']);
			$uid=$this->get_userid(1);
		T('user')->update(array('mobile'=>$w['mobile'],'mobilerz'=>1),array('uid'=>$uid));
		out('更新成功');
	}
}
?>
