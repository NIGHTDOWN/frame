<?php


namespace ng169\control\pay;
use ng169\control\userbase;


checktop();

class withdraw extends userbase{
	private function get_soleid(){
		$insert['soleid']=date('ymdHis').rand(9999,99999);
		if(T('withdraw')->get_one($insert)){
			return $this->get_ordernum();
		}
		return $insert['soleid'];
	}
	public function control_run(){
		if(!parent::$wrap_user['safepwd']){
			error('请先设置支付密码',geturl(null,'pwd','payset','pay'));
		}
		$card=T('card')->set_where(array('uid'=>$this->get_userid()))->order_by(array('s'=>'down','f'=>'addtime,usrtime'))->get_all();
		if($_POST){
			if(!parent::$wrap_user['userrz']){
				error('请先实名认证，否则无法提现');
			}
			//提现操作申请
			$get=get(array('string'=>array('pay_passwd'=>'md5')));
			if($get['pay_passwd']!=parent::$wrap_user['safepwd']){
				error('支付密码错误');
			}
			$card=get(array('int'=>array('cardid'=>1)),array('cardid'=>'收款方式'));
			$card['uid']=$this->get_userid();
			$card1=T('card')->set_where($card)->get_one();
			if(!$card1)error('收款信息不存在');
			T('card')->update(array('usrtime'=>time()),$card);
			$get=get(array('string'=>array('desc'),'int'=>array('amount'=>1,'choosetype'=>1)),array('amount'=>'提现金额','choosetype'=>'到账时间'));
			/*$get['amount']*=100;*/
			$feerate=Y::$conf["draw_time_".$get['choosetype']."_fee_rate"];
			
			if($feerate===null){
				error('到账类型错误');
			}
			$fee=sprintf("%.2f",($feerate*$get['amount']));
			d($fee);
			$fee=$fee>Y::$conf["draw_time_".$get['choosetype']."_max"]?Y::$conf["draw_time_".$get['choosetype']."_max"]:$fee;
			
			$fee=$fee<Y::$conf["draw_time_".$get['choosetype']."_min"]?Y::$conf["draw_time_".$get['choosetype']."_min"]:$fee;
			
			$total=$fee+$get['amount'];
			$total*=100;
			
			if($total>parent::$wrap_user['cash']){
				error('余额不足');
			}
			$get['fee']=$fee*100;
			$get['recvrealname']=$card1['bankuser'];
			$get['recvnum']=$card1['banknum'];
			$get['recvbankadd']=$card1['bankaddress'];
			$get['recvbank']=$card1['bankname'];
			$get['addtime']=time();
			$get['uid']=$this->get_userid(1);
			$get['money']=$get['amount']*100;
			$get['soleid']=$this->get_soleid();
			unset($get['amount']);
			$f=T('withdraw')->add($get);
			if($f){
				M('cash','im')->reduce($total,$f,'提现：'.$get['money']."【手续费：$fee】");
			}
		gourl(geturl(null,'withdraw','log'));
		
		}

		$data=array('api'=>$api,'card'=>$card);
		$this->view('pwithdraw',$data);
	}
	public function control_detail(){
		$get=get(array('string'=>array('soleid'=>1)));
		$model=T('withdraw')->set_global_where(array('uid'=>$this->get_userid(1),'soleid'=>$get['soleid'])); 
		$data= $model->get_one();
		if(!$data)error('交易号不存在');
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('pwithdrawdetail',$var_array);
	}
}
?>
