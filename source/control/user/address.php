<?php


namespace ng169\control\user;

use ng169\control\userbase;


checktop();
class address extends userbase{

	public
	function control_edit(){
		$get=get(array('int'=>array('addid'=>1)));
		$get['uid']=$this->get_userid(1);
		$address=T('user_address')->get_one($get);
		if(!$address)error('ID错误');
		$var_array['data']=$address;
		if($_POST){
			$get2=get(array('int'=>array('provinceid'=>1,'cityid','recvnum','mflag','areaid'),'string'=>array('realname'=>1,'recvphone','recvmobile'=>1,'address'=>1)),array('recvnum'=>'邮政编码','provinceid'=>'省份','cityid'=>'城市','areaid'=>'地区','realname'=>'收件人姓名','recvphone'=>'收件人电话','recvmobile'=>'收件人手机号码','address'=>'收件人详细地址'));
		if($get2['mflag']){
			T('user_address')->update(array('mflag'=>0),array('uid'=>$get['uid'],'mflag'=>1));
		}
		$f=T('user_address')->update(($get2),$get);
		if($f)out('地址更新成功',geturl(null,'address','set'));
		error('地址更新失败');
		}
		$this->view(null, $var_array);
	}
public
	function control_run(){
		
		$this->view(null, $var_array);
	}
	public
	function control_del(){
		
		$w = array('addid'=> 1);
        
		$where = G(array('array'=> $w))->get();
       
		
		$model = T('user_address')->del($where);
		
		out('删除成功',geturl(null,'address','set'),$model);
	}
}
?>
