<?php




checktop();
class payModel extends Y{
	private $db = 'pay';
	public function pay($fromuid,$toid,$cash,$oid,$iid = null){
		if(!$toid) return false;
		if($fromuid == $toid || $cash <= 0 ){
			return false;
		}
		$f = userinfo($fromuid);
		$t = userinfo($toid);
		if($f['exit'] || $f['flag'] || $t['exit'] || $t['flag'])
		$in = array();
		$payob = T('pay');
		$where = array('oid' =>$oid,'flag'=>array(0,1,2,3));
		$where2 = array('iid' =>$iid,'flag'=>array(0,1,2,3));
		$field = 'sum(cash)';
		$o     = T('out')->get_one(array('oid'=>$oid));
		$i = T('in')->get_one(array('iid'=>$iid));
		$cashs = $payob->set_where($where)->set_field($field,0)->get_count();
		$cashs = $o['cash'] - $cashs;
		if($cash > $cashs){
			return false;
		}
		if($i && $iid){
			$cashs = $payob->set_where($where2,null,1)->set_field($field,0)->get_count();
			$cashs = $i['cash'] - $cashs;
			if($cash > $cashs && $i['cash'] != $cashs){
				$cash = $cashs;
			}elseif($cash > $cashs && $i['cash'] == $cashs){
				$cash = floor($cashs / (Y::$conf['pre_queue_min']));
			}
		}
		if($cash <= 0){
			return false;
		}
		if(!$iid){
			$in['type'] = 1;
		}
		$in['addtime'] = time();
		$in['fromuid'] = $fromuid;
		$in['touid'] = $toid;
		$in['oid'] = $oid;
		$in['iid'] = $iid;
		$in['cash'] = $cash;
		return T($this->db)->add($in);
	}

	public function get_all($info){
		if(is_array($info) && $info['type'] && $info['id']){
			switch( $info['type']){

				case"out":
				$key = 'oid';
				break;
				case"in":
				$key = 'iid';
				break;
				default:return false;
			}

			$where = array($key=>$info['id']);
			$mod = T($this->db);
			$data= $mod->set_where($where)->get_all();

            

			return $data;
		}
		return false;
	}
	public function check($pid){
		if(!$pid)return false;
		$where = array('payid'=>$pid);
		$mod = T($this->db);
		$data= $mod->set_where($where)->get_one();
		$pd  = G_DAY * Y::$conf['pd_timeout'];
        
		if((($data['paytime'] + $pd) < time()) && $data['flag'] == 1 && $data['paytime']){
            
			$this->sure($pid);
            
		}
	}


	private function checkinfo($info){
		if(!$info)return false;
		if(  ($info['paytime']-$info['addtime'])<= parent::$conf['pay_time_aword']*3600         &&    ($_SERVER['REQUEST_TIME']-$info['paytime'])<= parent::$conf['sure_time_aword']*3600             ){
			$money=$info['cash']*parent::$conf['rate_aword'];
			
			$djtime=parent::$conf['dj_time_aword'];
			$payid=$info['payid'];
			M('mfl','am')->addone($info['fromuid'],$money,$djtime,$payid);
			M('mfl','am')->addone($info['touid'],$money,$djtime,$payid);
			
		}
		return false;
	}
	public function sure($pid){
		$w = array('payid'=>$pid);
		$mod = T($this->db);
		$mod->update(array('flag'=>2),$w);
		
		$info = T('pay')->get_one($w);
		$this->checkinfo($info);
		M('out','am')->check($info['oid']);
		if($info['iid']){
			M('in','am')->check($info['iid']);
		}
		return true;

	}
}
?>
