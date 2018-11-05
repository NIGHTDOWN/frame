<?php


checktop();
class control extends adminbase{
   
	public
	function control_run(){
		//输出当前月份
		//输出每日统计
		//数据包括；每日新增的排单；产生的利息；产生的领导奖励；；
		$data=get(array('int'=>array('mouth','year')));
		if(is_array($data) && sizeof($data)==0){
			$data['year']=date('Y');
			$data['mouth']=date('m');
		}
		$time=strtotime($data['year'].'-'.$data['mouth'].'-01');
		
		$data['t']=date('t',$time);
		$data['L']=date('L',$time);
		$year=($data['L'])?366:365;
		$timearray=array($time,$time+($data['t']*G_DAY));
		$sum['out']=$this->get_out($timearray);
       
		$sum['jd']=$this->get_jd($timearray);

		$sum['in']=$this->get_in($timearray);
		/*	$sum['mfl']=T('user')->set_field(array('sum(ncash) as total'))->get_one(array('flag'=>0));*/
      
		if($sum['mfl']){$sum['mfl']=$sum['mfl']['total'];}else{
			$sum['mfl']=0;
		} 
		for($i = 1; $i <= $data['t']; $i++){
			$tmptime=strtotime($data['year'].'-'.$data['mouth'].'-'.$i);
			$tmptimearray=array($tmptime,($tmptime+G_DAY));
			$day['out'][$i]=$this->get_out($tmptimearray);
			$day['jd'][$i]=$this->get_jd($tmptimearray);
       
       
			$day['in'][$i]=$this->get_in($tmptimearray);
     
			if(($i-1)==0){
          	
				$lasttimearray=array(($tmptime-G_DAY),$tmptime);
				$timeinarray=array(0,$tmptime);
				$djie=T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('endtime'=>$timeinarray,'status'=>array(0,1)));
				$zz= T('out')->set_field(array('sum(cash) as total'))->get_one(array('starttime'=>$timeinarray,'waiting'=>1,'alloc'=>array(0,1)));
				if($djie){$djie=$djie['total'];}
				else{
					$djie=0;
				}
				if($zz){$zz=$zz['total'];}
				else{
					$zz=0;
				}
				/*$day['yj'][$i]=$day['jd'][$i]-($this->get_zz($lasttimearray)-$this->get_jd($lasttimearray));*/
			
				$day['yj'][$i]=$zz-$djie- $sum['mfl'];
			
			}else{
				$lasttimearray=array($tmptime,($tmptime+G_DAY),);
				$timeinarray=array(0,$tmptime);
				$jd=T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('endtime'=>$lasttimearray));
	
				if($jd){
					$jd=$jd['total'];
				}else{
					$jd=0;
				}
				/*d($jd);*/
				$lasttimearray=array(($tmptime-G_DAY),$tmptime);
				$last=$this->get_zz($lasttimearray);
				if(!$last){
					$last-=$day['yj'][$i-1];
				}
				$day['yj'][$i]=$jd-$last;
			}/*else{
			$day['yj'][$i]=$day['yj'][$i-1]-$day['yj'][$i-2];
			}*/
			if($i==$data['t']){
				$day['outstring'].=$day['out'][$i];
				$day['jdstring'].= $day['jd'][$i];
      
				$day['instring'].=$day['in'][$i];
				$day['yjstring'].=$day['yj'][$i];
			}else{
				$day['outstring'].=$day['out'][$i].",";
				$day['jdstring'].= $day['jd'][$i].",";
     
				$day['instring'].=$day['in'][$i].",";
				$day['yjstring'].=$day['yj'][$i].",";
			}
         
			//预计出场金额=当天解冻金额-（前一天实际转正金额-前一天解冻金额）
			/*  先计算，从2月24日之前所有将要解冻的资金总和=X（已经解冻的不计算）
			再计算2月24日之前所有的转正资金总和=Y (已经匹配的不计算）
			再计算所有人钱包里马夫罗的总和=Z

			日历上显示在24号那一栏就显示一个数据=Y-X-Z*/
        
		}

		$var_array=array('data'=>$data,'sum'=>$sum,'day'=>$day);
    	
		$this->view(null,$var_array);
	}

	//提供帮助
	private function get_out($timeinarray){
		$info= T('out')->set_field(array('sum(cash) as total'))->get_one(array('addtime'=>$timeinarray));
		return intval($info['total']);
	}  
	//解冻资金
	private function get_jd($timeinarray){
		$info= T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('hadetime'=>$timeinarray,'status'=>2));
		/*$info1= T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('endtime'=>$timeinarray,'type'=>0,'status'=>0));
		$info2= T('wallet')->set_field(array('sum(endmoney) as total'))->get_one(array('endtime'=>$timeinarray,'type'=>0,'status'=>array(1,2)));*/
		$tatal=intval($info['total'])+intval($info1['total'])+intval($info2['total']);
		return $tatal;
		/*return T('wallet')->get_count(array('endtime'=>$timeinarray));*/
	} 
	//转正
	private function get_zz($timeinarray){
		$info= T('out')->set_field(array('sum(cash) as total'))->get_one(array('starttime'=>$timeinarray,'waiting'=>1));
		return intval($info['total']);
   	
   	
		/*return T('out')->get_count(array('starttime'=>$timeinarray));*/
	}
	//提款
	private function get_in($timeinarray){
		$info= T('in')->set_field(array('sum(cash) as total'))->get_one(array('addtime'=>$timeinarray));
		return intval($info['total']);
		/*	return T('in')->get_count(array('addtime'=>$timeinarray));*/
	}
	public
	function control_foam(){
		//输出当前月份
		//输出每日统计
		//数据包括；每日新增的排单；产生的利息；产生的领导奖励；；
		$data=get(array('int'=>array('data'=>'time')));
    	
		if(!($data['data']) ){
			$data['year']=date('Y');
			$data['mouth']=date('m');
			$data['day']=date('d');
			$time=strtotime($data['year'].'-'.$data['mouth'].'-'.$data['day']);
		}else{
			$time=$data['data'];
		}
		$timearray=array($time,($time+G_DAY));
		
		$data['zt']= T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('hadetime'=>$timearray,'type'=>'1','inbox'=>0,'status'=>2));
		if($data['zt']['total']==null)$data['zt']['total']=0;
		$data['jl']= T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('hadetime'=>$timearray,'type'=>'1','inbox'=>1,'status'=>2));
		if($data['jl']['total']==null)$data['jl']['total']=0;
		$data['qt']= T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('hadetime'=>$timearray,'type'=>'2','inbox'=>0,'status'=>2));
		if($data['qt']['total']==null)$data['qt']['total']=0;
		$data['bx']= T('wallet')->set_field(array('sum(startmoney) as total'))->get_one(array('hadetime'=>$timearray,'type'=>'0','inbox'=>0,'status'=>2));
		if($data['bx']['total']==null)$data['bx']['total']=0;
		$data['bd']= T('out')->set_field(array('sum(cash) as total'))->get_one(array('addtime'=>$timearray));
		if($data['bd']['total']==null)$data['bd']['total']=0;
     					
		
		$var_array=array('data'=>$data,'day'=>$time);
    
		$this->view(null,$var_array);
	}



}
?>
