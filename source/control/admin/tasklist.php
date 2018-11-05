<?php





checktop();
class control extends adminbase{
	private $db = 'tasklist';
	private $key = 'taskid';

	public function control_run(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'task','taskid','taskid'),1)->order_by(array('f'=>array('id'),'s'=>'down'));
		$model = $this->init_where($model);
		$model = $this->init_order($model);
		$page  = $this->make_page($model);
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}

	public function control_cancel(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'task','taskid','taskid'),1)->order_by(array('f'=>array('id'),'s'=>'down'))->set_global_where(array('status'=>4));
		$model = $this->init_where($model);
		$model = $this->init_order($model);
		$page  = $this->make_page($model);
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('tasklist_index',$var_array);
	}
	public function control_fail(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'task','taskid','taskid'),1)->order_by(array('f'=>array('id'),'s'=>'down'))->set_global_where(array('status'=>3));
		$model = $this->init_where($model);
		$model = $this->init_order($model);
		$page  = $this->make_page($model);
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('tasklist_index',$var_array);
	}
	public function control_wait(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'task','taskid','taskid'),1)->order_by(array('f'=>array('id'),'s'=>'down'))->set_global_where(array('status'=>0));
		$model = $this->init_where($model);
		$model = $this->init_order($model);
		$page  = $this->make_page($model);
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('tasklist_index',$var_array);
	}
	public function control_waitcheck(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'task','taskid','taskid'),1)->order_by(array('f'=>array('id'),'s'=>'down'))->set_global_where(array('status'=>1));
		$model = $this->init_where($model);
		$model = $this->init_order($model);
		$page  = $this->make_page($model);
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('tasklist_index',$var_array);
	}
	public function control_ok(){
		$c     = D_MEDTHOD;    $a     = D_FUNC;

		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'task','taskid','taskid'),1)->order_by(array('f'=>array('id'),'s'=>'down'))->set_global_where(array('status'=>2));
		$model = $this->init_where($model);
		$model = $this->init_order($model);
		$page  = $this->make_page($model);
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('tasklist_index',$var_array);
	}
	public function control_del(){

		$w = array($this->key => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
		
		$model = T($this->db_name)->del($where);
		
		out('删除成功',null,$model);
	}   
	public function control_checksb(){
		$w = get(array('int'=>array('id' => 1)));

		M('task','am')->fail($id['id']);
		YOut::redirect(geturl(null,'run'));
		
	}
	public function control_checkcg(){
	
		
		$w = get(array('int'=>array('id' => 1)));

		M('task','am')->check($w['id']);
		YOut::redirect(geturl(null,'run'));
	}
	public function control_check(){
		
		$w = get(array('array'=>array('id' => 1)));
		foreach($w['id'] as $id){
			M('task','am')->check($id);
		}
		YOut::redirect(geturl(null,'run'));
	}
}

?>
