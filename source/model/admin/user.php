<?php

namespace ng169\model\admin;
use ng169\Y;



checktop();
class user extends Y {
    
    private $db='user';
    public function id($uid) {
        $mod=T($this->db);
        $where=array('uid'=>$uid);
        $data=$mod->get_one($where);
        return $data;
    }
    public function name($username) {
        if(!$username){
            error('用户名不能为空');
        }
        $mod=T($this->db);
        $where=array('username'=>$username);
       
        $data=$mod->set_where($where,'=')->get_one();
        return $data;
    }
	public function getuid($username){
		$mod=T($this->db);
        $where=array('username'=>$username);
        $data=$mod->set_field(array('uid','depth'))->set_where($where,'=')->get_one();
        return $data;
	}
	
	public function grouplow($uid,$num){
		$info=$this->id($uid);
		if($info && $num<=$info['ztrs']){
			T('user')->update(array('ztrs'=>$info['ztrs']-$num),array('uid'=>$uid));
		}
		return 0;
	}
	public function countmessage(){
		$num=T('message')->set_where(array('flag'=>0,'toid'=>Y::$wrap_user['uid']))->get_count();
		return $num;
	}
}
?>
