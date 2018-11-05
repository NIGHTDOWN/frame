<?php





checktop();
class control extends userbase{
	
	public
	function control_run(){
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('card');

		$model     = $model->set_where(array('uid'=>$this->get_userid(1)));

		$model     = $model->order_by(array('f'=>'addtime','s'=>'down'));


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'  =>$data,'page'=>$page);
		$this->view(null,$var_array);
		
	}
public
	function control_add(){
	if($_POST){
		if(!parent::$wrap_user['userrz']){
			error('请先实名认证');
		}
		$get=get(array('string'=>array('bankname'=>1,'bankuser'=>1,'banknum'=>1,'bankaddress'=>1)),array('bankname'=>'银行名称','bankuser'=>'开户姓名','banknum'=>'银行卡号','bankaddress'=>'开户地址'));
	if(parent::$wrap_user['realname']!=$get['bankuser']){
		error('开户姓名必须与实名认证姓名一致');
	}
	$get['uid']=$this->get_userid();
	$get['addtime']=time();
	T('card')->add($get);
	out('卡号添加成功',geturl(null,null,'card'));
	}
		$this->view(null,$var_array);
		
	}
public
	function control_show(){
	$get=get(array('int'=>array('cardid'=>1)),array('cardid'=>'ID'));
	$get['uid']=$this->get_userid();
	$data=T('card')->get_one($get);
	$this->view(null,array('data'=>$data));
}
public function control_del(){
		$w = array('cardid' => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
       
        $where['uid'] = $this->get_userid(1);
        $model = T('card')->del($where);
        out('删除成功',geturl(null,null,'card'));
		
	}
}
?>
