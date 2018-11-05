<?php




checktop();
class jfModel extends Y{
    
	
	public function add($uid,$cash,$mark){
		$w=array('uid'=>$uid);
		if($cash<0){
			$fh='-';
			$type=0;
		}else{
			$fh='+';
			$type=1;
		}
		$in=array('points'=>"points{$fh}".abs($cash));
		$this->log($uid,$cash,$mark);
		T('user')->update($in,$w,0);
	}
	public function log($uid,$cash,$mark){
		$u=userinfo($uid);
		$in=array('uid'=>$uid,'money'=>$cash,'addtime'=>time(),'desc'=>$mark);
		T('jf_log')->add($in);
	} 

}
?>
