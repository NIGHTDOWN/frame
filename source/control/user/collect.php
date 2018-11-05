<?php





checktop();
class control extends userbase{
public
	function control_run(){
		gourl(geturl(null,'product'));
	}
	
	public
	function control_product(){
	$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('collect_product')->join_table(array('t'=>'product','productid','productid'));

		$model     = $model->set_where(array('uid'=>$this->get_userid(1)));

		$model     = $model->order_by(array('f'=>'addtime','s'=>'down'));


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
public
	function control_shop(){
	$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('collect_shop')->join_table(array('t'=>'merchant','muid','muid'));

		$model     = $model->set_where(array('uid'=>$this->get_userid(1)));

		$model     = $model->order_by(array('f'=>'addtime','s'=>'down'));


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
public
	function control_history(){
	$c         = D_MEDTHOD;    $a         = D_FUNC;

		$data=T('product_log')->set_field(array('count(theday) as num,logid,stime,uid,theday'))->group_by('theday')->set_limit(20)->order_by(array('f'=>'stime','s'=>'down'))->get_all(array('uid'=>$this->get_userid(1)));

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
public
	function control_pdel(){
		$w = array('cid' => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $model = T('collect_product')->del($where);
        out('删除成功',null,$model);
	}
	public
	function control_hdel(){
		$w = array('logid' => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $model = T('product_log')->del($where);
        out('删除成功',null,$model);
	}
	public
	function control_sdel(){
		$w = array('cid' => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $model = T('collect_shop')->del($where);
        out('删除成功',null,$model);
	}
}
?>
