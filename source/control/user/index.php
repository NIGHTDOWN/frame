<?php

namespace ng169\control\user;

use ng169\control\userbase;

namespace ng169\control\user;
use ng169\control\userbase;
use ng169\Y;
checktop();
class index extends userbase{

	public
	function control_run(){
		$c         = D_MEDTHOD;    $a         = D_FUNC;
		$data=T('product_log')->set_field(('count(theday) as num,logid,stime,uid,theday'))->group_by('theday')->set_limit(4)->order_by(array('f'=>'stime','s'=>'down'))->get_all(array('uid'=>$this->get_userid(1)));
		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);		
	}

}
?>
