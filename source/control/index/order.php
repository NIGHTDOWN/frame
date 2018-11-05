<?php






checktop();

class control extends indexbase{
	public function control_list(){
		$get=get(array('int'=>array('productid'=>1)));
		$get['status']=3;
		$model=T('order_product')->join_table(array('t'=>'order','ordernum','ordernum'),1)->join_table(array('t'=>'user','order.uid','uid'),1)->set_where($get,'=');
		/*$model     = $this->init_where($model);
		$model     = $this->init_order($model);*/
	    $page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$var_array = array('data'  =>$data,'page'=>$page);
		/*d($data,1);*/
		$this->view(null,$var_array);
	}

}
?>
