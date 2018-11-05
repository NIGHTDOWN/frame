<?php




checktop();
class inModel extends Y{
	private $db_name='in';
	private $info;
	public function add($uid,$cash,$lid,$cardid,$type){
		$mod=T($this->db_name) ;
		$in=array('cash'=>$cash,'addtime'=>time(),'uid'=>$uid,'status'=>0,'lid'=>$lid,'cardid'=>$cardid);
		$flag=$mod->add($in); 
        
		$money=rmb($cash);
       
		switch( $type){
			case 0:$qb='ncash';
			$flag=M('nlog','am')->add($uid,-$cash,"得数额：RMB{$money}, 钱包：本息钱包");
			;break;
			case 1:$qb='ncash';
			$flag=M('nlog','am')->add($uid,-$cash,"得数额：RMB{$money}, 钱包：本息钱包");
			;break;
			case 2:$qb='mcash';
		
			$flag=M('log1','am')->add($uid,-$cash,"得数额：RMB{$money}, 钱包：推荐钱包");
			
			;break;
			case 3:$qb='hcash';
			$flag=M('log2','am')->add($uid,-$cash,"得数额：RMB{$money}, 钱包：领导钱包");
			;break;
		}
        
        
        
        
		return $flag;
	}
	public function info($oid){
		$mod=T($this->db_name)->join_table(array('t'=>'pay','iid','iid'),1)->join_table(array('t'=>'out','out.oid','oid'),1)->join_table(array('t'=>'user','out.uid','uid'),1);
		$data=  $mod->get_all($oid,null,null); 
		return $data;
	}
	public function complete($id){
		$w=array('iid'=>$id); 
		$iinfo=T($this->db_name)->get_one($w);
		T($this->db_name)->update(array('status'=>1),$w);
        
        
		return  true;
       
	}
	public function check($id){
		$w=array('iid'=>$id);
		$iinfo=T($this->db_name)->get_one($w);
		$w['flag']=2;
		$payob=T('pay');
		$field='sum(cash)';
		$cash=$payob->set_where($w)->set_field($field,0)->get_count();
		if($cash==$iinfo['cash'] &&$iinfo['status']!=1 &&$iinfo['status']!=2){
        	
			$this->complete($id);
		}
		return true;
 
	}
    
    
}
?>
