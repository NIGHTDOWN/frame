<?php


namespace ng169\control\admin;

use ng169\control\adminbase;

checktop();

class ad extends adminbase{
	private $db_name = 'ad';
	private $key = 'adid';
	private $allkey = array('int'      =>array(
			'adsid'=>1,
			'aflag'=>1,'orders','price'
		),
		'string'=>array('alt'=>1  ,
			'pic',
			'stime'=>'time','etime'=>'time','href'=>1,
			));
	public function control_run(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'ads','adsid','adsid'));

		$model     = $this->init_where($model);

		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

      


		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	




	public function control_add(){
		$where=get(array('int'=>array('adsid')));
		if(!$_POST){
			$this->view(null,array('select'=>$where));
			die();
		}
		$this->issuper();
		/*$mod    = T('user');*/
		$insert = G($this->allkey)->get();
		/*$user=get(array('string'=>array('username'=>1)));*/
		/*$userinfo=T($this->db_name)->get_one(array('identify'=>$insert['identify']));
		if($userinfo){error('广告标识已经存在');
		}*/
		$insert['addtime']    = time();
		$insert['adminid']    = parent::$wrap_admin['adminid'];
		/*$more = array('regtime'=>$t,'regip'  =>YRequest::getip(),'creatid'=>parent::$wrap_admin['adminid'],'addtime'=>$t);
		$insert = array_merge($insert,$more);*/
		$i=array('addtime'=>time(),'url'=>$insert['href']);
		$urlid=T('url_encode')->add($i);
		$insert['urlid']    = $urlid;
		$flag   = T($this->db_name)->add($insert);
		if($flag){
			out('添加成功');
		}else{
			out('添加失败',null,0);
		}
	}

	public function control_show(){
		$where=get(array('int'=>array($this->key=>1)));
		$inf0=T($this->db_name)->join_table(array('t'=>'ads','adsid','adsid'))->get_one($where);
		if(!$inf0)error('数据不存在');
		if(!$_POST){
			$this->view('ad_add',array('data'=>$inf0));
			die();
		}
		
		/*$mod    = T('user');*/
			unset($this->allkey['int']['adsid']);
		$insert = G($this->allkey)->get();
		$i=array('addtime'=>time(),'url'=>$insert['href']);
		$urlid=T('url_encode')->add($i);
		$insert['urlid']    = $urlid;
		$flag   = T($this->db_name)->update($insert,$where);
		/*M('log','am')->log($flag,null,$insert);*/
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
