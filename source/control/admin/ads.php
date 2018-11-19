<?php


namespace ng169\control\admin;

use ng169\control\adminbase;

checktop();

class ads extends adminbase{
	private $db_name = 'ads';
	private $key = 'adsid';
	private $allkey = array('int'      =>array('phone',
			'provinceid','catid',
			'cityid',
			'areaid','width','height','flag','adtype'=>1,'price','num','buy','adlevel',
		),
		'string'=>array('adname'=>1  ,
			'identify'=>1,
			
			));
	public function control_run(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name);

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

      


		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	




	public function control_add(){
		if(!$_POST){
			$this->view();
			die();
		}
		$this->issuper();
		/*$mod    = T('user');*/
		$insert = G($this->allkey)->get();
		/*$user=get(array('string'=>array('username'=>1)));*/
		$userinfo=T($this->db_name)->get_one(array('identify'=>$insert['identify']));
		if($userinfo){error('广告标识已经存在');
			
		}
		/*if($mod->check_exist(array('username'=>$insert['username']))){
			out('用户账号不存在',NULL,0);
		}
		if($insert['password'] == ''){
			out('密码不能为空',null,0);
		}*/
		$insert['createtime']    = time();
		$insert['adminid']    = parent::$wrap_admin['adminid'];
		/*$more = array('regtime'=>$t,'regip'  =>YRequest::getip(),'creatid'=>parent::$wrap_admin['adminid'],'addtime'=>$t);
		$insert = array_merge($insert,$more);*/
		$flag   = T($this->db_name)->add($insert);
		/*M('log','am')->log($flag,null,$insert);*/
		if($flag){
			out('添加成功');
		}else{
			out('添加失败',null,0);
		}
	}

	public function control_show(){
		$where=get(array('int'=>array($this->key=>1)));
		$inf0=T($this->db_name)->get_one($where);
		if(!$inf0)error('数据不存在');
		if(!$_POST){
			
			$this->view('ads_add',array('data'=>$inf0));
			die();
		}
		
		/*$mod    = T('user');*/
			unset($this->allkey['string']['identify']);
		$insert = G($this->allkey)->get();
	
		$flag   = T($this->db_name)->update($insert,$where);
	
		if($flag){
			out('更新成功');
		}else{
			out('更新失败',null,0);
		}
	}

	public function control_del(){
		$this->issuper();
       
		$w = array($this->key=> 1);
        
		$where = G(array('array'=> $w))->get();
       
		if(sizeof($where) == 0){
			$where = G(array('int'=> $w))->get();
			if(Y::$warp_admin['adminid']==$where['adminid'])error('不能删除自己的账号');
		}
		$model = T($this->db_name)->del($where);
		M('log','am')->log($model, $where);
		out('删除成功',null,$model);
	}


}

?>
