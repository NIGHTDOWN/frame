<?php





checktop();
class control extends userbase{
	
	public
	function control_run(){
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('jf_log');

		$model     = $model->set_where(array('uid'=>$this->get_userid(1)));

		$model     = $model->order_by(array('f'=>'addtime','s'=>'down'));


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
		
	}
public
	function control_product(){
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('order_jf')->join_table(array('t'=>'jfproduct','productid','productid'));

		$model     = $model->set_where(array('uid'=>$this->get_userid(1)));

		$model     = $model->order_by(array('f'=>'createtime','s'=>'down'));


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
		
	}
public
	function control_detail(){
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('order_jf')->join_table(array('t'=>'jfproduct','productid','productid'));
		$id=get(array('string'=>array('ordernum')));
		$model     = $model->set_where(array('uid'=>$this->get_userid(1),'ordernum'=>$id['ordernum']));

		


		

		$data      = $model->get_one();

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
		
	}
}
?>
