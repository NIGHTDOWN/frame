<?php



checktop();
class sjbModel extends Y{
	public function getkfid(){
		$list=T('admins')->join_table(array('t'=>'admins_roles','roleids','roleid'))->set_filed('adminid')->set_where(array('rolename'=>'客服'))->get_all();
		$num=sizeof($list);
		$num-=1;
		if($list>0){
			$num=mt_rand(0,$num);
			
			return $list[$num]['adminid'];
		}
		/*return $list;*/
		
		return 0;
	}
}
?>
