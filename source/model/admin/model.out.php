<?php




checktop();
class outModel extends Y
{
    private $db_name = 'out';
    public function add($uid,$cash,$lid,$cardid,$day=0)
    {
        $mod = T($this->db_name) ;
        $in  = array('cash'   =>$cash,'addtime'=>time(),'uid'    =>$uid,'status' =>0,'lid'    =>$lid,'cardid'=>$cardid,'lineday'=>$day,'linetime'=>(time()+($day*G_DAY)));
        $cash = ($cash >= parent::$conf['pre_high'])?parent::$conf['pre_high']:$cash;
   /*     T('user')->update(array('lastoutmoney'=>$cash),array('uid'=>$uid));*/
        return  $mod->add($in);
    }
    public function info($oid)
    {
        $mod = T($this->db_name)->join_table(array('t'=>'pay','oid','oid'),1)->join_table(array('t'=>'in','in.iid','iid'),1)->join_table(array('t'=>'user','in.uid','uid'),1);
        $data = $mod->get_all($oid,null,null);
        return $data;
    }
    
    private function rate($oid,$lid){
		$data=T('pay')->order_by(array('f'=>'paytime','s'=>'down'))->get_one(array('oid'=>$oid,'flag'=>2));
		if(!$data)return false;
		$time=$data['paytime']-$data['addtime'];
		$mfl=T('wallet')->get_one(array('fromlid'=>$lid,'type'=>0));
	
		if(!$mfl)return false;
	
		
		if($time<=3*3600){
			$rate=Y::$conf['rate_3']+1;
			$endmoney=$mfl['startmoney']*$rate;
		}elseif($time>3*3600&&$time<=24*3600){
			$rate=Y::$conf['rate_3_24']+1;
				$endmoney=$mfl['startmoney']*$rate;
		}
		elseif($time>24*3600&&$time<=48*3600){
			$rate=Y::$conf['rate_24_48']+1;
			$endmoney=$mfl['startmoney']*$rate;
		}
		return  T('wallet')->update(array('endmoney'=>$endmoney),array('fromlid'=>$lid,'type'=>0));
		
		
	}
	 
    private function uptime($oid,$lid){
		$mfl=T('wallet')->get_one(array('fromlid'=>$lid,'type'=>0));
		if(!$mfl)return false;
		
	 	$time=$_SERVER['REQUEST_TIME']-$mfl['addtime'];
		return  T('wallet')->update(array('addtime'=>"addtime+{$time}",'endtime'=>"endtime+{$time}"),array('fromlid'=>$lid,'type'=>1),0);
	}
    public function complete($oid)
    {
        $m = T($this->db_name);
        $w = array('oid'=>$oid);
        $b = $m->get_one($w);
        if ($b['status'] == 1 || $b['status'] == 2) {
            return false;
        }
        $m->update(array('status'=>1),$w);
        $inf=T('out')->get_one(array('oid'=>$oid));
    	if(!$inf)return false;
    	$lid=$inf['lid'];
    
    	
    	
    	$rateday=($inf['alloctime']-$inf['addtime'])/86400;
    	
        $rateday=$rateday>30?30:floor($rateday);
        $rate=$rateday*Y::$conf['day_rate']*$inf['cash'];
        $endmoney=$rate+$inf['cash'];
  		T('wallet')->update(array('status'=>1,'paytime'=>$_SERVER['REQUEST_TIME']),array('fromlid'=>$lid));
  		T('wallet')->update(array('endtime'=>($_SERVER['REQUEST_TIME']+(Y::$conf['out_dj_time']*3600))),array('fromlid'=>$lid,'type'=>0));
  		$this->uptime($oid,$lid);
  		
  		
  		M('levelup','am')->checkup($inf['uid']);
      
       
       
       
    }
   
    public function check($id)
    {
        $w = array('oid'=>$id);
        $iinfo = T($this->db_name)->get_one($w);
        $w['flag'] = 2;
        $payob = T('pay');
        $field = 'sum(cash)';
        $cash  = $payob->set_where($w)->set_field($field,0)->get_count(null,0);
        if ($cash == $iinfo['cash'] && $iinfo['status'] != 1 && $iinfo['status'] != 2) {
            $this->complete($id);
        }
        return true;

    }

}
?>
