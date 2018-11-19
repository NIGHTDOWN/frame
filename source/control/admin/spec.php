<?php

namespace ng169\control\admin;

use ng169\control\adminbase;


checktop();
class spec extends adminbase
{
    private $db_name = 'product_category_attribute';
    private $key='id';
    private $allkey=array(
        'int'=>array('elite','flag','parentid','orders','ptype'=>1,'setmuid'),
         'string'=>array('alias','catname'=>1,'detailtpl','indextpl','listtpl','metadesc','metakeyword','metatitle'),
	
	);
    public function control_run()
    {
       $c=D_MEDTHOD;	$a=D_FUNC;
        
        $model=T($this->db_name)->join_table(array('t'=>'product_category','catid','catid'))->set_global_where(array('type'=>1));
        
        $model=$this->init_where($model);
        
        $model=$this->init_order($model);
        
        $page=$this->make_page($model);
        
        $data= $model->set_limit($this->get_page_limit())->get_all();
        
	    $var_array=array('data'=>$data,'page'=>$page);
        $this->view('',$var_array);
    }
    public function control_add(){
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $where=G(array('int'=>array('catid'=>1)))->get();
        $one=T('product_category')->get_one($where);
        if(!$one)/*YOut::page404();*/error('类型不存在');
        $var_array=(array('select'=>$one));
        $num=T('product_category_attribute')->get_count(array('type'=>1,'catid'=>$one['catid']));
        if($num>=5){
			error('每种产品最多添加5种规格');
		}
        if($_POST){
			$insert=get(array('string'=>array('sname'=>1,'setmuid','orders')));
			$insert['catid']=$where['catid'];
			$insert['addtime']=time();
			$insert['type']=1;
			$f=T('product_category_attribute')->add($insert);
			if($f)out('规格添加成功');
			error('规格添加失败');
		}
        
        $this->view('spec_add',$var_array); 
    }
      public function control_show(){
        $c=D_MEDTHOD;	$a=D_FUNC;
        
        $where=G(array('int'=>array('id'=>1)))->get();
        $one=T('product_category_attribute')->join_table(array('t'=>'product_category','catid','catid'))->get_one($where);
        if(!$one)/*YOut::page404();*/error('数据不存在');
        $var_array=(array('select'=>$one));
        if($_POST){
			$insert=get(array('string'=>array('sname'=>1,'setmuid','catid'=>1,'orders')));
			/*$insert['catid']=$where['catid'];*/
		/*	$insert['addtime']=time();*/
			/*$insert['type']=0;*/
			$f=T('product_category_attribute')->update($insert,$where);
			if($f)out('规格修改成功',geturl());
			error('规格修改失败',geturl());
		}
       
        $this->view('spec_add',$var_array); 
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
