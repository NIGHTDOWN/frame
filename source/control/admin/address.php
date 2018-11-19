<?php


namespace ng169\control\admin;

use ng169\control\adminbase;

checktop();

class address extends adminbase{
	private $db_name = 'user_address';
	private $key = 'addid';
	private $allkey = array('int'      =>array('phone',
			'provinceid',
			'cityid',
			'areaid'
		),
		'string'=>array('address'  ,
			'realname'=>1,
			
			));
	public function control_run(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'user','uid','uid'))->set_field('v.*,username');

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

      


		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	
	public function control_show(){
		if($_POST){
			$this->save();
		}
		$c     = D_MEDTHOD;    $a     = D_FUNC;
		$where = G(array('int'=>array('addid'=>1)),array('addid'=>'ID'))->get();
		$mod = T($this->db_name);
		$data= $mod->join_table(array('t'=>'user','uid','uid'))->set_field('v.*,username')->get_one($where);
		if(!$data){
			YOut::page404();
		}
	/*	M('log','am')->log($data,$where);*/
		$var_array = array('data'=>$data);
		$this->view('address_add',$var_array);

	}





	public function save(){
		/*$this->issuper();*/
		$mod   = T($this->db_name);
		$where = G(array('int'=>array($this->key=>1)))->get();
		/*unset($this->allkey['string']['password']);*/
		$insert = G($this->allkey)->get();
		$flag   = $mod->updata(array('v'=>$insert,'w'=>$where));
		/*M('log','am')->log($flag,null,$insert);*/
		if($flag){
			out('保存成功');
		}else{
			out('保存失败',null,0);
		}

	}
	public function control_cgthispwd(){
		if($_POST){
			/*$this->issuper();*/
		$mod   = T($this->db_name);
	
		$pw = array('string'=>array('password'=>5));
		$oldpw = array('string'=>array('old'=>5));
		$oldpw=get($oldpw);
		$pw=get($pw);
		/*d(parent::$wrap_admin);*/
		/*d($oldpw);
		d(parent::$wrap_admin,1);*/
		if($oldpw['old']==parent::$wrap_admin['password']){
			$flag=$mod->update($pw,array('adminid'=>parent::$wrap_admin['adminid']));
		}else{
			error('修改失败');
		}
		if($flag){
			out('修改成功');
		}else{
			error('修改失败');
		}
		}
		$this->view();

	}
	public function control_del(){
		
       
		$w = array($this->key=> 1);
        
		$where = G(array('array'=> $w))->get();
       
		if(sizeof($where) == 0){
			$where = G(array('int'=> $w))->get();
			
		}
		$model = T($this->db_name)->del($where);
	
		out('删除成功',null,$model);
	}


}

?>
