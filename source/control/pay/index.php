<?php




namespace ng169\control\pay;
use ng169\control\userbase;


checktop();

class index extends userbase{
	public function control_run(){
		$where=array('uid'=>$this->get_userid(1));
	$loginlog=T('loginlog')->group_by('ip')->order_by(array('s'=>'down','f'=>'addtime'))->set_limit(3)->get_all($where);
	$where['delflag']=0;
	$order=T('order')->set_limit(10)->order_by(array('s'=>'down','f'=>'orderid'))->get_all($where);
	$data=array('log'=>$loginlog,'data'=>$order);

		$this->view('pindex',$data);
	}
	
}
?>
