<?php




checktop();

class control extends adminbase{
	private $db_name = 'groupon';
	private $key = 'gpid';
	
	public function control_run(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'product','pid','productid'));

		$model     = $this->init_where($model);

		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

      


		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	
	public function control_wait(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'product','pid','productid'))->set_global_where(array('gcheck'=>0));

		$model     = $this->init_where($model);

		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

      


		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('groupon_index',$var_array);
	}



	public function control_add(){
		$where=get(array('int'=>array('gpid')));
		$data=T($this->db_name)->join_table(array('t'=>'product','pid','productid'))->get_one($where);
		if(!$_POST){
			$this->view(null,array('select'=>$where));
			die();
		}

		$insert = get(array('string'=>array('gtitle'=>1,'gimg'=>1,'gprice'=>1,'gstime'=>'time','getime'=>'time'),'int'=>array('ghits','gelite','gsells','gcheck','pid'=>1)));
		if($insert['getime']<=$insert['gstime'] ){
			error('团购结束时间不能小于团购开始时间');
		}
		/*if($insert['gstime']<=time()){
			error('团购开始时间不能小于当前时间');
		}*/
		$insert['gaddtime']    = time();
		$insert['checkadminid']    = parent::$wrap_admin['adminid'];

		
	if(!$where['gpid']){
			
		if($insert['gcheck']==1){
			$is=T($this->db_name)->get_one(array('pid'=>$insert['pid'],'gcheck'=>1));
			if($is){
				error('当前商品已经存在团购');
			}	
			}
		T($this->db_name)->add($insert);
		out('添加成功');
	}else{
		if($insert['gcheck']==1 && $data['gcheck']!=1){
			$is=T($this->db_name)->get_one(array('pid'=>$insert['pid'],'gcheck'=>1));
			if($is){
				error('当前商品已经存在团购');
			}
			}
			
			T($this->db_name)->update($insert,$where);
			out('修改成功');
		}
	}
	public function control_show(){
		$where=get(array('int'=>array('gpid'=>1)));
		$data=T($this->db_name)->join_table(array('t'=>'product','pid','productid'))->get_one($where);
		if($data){
			$this->view('groupon_add',array('data'=>$data));
			
		}
		else{
			error('数据不存在');
		}
	}
	

	public function control_del(){
		
       
		$w = array($this->key=> 1);
        
		$where = G(array('array'=> $w))->get();
       
		
		$model = T($this->db_name)->del($where);
		
		out('删除成功',null,$model);
	}


}

?>
