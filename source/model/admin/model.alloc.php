<?php



checktop();
class allocModel extends Y{
	private $looparray = array();


	private function _setalloc(){
		$time = $_SERVER['REQUEST_TIME'];
		$pre  = DB_PREFIX;
		$sql  = "UPDATE {$pre}out SET `alloc`=1,`allocmoney`=`cash` WHERE `status`='0' and linetime<=$time and `alloc`=0 and `waiting`>=1";
     
		$db   = new daoClass();
		
		return    $db->query($sql);
	}
	private function _getde($id = null){
		$mod = T('in')->set_field(array('iid'));
		$time = $_SERVER['REQUEST_TIME'] - (Y::$conf['gd_min_time'] * 3600);
		$where = array('status'=>0,'addtime'=>array(0,$time));
		if($id){
			$where['iid'] = $id;
		}
		$mod->set_where($where,'=');
		return $mod->get_all();
	}

	public function start($id = null,$type = null){

		$this->_setalloc();
		$iid = $this->_getde($id);
  
		foreach($iid as $v){
			if(!is_array($v))break;
			
			$pre  = DB_PREFIX;
			$id   = $v['iid'];
			$sql  = "UPDATE {$pre}in SET `alloc`=1,`allocmoney`=`cash` WHERE `status`='0' and iid={$id} and `alloc`=0";
			$db   = new daoClass();
			$db->query($sql);
			$this->_alloc($id);
		}
		YLog::txt('匹配进程退出');
		return 0;
	}

	private function _alloc($iid){
		if(!$iid)
		{
			
			return false;
		}

		if($this->looparray[$iid] > 10){
			
			return 0;
		}else{

			$this->looparray[$iid] += 1;
		}

		$Aiid = T('in')->set_where(array('iid'=>$iid))->get_one();
		$uid = $Aiid['uid'];
		$size= T('out')->set_where(array('alloc'=>1))->get_count();
     
		$size   = $size > 2?2:$size;
		$string = trim(trim($Aiid['iids']),',');
       
		$not    = ($string == '')?"":"and `user`.uid not in ({$string})";

		$Aoid   = T('out')->set_field("v.*",0)->order_by(array('f'=>'starttime,addtime','s'=>'up'))->join_table(array('t'=>'user','uid','uid'))->set_where(array('alloc' =>1,'status'=>0,'waiting'=>array(2,10)))->set_where("`user`.`flag` = 0 and `user`.`exit` = 0  and `user`.uid != $uid  $not",null,0)->set_limit(array(0,1))->get_one();

		if(!$Aoid){
			YLog::txt('订单不存在，退出');
			return 0;
		}
		if($Aoid['linetime']>time()){
			YLog::txt($iid.'订单匹配等待时间未到用户选择时间，退出匹配');
			return 0;
		}
		if($Aiid['allocmoney'] > 1000){
			$money = $Aiid['allocmoney'] / $size;
           
          
			$money = floor($money / 100) * 100;
			if($money <= 0){
				YLog::txt($iid.'订单金额不足，退出匹配');
				return false;
			}
			$allocmoney = $Aoid['allocmoney'] - $money ;
			$oallocmoney= $Aiid['allocmoney'] - $money ;

			if($allocmoney > 0){
				$bool = $this->_createorder($Aoid['uid'],$Aiid['uid'],$Aoid['oid'],$Aiid['iid'],$money);
				if(!$bool){
					YLog::txt($iid.'创建订单失败，退出匹配');
					return false;
				}

				$up = array('allocmoney'=>$oallocmoney,'iids'      =>$Aiid['iids'].','.$Aoid['uid']);

				$where = array('iid'=>$iid);
				T('in')->update($up,$where);
				$up = array('allocmoney'=>$allocmoney         );
				$where = array('oid'=>$Aoid['oid']);
				T('out')->update($up,$where);
				return $this->_alloc($iid);
			}else
			if($allocmoney = 0){
				$bool = $this->_createorder($Aoid['uid'],$Aiid['uid'],$Aoid['oid'],$Aiid['iid'],$money);
				if(!$bool){
					YLog::txt($iid.'创建订单失败，退出匹配');
					return false;
				}

				$up = array('allocmoney'=>$oallocmoney,'iids'      =>$Aiid['iids'].','.$Aoid['uid']);

				$where = array('iid'=>$iid);
				T('in')->update($up,$where);
				$up = array('allocmoney'=>$allocmoney            );
				$where = array('oid'=>$Aoid['oid']);
				T('out')->update($up,$where);
				return $this->_alloc($iid);
			}else{

				$bool = $this->_createorder($Aoid['uid'],$Aiid['uid'],$Aoid['oid'],$Aiid['iid'],$Aoid['allocmoney']);
               
				if(!$bool){
					YLog::txt($iid.'创建订单失败，退出匹配');
					return false;
				}

				$oallocmoney = $Aiid['allocmoney'] - $Aoid['allocmoney'] ;
				$up          = array('allocmoney'=>$oallocmoney,'iids'      =>$Aiid['iids'].','.$Aoid['uid']);
				$where = array('iid'=>$iid);
				if($oallocmoney == 0){

					$this->_iend($where['iid']);
				}
				T('in')->update($up,$where);
				$up = array('allocmoney'=>0);
				$where = array('oid'=>$Aoid['oid']);
				$this->_oend($where['oid']);
				T('out')->update($up,$where);
				return $this->_alloc($iid);
			}

		}else{
			$money = $Aiid['allocmoney'];
			if($money <= 0){
					YLog::txt($iid.'可分配金额不足，退出匹配');
					return false;
				}
			$allocmoney = $Aoid['allocmoney'] - $money ;
			$oallocmoney= $Aiid['allocmoney'] - $money ;


			if($allocmoney > 0){
				$bool = $this->_createorder($Aoid['uid'],$Aiid['uid'],$Aoid['oid'],$Aiid['iid'],$money);
				if(!$bool){
					YLog::txt($iid.'创建订单失败，退出匹配');
					return false;
				}


				$up = array('allocmoney'=>0,'iids'      =>$Aiid['iids'].','.$Aoid['uid']);
				$where = array('iid'=>$iid);

				$this->_iend($where['iid']);
				T('in')->update($up,$where);
				$up = array('allocmoney'=>$allocmoney );
				$where = array('oid'=>$Aoid['oid']);
				T('out')->update($up,$where);
				return true;
			}else
			if($allocmoney = 0){
				$bool = $this->_createorder($Aoid['uid'],$Aiid['uid'],$Aoid['oid'],$Aiid['iid'],$money);
				if(!$bool){
					YLog::txt($iid.'创建订单失败，退出匹配');
					return false;
				}

				$up = array('allocmoney'=>0,'iids'      =>$Aiid['iids'].','.$Aoid['uid']);
				$where = array('iid'=>$iid);

				$this->_iend($where['iid']);
				T('in')->update($up,$where);
				$up = array('allocmoney'=>0);
				$where = array('oid'=>$Aoid['oid']);
				$this->_oend($where['oid']);
				T('out')->update($up,$where);
				return true;
			}else{

				$bool = $this->_createorder($Aoid['uid'],$Aiid['uid'],$Aoid['oid'],$Aiid['iid'],$Aoid['allocmoney']);
				if(!$bool){
					YLog::txt($iid.'创建订单失败，退出匹配');
					return false;
				}

				$oallocmoney = $Aiid['allocmoney'] - $Aoid['allocmoney'] ;
				$up          = array('allocmoney'=>$oallocmoney,'iids'      =>$Aiid['iids'].','.$Aoid['uid']);
				$where = array('iid'=>$iid);

				if($oallocmoney == 0){
					$this->_iend($where['iid']);
				}
				T('in')->update($up,$where);
				$up = array('allocmoney'=>0);
				$where = array('oid'=>$Aoid['oid']);
				$this->_oend($where['oid']);
				T('out')->update($up,$where);
				return $this->_alloc($iid);
			}
		}
	}
	private function _oend($oid){
		YLog::txt($oid.'匹配结束');

		$Ainfo = T('out')->join_table(array('t'=>'user','uid','uid'))->get_one(array('oid' =>$oid));
		$this->_sendsms($Ainfo['mobile'],$Ainfo['lid']);
		$cash = $Ainfo['cash'] * Y::$conf['out_rate'];
		$day  = round(($_SERVER["REQUEST_TIME"] - $Ainfo['addtime']) / G_DAY)+intval($Ainfo['tasknum']);
		$day=$day>=30?30:$day;
		$rate = $cash * $day;
		$up   = array('alloc' =>'2','etime' =>$_SERVER["REQUEST_TIME"],'status'=>3,'rate'  =>$rate);
		$where = array('oid'   =>"=$oid",'status'=>'!=1');
		$money=$rate+$Ainfo['cash'];
		
		/*	M('mfl','am')->uprate($Ainfo['lid'],$money);*/
		return T('out')->update($up,$where);
	}
	public function _sendsms($phone,$id){
		if(Y::$conf['smsflag'] == 0){
			YLog::txt('短信通知接口关闭');
			return 0;
		}
		$msg = M('template','im')->getmsg('sms_order',array('orderid'=>''.$id.''));
       
		$smspai = Y::import('SMS','tool');
		$key    = $smspai->send($phone,$msg['content']);
		if($key[0] == 100){
			YLog::txt($phone.$msg['content'].'发送成功');
		}else{
		
			YLog::txt('发送失败'.$key[0]);
		}
	}
	private function _iend($iid){
		YLog::txt($iid.'匹配结束');
		$Ainfo = T('in')->join_table(array('t'=>'user','uid','uid'))->get_one(array('iid'=>$iid));
		$this->_sendsms($Ainfo['mobile'],$Ainfo['lid']);
		$up = array('alloc'    =>'2','status'   =>'3','alloctime'=>$_SERVER['REQUEST_TIME']);
		$where = array('iid'   =>"=$iid",'status'=>'!=1');
		return T('in')->update($up,$where);
	}
	private function _createorder($fuid,$tuid,$oid,$iid,$money,$type = 0){

		if(!$money || !$oid)return false;
		if($money<=0)return false;
		if($type == 0){
			$insert = array('oid'    =>$oid,'iid'    =>$iid,'fromuid'=>$fuid,'addtime'=>$_SERVER['REQUEST_TIME'],'touid'  =>$tuid,'cash'   =>$money);
		}else{
			$insert = array('oid'    =>$oid,'iid'    =>$iid,'fromuid'=>$fuid,'addtime'=>$_SERVER['REQUEST_TIME'],'touid'  =>$tuid,'cash'   =>$money,'type'   =>1);
		}
		return T('pay')->add($insert);
	}
}
?>
