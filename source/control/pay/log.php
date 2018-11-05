<?php






checktop();

class control extends userbase{
	public function control_order(){
		$model=T('order')->set_global_where(array('uid'=>$this->get_userid(1)))->order_by(array('s'=>'down','f'=>'orderid')); 
		$model=$model;
		$model=$this->init_where($model);
		
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit(),'orderid','<')->get_all();
		$var_array=array('data'=>$data,'page'=>$page);


		$this->view('plogorder',$var_array);
	}
	public function control_glide(){
	$model=T('cash_log')->set_global_where(array('uid'=>$this->get_userid(1),)); 
		$model=$model->order_by(array('s'=>'down','f'=>'addtime'));
		$model=$this->init_where($model);
		$page=$this->make_page($model);
		
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('plogglide',$var_array);
	}
	public function control_recharge(){
	$model=T('pay')->set_global_where(array('uid'=>$this->get_userid(1),'for'=>1)); 
		$model=$model->order_by(array('s'=>'down','f'=>'addtime'));
		/*$model=$this->init_where($model);*/
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('plogrecharge',$var_array);
	}
	public function control_withdraw(){
		$model=T('withdraw')->set_global_where(array('uid'=>$this->get_userid(1))); 
		$model=$model->order_by(array('s'=>'down','f'=>'addtime'));
		$model=$this->init_where($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array('data'=>$data,'page'=>$page);
		
		$this->view('plogwithdraw',$var_array);
	}
	
	
}
?>
