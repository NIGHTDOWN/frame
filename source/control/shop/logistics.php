<?php


namespace ng169\control\shop;

use ng169\control\shopbase;


checktop();
class logistics extends shopbase{
    private $db_name = 'logistemp';
    private $key='logistempid';
    private $allkey=array(
        'int'=>array('elite','flag','parentid','orders','ptype'=>1),
         'string'=>array('alias','catname'=>1,'detailtpl','indextpl','listtpl','metadesc','metakeyword','metatitle'),
	
	);
    public function control_run()
    {
       /*$c=D_MEDTHOD;	$a=D_FUNC;*/
        
        $model=T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'))->set_where(array('muid'=>$this->get_muid()));
        
     /*   $model=$this->init_where($model);
        
        $model=$this->init_order($model);*/
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
	    $var_array=array('data'=>$data,'page'=>$page);
        $this->view(null,$var_array);
    }
    public function control_add(){
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        
      
        if($_POST){
        /*	$merchant=get(array('string'=>array('merchantname'=>1)));
        $minfo=T('merchant')->get_one($merchant);
        if(!$minfo){
			error('商户不存在');
		}*/
			$insert=get(array('string'=>array('logisname'=>1),'int'=>array('provinceid'=>1,'cityid','areaid','ltype'=>1,'pricingmode'=>1,'kd','ems','py','kdnum','kdmoney','kdnummore','kdmoneymore','emsnum','emsmoney','emsnummore','emsmoneymore','pynum','pymoney','pynummore','pymoneymore')));
		/*	$insert['catid']=$where['catid'];*/
			$insert['muid']=$this->get_muid();
			$insert['addtime']=time();
			
			$insert['kdmoney']*=100;
			$insert['kdmoneymore']*=100;
			$insert['emsmoney']*=100;
			$insert['emsmoneymore']*=100;
			$insert['pymoney']*=100;
			$insert['pymoneymore']*=100;
			$f=T('logistemp')->add($insert);
			if($f)out('物流模板添加成功');
			error('物流模板添加失败');
			
		}
        
        $this->view(null,$var_array); 
    }
      public function control_show(){
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $where=G(array('int'=>array('logistempid'=>1)))->get();
        $where['muid']=$this->get_muid();
        $one=T('logistemp')->join_table(array('t'=>'merchant','muid','muid'))->get_one($where);
        if(!$one)YOut::page404();
        $var_array=(array('select'=>$one));
        if($_POST){
			$insert=get(array('string'=>array('logisname'=>1),'int'=>array('provinceid'=>1,'cityid','areaid','ltype'=>1,'pricingmode'=>1,'kd','ems','py','kdnum','kdmoney','kdnummore','kdmoneymore','emsnum','emsmoney','emsnummore','emsmoneymore','pynum','pymoney','pynummore','pymoneymore')));
		/*	$insert['catid']=$where['catid'];*/
			/*$insert['muid']=$minfo['muid'];
			*/
			/*$insert['type']=1;*/
			$insert['kdmoney']*=100;
			$insert['kdmoneymore']*=100;
			$insert['emsmoney']*=100;
			$insert['emsmoneymore']*=100;
			$insert['pymoney']*=100;
			$insert['pymoneymore']*=100;
			$insert['addtime']=time();
			$f=T('logistemp')->update($insert,$where);
			if($f)out('模板修改成功',geturl());
			error('模板修改失败',geturl());
		}
       
        $this->view('logistics_add',$var_array); 
    }
  

 public function control_del(){
		
       
		$w = array($this->key=> 1);
        
		$where = G(array('array'=> $w))->get();
       
		if(sizeof($where) == 0){
			$where = G(array('int'=> $w))->get();
		/*	if(Y::$warp_admin['adminid']==$where['adminid'])error('不能删除自己的账号');*/
		}
		$model = T($this->db_name)->del($where);
	/*	M('log','am')->log($model, $where);*/
		out('删除成功',null,$model);
	} 
}
?>
