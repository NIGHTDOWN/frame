<?php




checktop();
class taskModel extends Y{

	private $db_name='tasklist';

	public function check($id){
		if(!$id)return false;
		$where=array('id'=>$id);
		$info=T($this->db_name)->get_one($where);
		if(!$info)return false;
		if($info['status']!=1)return false;
		/*$today=strtotime('today');
		$timearray=array($today,$today+86400);
		if($info['endtime']>$timearray[1]){
			$this->fail($id);
			return false;
			
		}
		if(($info['endtime']-$info['starttime'])<86400){
			$this->fail($id);
			
			return false;
		}*/
		$this->scuss($id);
		return TRUE;
	}
	private function scuss($id){
		
		if(!$id)return false;
		$where=array('id'=>$id);
		$info=T($this->db_name)->join_table(array('t'=>'task','taskid','taskid'))->get_one($where);
		if(!$info)return false;
		$f=T($this->db_name)->update(array('status'=>2,'checktime'=>time()),$where);
		/*$where=array('uid'=>$info['uid'],'alloc'=>0);
		T('out')->update(array('tasknum'=>'tasknum+1'),$where,0);*/
		/* $in=array('ccash'=>"hcash{+}".$info['num']);
		T('user')->update($in,array());*/
		M('mlog','am')->add($info['uid'],$info['num'],"任务{$id}奖励排单币".$info['num']);
		return 1;
 	
 	
 	
	}
	private function fail($id){
		if(!$id)return false;
		$where=array('id'=>$id);
		$info=T($this->db_name)->get_one($where);
		if(!$info)return false;
		if($info['status']!=1)return false;
		$f=T($this->db_name)->update(array('status'=>4,'checktime'=>time()),$where);
		return $f;
	}
   

}
?>
