<?php




checktop();
class mflModel extends Y{
	private $oinfo='';
	private $creattime='';
	private $startdepth=2;
	private $lastuser=null;
	public function sell(){
		
	}
	public function ratenow($id){
		
	}
	
	public function getafterpayrate($uid){
		$info=T('user')->get_one(array('uid'=>$uid));
		if(!$info)return false;
		$level=$info['level']+1;
		$arate="pt_l{$level}_apay_rate";
		$rate=(Y::$conf[$arate]*100).'%';
	
		return $rate;
	}
	public function uptherate($id){
		$info=T('wallet')->join_table(array('t'=>'user','uid','uid'))->get_one(array('id'=>$id,'type'=>0));
		
		if(!$info){
			return false;
		}
		$cs=Y::$conf['cj_rate']*G_DAY;
		$level=$info['level']+1;
		$brate="pt_l{$level}_apay_rate";
		$arate="pt_l{$level}_bpay_rate";
		if($info['status']){
			$rate=Y::$conf[$arate];
			$ratetime=$info['paytime']-$info['addtime'];
			$ratetime=$ratetime>$cs?$cs:$ratetime;
			$timesy=$cs-$ratetime;
			$ratetime=intval($ratetime/G_DAY);
			$rate=$rate*$ratetime;
			$money=$info['startmoney']*$rate;
		
			
			$rate=Y::$conf[$brate];
			$ratetime=$_SERVER['REQUEST_TIME']-$info['paytime'];
			$ratetime=$ratetime>$timesy?$timesy:$ratetime;
			$ratetime=intval($ratetime/G_DAY);
			$rate=$rate*$ratetime;
			$money1=$info['startmoney']*$rate;
			
			$money+=$money1;
		}else{
			$ratetime=$_SERVER['REQUEST_TIME']-$info['addtime'];
			$ratetime=$ratetime>$cs?$cs:$ratetime;
			
			$ratetime=intval($ratetime/G_DAY);
			$rate=Y::$conf[$arate];
			$rate=$rate*$ratetime;
			$money=$info['startmoney']*$rate;
		}
		return $money+$info['startmoney'];
	
	}
	public function  end($uid){
		if(!$uid)return false;
		/*$this->end_money($uid);*/
		/*$this->end_zt($uid);
		$this->end_jl($uid);*/
		$this->end_glj($uid);
		$this->autohide($uid);
		return true;
	}
	public function uprate($lid,$money){
		return false;
		if(!$lid)return false;
		$where=array('status'=>array(0,1),'fromlid'=>$lid,'type'=>0);
		$insert=array('endmoney'=>$money);
		T('wallet')->update($insert,$where);
	}
	
	public function end_money($uid,$id=null){
		
		$data=T('wallet')->get_all(array('id'=>$id,'status'=>1,'uid'=>$uid,'type'=>0,'endtime'=>array(0,$_SERVER['REQUEST_TIME'])));
		foreach($data as $val){
			if(!$val['id'] )return false;
			$money=$this->uptherate($val['id']);
			M('nlog','am')->add($uid,$money,$val['fromlid'].'结算本息');
			T('wallet')->update(array('status'=>2,'hide'=>1,'hadetime'=>$_SERVER['REQUEST_TIME']),array('id'=>$val['id']));
		}
		return true;
	}
	
	public function end_zt($uid,$id=null){
		$data=T('wallet')->get_all(array('id'=>$id,'status'=>1,'uid'=>$uid,'type'=>array(1,10),'inbox'=>0,'endtime'=>array(0,$_SERVER['REQUEST_TIME'])));
		$max=T('user')->get_one(array('uid'=>$uid));
		$level=$max['level'];
		$max=$max['lastoutmoney'];
		foreach($data as $val){
			if(!$val['id'] )return false;
			$money=$val['endmoney'];
			M('log1','am')->add($uid,$money,$val['fromlid'].'直推奖励');
			T('wallet')->update(array('status'=>2,'hide'=>1,'hadetime'=>$_SERVER['REQUEST_TIME']),array('id'=>$val['id']));
		}
	}
	
	private function end_glj($uid){
		$data=T('wallet')->get_all(array('status'=>1,'uid'=>$uid,'type'=>1,'inbox'=>1,'endtime'=>array(0,$_SERVER['REQUEST_TIME'])));
		foreach($data as $val){
			if(!$val['id'] )return false;
			M('log2','am')->add($uid,$val['endmoney'],$val['fromlid'].'领导奖励');
			T('wallet')->update(array('status'=>2),array('id'=>$val['id']));
		}
	}
	private function autohide($uid){
		return $data=T('wallet')->update(array('hide'=>1,'hadetime'=>$_SERVER['REQUEST_TIME']),array('status'=>2,'uid'=>$uid,'type'=>1,'inbox'=>1,'endtime'=>array(0,$_SERVER['REQUEST_TIME']-(3*G_DAY))));
	}
	
	public function start($oid){
		$where=array('waiting'=>0,'oid'=>$oid);
		$info=T('out')->get_one($where);
		if($info){
			$this->oinfo=$info;
			$this->creattime=$info['starttime']?$info['starttime']:$_SERVER['REQUEST_TIME'];
			$up=array('waiting'=>1,'starttime'=>$this->creattime);
			$flag=T('out')->update($up,$where);
			if($flag){
				$this->add($oid);
			}
		}else{
			return  false;
		}
		return true;
	}	
	public  function addone($uid,$money,$djtime,$payid){
		$etime=$_SERVER['REQUEST_TIME']+(G_DAY*$djtime);
		if(!$money)return false;
		$insert=array('type'=>2,'addtime'=>$_SERVER['REQUEST_TIME'],'endtime'=>$etime,'startmoney'=>$money,'fromlid'=>$payid,
			'desc'=>'诚信奖励','status'=>1,'hide'=>0,'inbox'=>0,'autohide'=>0,'uid'=>$uid,'endmoney'=>$money);
		T('wallet')->add($insert);
		return true;
	}
	
	public  function addjh($uid,$money){
		/*$etime=$_SERVER['REQUEST_TIME']+(G_DAY*$djtime);*/
		if(!$money)return false;
		$insert=array('type'=>2,'addtime'=>$_SERVER['REQUEST_TIME'],'endtime'=>$_SERVER['REQUEST_TIME'],'startmoney'=>$money,'fromlid'=>$uid,
			'desc'=>'平台第一波收款人奖励','status'=>1,'hide'=>0,'inbox'=>0,'autohide'=>0,'uid'=>$uid,'endmoney'=>$money);
		T('wallet')->add($insert);
		return true;
	}
	
	public  function addfirst($uid){
		/*$etime=$_SERVER['REQUEST_TIME']+(G_DAY*$djtime);*/
		$num=T('out')->get_count(array('uid'=>$uid));
		if($num!=1)return false;
		$info=T('out')->get_one(array('uid'=>$uid));
		if($info['cash']<Y::$conf['first_out_cash'])return false;
		if(!Y::$conf['first_out_cash'])return false;
		$insert=array('type'=>2,'addtime'=>$_SERVER['REQUEST_TIME'],'endtime'=>$_SERVER['REQUEST_TIME'],'startmoney'=>Y::$conf['first_out_aword'],'fromlid'=>$info['lid'],
			'desc'=>'激活码返款','status'=>0,'hide'=>0,'inbox'=>0,'autohide'=>0,'uid'=>$uid,'endmoney'=>Y::$conf['first_out_aword']);
		T('wallet')->add($insert);
		return true;
	}

	private function add(){
		$etime=$this->creattime+(G_DAY*Y::$conf['p_time']);
		/*$ratemoney=($this->oinfo['cash'])*(Y::$conf['out_rate']+1);*/
		$ratemoney=$this->oinfo['cash'];
	
		$insert=array('type'=>0,'addtime'=>$this->creattime,'endtime'=>$etime,'startmoney'=>$this->oinfo['cash'],'fromlid'=>$this->oinfo['lid'],
			'desc'=>'提供帮助资金','status'=>0,'hide'=>0,'inbox'=>0,'autohide'=>0,'uid'=>$this->oinfo['uid'],'endmoney'=>$ratemoney);
		T('wallet')->add($insert);
		$this->addfirst($this->oinfo['uid']);
		$this->lastuser=T('user')->get_one(array('uid'=>$this->oinfo['uid']));
		$this->zt();
		$this->tree_up();
		return true;
	}
	private function getuser($uid){
		if(!$uid)return FALSE;
		return T('user')->get_one(array('uid'=>$uid));
	}
	private function rate($depth){
		$rate=explode(',',Y::$conf['user_level_aword']);
		if(isset($rate[$depth]))return $rate[$depth];
		return $rate[sizeof($rate)-1];
	}
	private function rate2($depth){
		$rate=explode(',',Y::$conf['super_user_level_aword']);
		if(isset($rate[$depth]))return $rate[$depth];
		return $rate[sizeof($rate)-1];
	}
	private function dj(){
		$dj=explode(',',Y::$conf['user_level_dj']);
		return $dj;
	}
	private function zt(){
	}
	
	private   function tree_up(){
		$tree=T('user_tree')->get_one(array('uid'=>$this->oinfo['uid']));
		if(!$tree)return false;
		$tree=explode(G_BREAK,$tree['treeid']);
		$size=sizeof($tree);
		if($size>2 && is_array($tree)){
			unset($tree[$size-1]);
			$tree=array_reverse($tree,FALSE);
			foreach($tree as $k=>$p){
				$parent=$this->getuser($p);
				if($parent['level']<$this->lastuser['level']){
					return  0;
				}
				$this->lastuser=$parent;
				$depth=$k;
				if($k>=20)return 0;
				$this->aword($depth,$p);
			}
			return true;	
		}else{
			return false;
		}
	}
	public function aword($depth,$uid){
		$parent=$this->getuser($uid);
	
		if(!$parent)return false;
		$plevel=$parent['level']+1;
		$name="pt_l{$plevel}_jl";
		$ztbl=explode(',',Y::$conf[$name]);
		//直推奖励
		if($ztbl[$depth] && $depth<7){
			$m=$this->oinfo['cash']*$ztbl[$depth];
			$insert=array('type'=>1,'addtime'=>$this->creattime,'endtime'=>$this->creattime,'startmoney'=>$m,'fromlid'=>$this->oinfo['lid'],
				'desc'=>($depth+1).'代直推奖励','status'=>0,'hide'=>0,'inbox'=>0,'autohide'=>0,'uid'=>$parent['uid'],'endmoney'=>$m);
			T('wallet')->add($insert);	
		}
		
		$name="pt_l{$plevel}_jljl";
		$jlbl=Y::$conf[$name];
		//经理奖励
		if($jlbl){
			$m=$this->oinfo['cash']*$jlbl;
			if(!$m)return false;
			$insert=array('type'=>1,'addtime'=>$this->creattime,'endtime'=>$this->creattime,'startmoney'=>$m,'fromlid'=>$this->oinfo['lid'],
				'desc'=>($depth+1).'代经理奖金','status'=>0,'hide'=>0,'inbox'=>1,'autohide'=>1,'uid'=>$parent['uid'],'endmoney'=>$m);
			T('wallet')->add($insert);	
		}
	
		/*$endtime=$this->dj();
		$endtime=$endtime[1];
		$endtime=$endtime*G_DAY+$this->creattime;*/
		/*$m=$this->oinfo['cash']*$rate;
		$insert=array('type'=>1,'addtime'=>$this->creattime,'endtime'=>$endtime,'startmoney'=>$m,'fromlid'=>$this->oinfo['lid'],
		'desc'=>($depth+1).'代领导奖金','status'=>0,'hide'=>0,'inbox'=>1,'autohide'=>1,'uid'=>$parent['uid'],'endmoney'=>$m);
		T('wallet')->add($insert);*/
	}
}
?>
