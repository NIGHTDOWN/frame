<?php




checktop();
class control extends adminbase{
	private $db= 'order';
	private $key='orderid';
	public
	function control_run(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		/*$this->page_size=15;*/
        
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('merchant'),'order_product.muid','muid'),1)->set_field('*,productname,merchant.merchantname,merchant.muid,productid,order_product.ordernum,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,logisfee')->set_where(array('productid'=>0),'!=')->group_by('v.ordernum');
      
		$model=$this->init_where($model);
       
        
		$model=$model->order_by(array('s'=>'down','f'=>'createtime'));
        
		 $table=$model->set_field(array('count(*)'));
        $num=$table->get_all();
        $num=sizeof($num);
        $pagesize=10;
      
		
		
		if($pagesize){
			$this->set_pagesize($pagesize);
		}
		$agrs=$_GET;
		 
		unset($agrs['page']);
		
		$a=D_FUNC;
		
		$url=geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total']=$num;
		$pagearray['szie']=$pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum']=$this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, 4);
       
        
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
		foreach($data as $k=>$v){
			$data[$k]['productlist']=T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t'=>'product','v.productid','productid'),1)->order_by(array('f'=>'id','s'=>'down'))->join_table(array('t'=>'merchant','muid','muid'),1)->get_all(array('ordernum'=>$v['ordernum']));
			
		}
       
        
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view(null,$var_array);
		
	
	}
  public
	function control_pay(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		/*$this->page_size=15;*/
        
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('merchant'),'order_product.muid','muid'),1)->set_field('*,productname,merchant.merchantname,merchant.muid,productid,order_product.ordernum,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,logisfee')->set_where(array('productid'=>0),'!=')->set_global_where(array('status'=>1))->group_by('v.ordernum');
      
		$model=$this->init_where($model);
       
        
		$model=$model->order_by(array('s'=>'down','f'=>'createtime'));
        
		 $table=$model->set_field(array('count(*)'));
        $num=$table->get_all();
        $num=sizeof($num);
        $pagesize=10;
      
		
		
		if($pagesize){
			$this->set_pagesize($pagesize);
		}
		$agrs=$_GET;
		 
		unset($agrs['page']);
		
		$a=D_FUNC;
		
		$url=geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total']=$num;
		$pagearray['szie']=$pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum']=$this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, 4);
       
        
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
		foreach($data as $k=>$v){
			$data[$k]['productlist']=T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t'=>'product','v.productid','productid'),1)->order_by(array('f'=>'id','s'=>'down'))->join_table(array('t'=>'merchant','muid','muid'),1)->get_all(array('ordernum'=>$v['ordernum']));
			
		}
       
        
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('order_index',$var_array);
		
	
	}
public
	function control_unsure(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		/*$this->page_size=15;*/
        
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('merchant'),'order_product.muid','muid'),1)->set_field('*,productname,merchant.merchantname,merchant.muid,productid,order_product.ordernum,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,logisfee')->set_where(array('productid'=>0),'!=')->set_global_where(array('status'=>2))->group_by('v.ordernum');
      
		$model=$this->init_where($model);
       
        
		$model=$model->order_by(array('s'=>'down','f'=>'createtime'));
        
		 $table=$model->set_field(array('count(*)'));
        $num=$table->get_all();
        $num=sizeof($num);
        $pagesize=10;
      
		
		
		if($pagesize){
			$this->set_pagesize($pagesize);
		}
		$agrs=$_GET;
		 
		unset($agrs['page']);
		
		$a=D_FUNC;
		
		$url=geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total']=$num;
		$pagearray['szie']=$pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum']=$this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, 4);
       
        
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
		foreach($data as $k=>$v){
			$data[$k]['productlist']=T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t'=>'product','v.productid','productid'),1)->order_by(array('f'=>'id','s'=>'down'))->join_table(array('t'=>'merchant','muid','muid'),1)->get_all(array('ordernum'=>$v['ordernum']));
			
		}
       
        
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('order_index',$var_array);
		
	
	}
public
	function control_end(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		/*$this->page_size=15;*/
        
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('merchant'),'order_product.muid','muid'),1)->set_field('*,productname,merchant.merchantname,merchant.muid,productid,order_product.ordernum,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,logisfee')->set_where(array('productid'=>0),'!=')->set_global_where(array('status'=>3))->group_by('v.ordernum');
      
		$model=$this->init_where($model);
       
        
		$model=$model->order_by(array('s'=>'down','f'=>'createtime'));
        
		 $table=$model->set_field(array('count(*)'));
        $num=$table->get_all();
        $num=sizeof($num);
        $pagesize=10;
      
		
		
		if($pagesize){
			$this->set_pagesize($pagesize);
		}
		$agrs=$_GET;
		 
		unset($agrs['page']);
		
		$a=D_FUNC;
		
		$url=geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total']=$num;
		$pagearray['szie']=$pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum']=$this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, 4);
       
        
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
		foreach($data as $k=>$v){
			$data[$k]['productlist']=T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t'=>'product','v.productid','productid'),1)->order_by(array('f'=>'id','s'=>'down'))->join_table(array('t'=>'merchant','muid','muid'),1)->get_all(array('ordernum'=>$v['ordernum']));
			
		}
       
        
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('order_index',$var_array);
		
	
	}
public
	function control_close(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		/*$this->page_size=15;*/
        
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('merchant'),'order_product.muid','muid'),1)->set_field('*,productname,merchant.merchantname,merchant.muid,productid,order_product.ordernum,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,logisfee')->set_where(array('productid'=>0),'!=')->set_global_where(array('status'=>4))->group_by('v.ordernum');
      
		$model=$this->init_where($model);
       
        
		$model=$model->order_by(array('s'=>'down','f'=>'createtime'));
        
		 $table=$model->set_field(array('count(*)'));
        $num=$table->get_all();
        $num=sizeof($num);
        $pagesize=10;
      
		
		
		if($pagesize){
			$this->set_pagesize($pagesize);
		}
		$agrs=$_GET;
		 
		unset($agrs['page']);
		
		$a=D_FUNC;
		
		$url=geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total']=$num;
		$pagearray['szie']=$pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum']=$this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, 4);
       
        
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
		foreach($data as $k=>$v){
			$data[$k]['productlist']=T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t'=>'product','v.productid','productid'),1)->order_by(array('f'=>'id','s'=>'down'))->join_table(array('t'=>'merchant','muid','muid'),1)->get_all(array('ordernum'=>$v['ordernum']));
			
		}
       
        
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('order_index',$var_array);
		
	
	}
public
	function control_unpay(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		/*$this->page_size=15;*/
        
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('merchant'),'order_product.muid','muid'),1)->set_field('*,productname,merchant.merchantname,merchant.muid,productid,order_product.ordernum,v.paytime,v.createtime,v.totals,v.yh,mark,v.status,paytotal,autosuretime,cflag,tkflag,logisfee')->set_where(array('productid'=>0),'!=')->set_where(array('status'=>0))->group_by('v.ordernum');
      
		$model=$this->init_where($model);
       
        
		$model=$model->order_by(array('s'=>'down','f'=>'createtime'));
        
		 $table=$model->set_field(array('count(*)'));
        $num=$table->get_all();
        $num=sizeof($num);
        $pagesize=10;
      
		
		
		if($pagesize){
			$this->set_pagesize($pagesize);
		}
		$agrs=$_GET;
		 
		unset($agrs['page']);
		
		$a=D_FUNC;
		
		$url=geturl($agrs,$a);
		Y::loadTool('page');
		$pagearray['total']=$num;
		$pagearray['szie']=$pagearray['szie']?$pagearray['szie']:$this->page_size;
		$pagearray['pagenum']=$this->_thispage();
		TPL::assign(array('pagearray'=>$pagearray));
		$page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, 4);
       
        
        
		$data= $model->set_limit($this->get_page_limit())->get_all();
        
		foreach($data as $k=>$v){
			$data[$k]['productlist']=T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t'=>'product','v.productid','productid'),1)->order_by(array('f'=>'id','s'=>'down'))->join_table(array('t'=>'merchant','muid','muid'),1)->get_all(array('ordernum'=>$v['ordernum']));
			
		}
       
        
		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('order_index',$var_array);
		
	
	}
	public function control_del(){
		$w = array($this->key);
		
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
		
		$list=T($this->db)->set_field('ordernum')->get_all($where);
		if(sizeof($list)==0)out('删除成功',null,$model); 
		$l['ordernum']=array_column($list,'ordernum');
		$model = T($this->db)->del($where);
		T('order_product')->del($l);
		$list=T('order_refund')->set_field('refundid')->get_all($where);
		if(sizeof($list)==0)out('删除成功',null,$model); 
		
		$l2['refundid']=array_column($list,'refundid');
		T('order_refund')->del($where);
		T('refund_detail')->del($l2);
		
		out('删除成功',null,$model);
	}   
	public function control_detail(){
		$c=D_MEDTHOD;	$a=D_FUNC;
		$get=get(array('string'=>array('oid'=>1)),array('oid'=>'订单编号'));
		$where['ordernum']=$get['oid'];
		/*$where['uid']=$this->get_userid(1);*/
		$model=T('order')->join_table(array('t'=>('order_product'),'ordernum','ordernum'),1)->join_table(array('t'=>('merchant'),'order_product.muid','muid'),1)->set_field('*,v.*,merchant.phone as sphone,merchant.address as saddress')->set_where(array('productid'=>0),'!=')->set_global_where($where);
       
     
		$data= $model->get_one();
         
		if(!$data)error('订单不存在');
    
		$data['productlist']=T('order_product')->order_by(array('f'=>'id','s'=>'down'))->get_all(array('ordernum'=>$data['ordernum']));

		$var_array=array('data'=>$data,'page'=>$page);
		$this->view('order_show',$var_array);
		
	
	}   
public function control_save(){
		$get2=get(array('int'=>array('orderid'=>1)));
		$model = T($this->db)->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'admins','adminid','adminid'),1)->join_table(array('t'=>'jfproduct','productid','productid'),1)->get_one($get2);
		if(!$model)error('订单不存在');
		$get=get(array('int'=>array('status'=>1),'string'=>array('sender','sendnum')));
		
		if($model['status']==2 || $model['status']==3){
			error('订单已经不能编辑');
		}
		if($get['status']==1){
			if(!$get['sender'])error('物流名称不能留空');
			if(!$get['sendnum'])error('物流单号不能留空');
			$get['adminid']=parent::$wrap_admin['adminid'];
			$get['sendtime']=time();
			T($this->db)->update($get,$get2);
		}else{
			T($this->db)->update(array('status'=>$get['status']),$get2);
		}
		
		out('操作完成');
		$this->view(null,array('data'=>$model));       
        
	}  
	public function control_cancel(){

		$w = array('oid' => 1);
		$where = G(array('array' => $w))->get();
		if(sizeof($where) == 0){
			$where = G(array('int' => $w))->get();
		}
		$where2['ordernum']=$where['oid'];
		$where2['delflag']=0;
		$where2['status']=0;
		/*$where2['uid']=$this->get_userid(1);*/
		$model = T('order')->update(array('status'=>4,'closetype'=>3,'closeadminid'=>parent::$wrap_admin['adminid']),$where2);
		if($model)out('订单已经取消');
		error('订单取消失败');
	}  
	public
	function control_sure(){
		$get1=get(array('string'=>array('oid'=>1)));
		
	
		$f=M('order','im')->adminsure($get1['oid']);
		if($f)out('交易完成。');
		error('确认失败');

	}
public
	function control_changtotal(){
		$get1=get(array('string'=>array('oid'=>1,'paytotal'=>1)));
		
		$falg=T('order')->update(array('paytotal'=>$get1['paytotal']),array('orderid'=>$get1['oid'],'status'=>0));
	
		/*$f=M('order','im')->adminsure($get1['oid']);*/
		if($falg)out('修改成功');
		error('修改失败');

	}
}

?>
