<?php




checktop();

class control extends adminbase{
	private $db_name = 'jfproduct';
	private $key = 'productid';
	
	public function control_run(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}

	public function control_temp(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>0,'status'=>0));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
	
	public function control_edit(){
		$where=get(array('int'=>array('productid'=>1)));
		
		$info=T($this->db_name)->join_table(array('t'=>'product_category','catid','catid'),1)->get_one($where);
		if(!$info)error('数据不存在');
		if(!$_POST){
			$this->view(null,array('data'=>$info));
			die();
		}

		$insert=get(array('string'=>array('productname'=>1,'content'=>'html','smallimg1'=>1,'unit'=>1,'originalprice'=>1,'price'=>1,'smallimg2','smallimg3','smallimg4','smallimg5'),'int'=>array('shelves'=>1,'elite','count'=>1)));
		

		$insert['temptype']    = 1;
		$insert['pflag']    = 0;
		$insert['edittime']    = time();
	
		$flag   = T($this->db_name)->update($insert,$where);
	
		if($flag){
			$attribute=get(array('array'=>array('aname','avalue')));
			T('jfproduct_attribute')->del($where);
			if(is_array($attribute['aname'])){
					
				
				foreach($attribute['aname'] as $k=>$list){
					$l=array();
					$l['productid']=$info['productid'];
					$l['aname']=$list;
					$l['avalue']=$attribute['avalue'][$k];
			
					T('jfproduct_attribute')->add($l);
				}}
			$attribute=get(array('array'=>array('sname','svalue')));
			T('jfproduct_specs')->del($where);
			if(is_array($attribute['sname'])){
				foreach($attribute['sname'] as $k=>$list){
					$l=array();
					$l['productid']=$info['productid'];
					$l['sname']=$list;
					$l['svalue']=$attribute['svalue'][$k];
				
					T('jfproduct_specs')->add($l);
				}
			}
			out('保存成功');
			/*gourl(geturl(array('productid'=>$flag,'edit')));*/
		}else{
			error('保存失败',null,0);
		}
	}

	public function control_add(){
		if(!$_POST){
			$this->view(null,null,null,1);
			die();
		}
		
		/*$mod    = T('merchant');
		$user=get(array('string'=>array('merchantname'=>1)));
		$userinfo=$mod->get_one($user);
		if(!$userinfo){error('用户不存在');
		}*/
		$insert['muid']=parent::$wrap_admin['adminid'];
		$user=get(array('int'=>array('catid'=>1)));
		$userinfo=T('product_category')->get_one($user);
		if(!$userinfo){error(' 分类不存在');
		}
		$insert['temptype']    = 0;
		$insert['addtime']    = time();
		$insert['catid']    = $userinfo['catid'];
		$flag   = T($this->db_name)->add($insert);
		if($flag){
			gourl(geturl(array('productid'=>$flag),'edit','jfproduct'));
		}else{
			out('添加失败',null,0);
		}
	}
	public function control_del(){
		
       
		$w = array($this->key=> 1);
        
		$where = G(array('array'=> $w))->get();
       
		
		$model = T($this->db_name)->del($where);
		M('log','am')->log($model, $where);
		out('删除成功',null,$model);
	}
	
}

?>
