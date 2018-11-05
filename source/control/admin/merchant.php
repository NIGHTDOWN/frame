<?php



checktop();
class control extends adminbase{
	private $db_name = 'merchant';
	private $key = 'muid';
	private $insert2=array('string'=>array('username'));
	private $insert=array('string'=>array('merchantname'=>1,'logo'=>1,'address'),'int'=>array('slevel','bad','good','center','storeflag','elite','provinceid','areaid','cityid'));
	public function control_run(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'))->order_by(array('s'=>'down','f'=>array($this->key)));   
		$model=$this->init_where($model);
		$model=$this->init_order($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	public function control_waitcheck(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'))->order_by(array('s'=>'down','f'=>array($this->key)));   
		$model=$this->init_where($model);
		$model=$model->set_global_where(array('rzflag'=>0,'flag'=>0));
		$model=$this->init_order($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('merchant_index',$var_array);
	} 
public function control_fail(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'))->order_by(array('s'=>'down','f'=>array($this->key)));   
		$model=$this->init_where($model);
		$model=$model->set_global_where(array('rzflag'=>3,'flag'=>0));
		$model=$this->init_order($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('merchant_index',$var_array);
	}
	public function control_normal(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'))->order_by(array('s'=>'down','f'=>array($this->key)));   
		$model=$this->init_where($model);
		$model=$model->set_global_where(array('flag'=>0,'rzflag'=>array(1,2)));
		$model=$this->init_order($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('merchant_index',$var_array);
	}
	public function control_black(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$model=T($this->db_name)->join_table(array('t'=>'user','uid','uid'))->order_by(array('s'=>'down','f'=>array($this->key)));   
		$model=$this->init_where($model);
		$model=$model->set_global_where(array('flag'=>1));
		$model=$this->init_order($model);
		$page=$this->make_page($model);
		$data= $model->set_limit($this->get_page_limit())->get_all();
		$var_array=array($c=>$data,'page'=>$page);
		$this->view('merchant_index',$var_array);
	}
	public function control_city(){
		$k=get(array('int'=>array('provinceid'=>1)));
		$info=T('city')->get_all(array('fatherID'=>$k['provinceid']));
		out($info);
		/*$this->view(null,$var_array);*/
	}
	public function control_area(){
		$k=get(array('int'=>array('cityid'=>1)));
		$info=T('area')->get_all(array('fatherID'=>$k['cityid']));
		out($info);
		/*$this->view(null,$var_array);*/
	}
	public function control_add(){
		if($_POST){
			$i2=get($this->insert2);
			$info=T('user')->get_one($i2);
			if($info){
				error('账号已经存在');
			}
			
			$uid=T('user')->add($i2);
			if(!$uid)error('账号创建失败');
			$i=get($this->insert);
			$info=T('merchant')->get_one(array('merchantname'=>$i['merchantname']));
			if($info){
				error('店铺已经存在');
			}
			$i['uid']=$uid;
			$i['createtime']=$_SERVER['REQUEST_TIME'];
			$i['regip']=$_SERVER['REMOTE_ADDR'];
			$f=T('merchant')->add($i);
			if($f){
				out('店铺创建成功');
			}else{
				error('店铺创建失败');
			}
			
		}
		$this->view(null,$var_array);
	}
public function control_rz(){
		$get=get(array('int'=>array('muid'=>1)));
		$info=T('merchant')->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'merchant_rz','muid','muid'),1)->get_one(array('muid'=>$get['muid']));
		if(!$info)error('数据不存在');
		if($_POST){
			if($info['status']==1){
				error('店铺已经认证，请勿重复审核');
			}
			$get=get(array('int'=>array('status'=>1),'string'=>array('reason')));
			$get['adminid']=parent::$wrap_admin['adminid'];
			$get['checktime']=time();
			$wheremuid=array('muid'=>$info['muid']);
			T('merchant_rz')->update($get,$wheremuid);
			if($get['status']==1){
				if($info['rztype']==1){
					$i['rzflag']=$info['rztype'];
				}elseif($info['rztype']==2){
					$i['rzflag']=$info['rztype'];
				}
				$u=geturl(null,'shop_check_1','asyn','admin');
			}else{
				$i['rzflag']=3;
				$u=geturl(null,'shop_check_0','asyn','admin');
			}
			YAsyn::start($u,$wheremuid);
			T('merchant')->update($i,$wheremuid);
			out('店铺审核完成');
		}
		
		$var_array=array('data'=>$info);
		$this->view(null,$var_array);
	}
	public function control_show(){
		$info2=get(array('int'=>array('muid'=>1)));
		$info1=T('merchant')->join_table(array('t'=>'user','uid','uid'))->get_one($info2);
		if(!$info1)error('ID丢失');
		if($_POST){
			/*$i2=get($this->insert2);
			$info3=T('user')->get_one($i2);
			if(!$info3){
				error('账号不存在');
			}*/
			
			/*$uid=T('user')->add($i2);*/
			/*if(!$uid)error('账号创建失败');*/
			$i=get($this->insert);
			$info=T('merchant')->get_count(array('merchantname'=>$i['merchantname']));
			if($info>=2){
				error('店铺名称已经存在');
			}
			/*$i['uid']=$info3['uid'];*/
			/*$i['createtime']=$_SERVER['REQUEST_TIME'];*/
			/*$i['regip']=$_SERVER['REMOTE_ADDR'];*/
			$f=T('merchant')->update($i,$info2);
			if($f){
				out('店铺修改成功');
			}else{
				error('店铺修改失败');
			}
			
		}
		$var_array=array(D_MEDTHOD=>$info1);
		$this->view('merchant_add',$var_array);
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
}
?>
