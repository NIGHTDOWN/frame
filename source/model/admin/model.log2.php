<?php




checktop();
class log2Model extends Y{
    
	
	public function add($uid,$cash,$mark){
		$w=array('uid'=>$uid);
		if($cash<0){
			$fh='-';
			$type=0;
		}else{
			$fh='+';
			$type=1;
		}
		$in=array('cash2'=>"cash2{$fh}".abs($cash));
		$this->log($uid,$cash,$mark);
		T('user')->update($in,$w,0);
	}
	public function log($uid,$cash,$mark){
		$u=userinfo($uid);
		$in=array('uid'=>$uid,'cash'=>$cash,'addtime'=>time(),'mark'=>$mark);
		T('2log')->add($in);
	} 

}
?>
