<?php


namespace ng169\control\user;

use ng169\control\userbase;


checktop();
class shop extends userbase{

	public
	function control_run(){
		
		if(parent::$wrap_user['muid'] && (parent::$wrap_user['rzflag']==0 )){
		gourl(geturl(null,'step3'));	
		}
		if(parent::$wrap_user['rzflag']==1 ||parent::$wrap_user['rzflag']==2 ){
		gourl(geturl(null,null,'shop','shop'));	
		}
		$this->view(null, $var_array);
	}
public
	function control_step2(){
		$shop=T('merchant')->get_one(array('uid'=>$this->get_userid()));
		if($shop)YOut::page404();
		$get=get(array('int'=>array('type'=>1)));
		$this->view(null, $get);
	}
	public
	function control_step3(){
		if(!$_POST){
			if(parent::$wrap_user['rzflag']==2 || parent::$wrap_user['rzflag']==2){
				gourl(geturl(null,null,'shop','shop'));
			}
			
			$info=T('merchant_rz')->get_one(array('muid'=>parent::$wrap_user['muid']));
			$this->view(null, array('data'=>$info));
			die();
		}
		
		$get=get(array('int'=>array('catid'=>1,'provinceid','cityid','areaid'),'string'=>array('merchantname'=>1,'licence','address'=>1,'phone','intro')));
		$get2=get(array('string'=>array('sfzzmimg'=>1,'sfzfmimg'=>1,'yyzjimg','sfzscimg'=>1)));
		$type=get(array('int'=>array('type'=>1)));
		$is=T('merchant')->get_one(array('rzflag'=>array(1,2),'merchantname'=>$get['merchantname']));
		
		if($is){
			error('店铺名称已经注册');
		}
		$get['createtime']=time();
		$get['regip']=YRequest::getip();
		$get['uid']=$this->get_userid(1);
		$is=T('merchant')->get_one(array('uid'=>$this->get_userid(1)));
		if(!$is){
			$id=T('merchant')->add($get);
		}else{
			$get['rzflag']=0;
			$id=T('merchant')->update($get,array('uid'=>$this->get_userid(1)));
		}
		if(!$id){
			error('店铺创建失败');
		}
		$get2['muid']=$id;
		$get2['rztype']=$type['type'];
		$f=T('merchant_rz')->add($get2);
		if($f){
		/*	out('店铺创建成功，等待审核。。');*/
		gourl(geturl());
		}else{
			error('店铺创建失败');
		}
	}
}
?>
