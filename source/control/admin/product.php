<?php


namespace ng169\control\admin;

use ng169\control\adminbase;

checktop();

class product extends adminbase{
	private $db_name = 'product';
	private $key = 'productid';
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

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view(null,$var_array);
	}
public function control_box(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->set_global_where(array('temptype'=>1,'status'=>0,'shelves'=>1,'pflag'=>1));

		$model     = $this->init_where($model);

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
	public function control_waitcheck(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0,'pflag'=>array(0,3,10)));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('product_index',$var_array);
	}
	public function control_aftercheck(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'pflag'=>1));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('product_index',$var_array);
	}
	public function control_adminclose(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>3));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('product_index',$var_array);
	}
	public function control_merchantclose(){

      
		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>array(1,2)));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('product_index',$var_array);
	}
	public function control_shelves(){

		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0,'shelves'=>1,'pflag'=>1));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('product_index',$var_array);
	}
	public function control_checkfail(){

		$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T($this->db_name)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'product_check','checkid','checkid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->set_global_where(array('temptype'=>1,'status'=>0,'pflag'=>2));

		$model     = $this->init_where($model);


		$model     = $this->init_order($model);


		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array($c    =>$data,'page'=>$page);
		$this->view('product_index',$var_array);
	}
	public function control_edit(){
		$where=get(array('int'=>array('productid'=>1)));
		$mod    = T('merchant');
		$info=T('product')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->get_one($where);
		if(!$info)error('数据不存在');
		if(!$_POST){
			$this->view(null,array('data'=>$info));
			die();
		}

		$insert=get(array('string'=>array('productname'=>1,'content'=>'html','smallimg1'=>1,'unit'=>1,'price'=>1,'smallimg2','smallimg3','smallimg4','smallimg5'),'int'=>array('logistempid'=>1,'invoice'=>1,'shelves'=>1,'melite'=>1,'count'=>1)));
		

		$insert['temptype']    = 1;
		if(parent::$conf['auto_check_pro']){
			$insert['pflag']    = 1;
		}else{
			$insert['pflag']    = 0;
		}
		$insert['edittime']    = time();
	
		$flag   = T($this->db_name)->update($insert,$where);
	
		if($flag){
			$attribute=get(array('array'=>array('aname','avalue')));
			T('product_attribute')->del($where);
			if(is_array($attribute['aname'])){
					
				
				foreach($attribute['aname'] as $k=>$list){
					$l=array();
					$l['productid']=$info['productid'];
					$l['aname']=$list;
					$l['avalue']=$attribute['avalue'][$k];
			
					T('product_attribute')->add($l);
				}}
			$attribute=get(array('array'=>array('sname','svalue')));
			T('product_specs')->del($where);
			if(is_array($attribute['sname'])){
				foreach($attribute['sname'] as $k=>$list){
					$l=array();
					$l['productid']=$info['productid'];
					$l['sname']=$list;
					$l['svalue']=$attribute['svalue'][$k];
				
					T('product_specs')->add($l);
				}
			}
			out('保存成功',null,0);
			/*gourl(geturl(array('productid'=>$flag,'edit')));*/
		}else{
			error('保存失败',null,0);
		}
	}

	public function control_add(){
		
		if(!$_POST){
			$id='product_cate';
		if(!$this->getcache()){
			$cache=new cfileClass();
		list($bool,$cae)=$cache->get($id);
		
		if($bool){
		$data['data']=	$cae;
		}else{
			$data['data']=	T('product_category')->set_field('catid,catname,depth,alias,ptype')->get_child('catid');
			$cache->set($id,$data['data']);
			
		}
		}
		
	
			$this->view(null,$data,null,1);
			die();
		}
		
		$mod    = T('merchant');
		$user=get(array('string'=>array('merchantname'=>1)));
		$userinfo=$mod->get_one($user);
		if(!$userinfo){error('用户不存在');
		}
		$insert['muid']=$userinfo['muid'];
		$user=get(array('int'=>array('catid'=>1)));
		$userinfo=T('product_category')->get_one($user);
		if(!$userinfo){error(' 分类不存在');
		}
		$insert['temptype']    = 0;
		$insert['addtime']    = time();
		$insert['catid']    = $userinfo['catid'];
		$flag   = T($this->db_name)->add($insert);
		if($flag){
			gourl(geturl(array('productid'=>$flag),'edit','product'));
		}else{
			out('添加失败',null,0);
		}
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
	public function control_clear(){
		
       
		
		$where['temptype']=0;
		$model = T($this->db_name)->del($where);
	
		out('清空成功',null,$model);
	}
	public function control_checkall(){
		
       
		$w = array($this->key=> 1);
        
		$where = G(array('array'=> $w))->get();
       
		if(sizeof($where) == 0){
			$where = G(array('int'=> $w))->get();
			/*if(Y::$warp_admin['adminid']==$where['adminid'])error('不能删除自己的账号');*/
		}
		$model = T($this->db_name)->update(array('pflag'=>1),$where);
		/*	M('log','am')->log($model, $where);*/
		out('审核完成');
	}
	public function control_check(){
		$where=get(array('int'=>array('productid'=>1)));
		$mod    = T('merchant');
		$info=T('product')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->get_one($where);
		
		if($_POST){
			if($info['pflag']==1 || $info['pflag']==2){
				error('该商品已无法再审');
			}
		$f=get(array('int'=>array('pflag'=>1)));
		$reson=get(array('string'=>array('reason')));
		/*if($f['pflag'])*/
       switch($f['pflag']){
	   	case 0:error('数据错误');
	   		break;
	   		case 1:
	   		$i['productid']=$where['productid'];
	   		$i['addtime']=time();
	   		$i['pflag']=$f['pflag'];
	   		$i['reason']=$reson['reason'];
	   		$i['adminid']=parent::$wrap_admin['adminid'];
	   		$f=T('product_check')->add($i);
	   		$insert['pflag']=$i['pflag'];
	   		$insert['checkid']=$f;
	   		T('product')->update($insert,$where);
	   		M('msg','am')->sysmsg($info['uid'],$info['productid'].'审核成功',$reson['reason']);
	   		break;
	   		case 2:
	   		$i['productid']=$where['productid'];
	   		$i['addtime']=time();
	   		$i['pflag']=$f['pflag'];
	   		$i['reason']=$reson['reason'];
	   		$i['adminid']=parent::$wrap_admin['adminid'];
	   		$f=T('product_check')->add($i);
	   		$insert['pflag']=$i['pflag'];
	   		$insert['checkid']=$f;
	   		$insert['shelvesnum']=$info['shelvesnum']+1;
	   		T('product')->update($insert,$where);
	   		M('msg','am')->sysmsg($info['uid'],$info['productid'].'审核失败',$reson['reason']);
	   		break;
	   		case 3:
	   		$i['productid']=$where['productid'];
	   		$i['addtime']=time();
	   		$i['pflag']=$f['pflag'];
	   		$i['reason']=$reson['reason'];
	   		$i['adminid']=parent::$wrap_admin['adminid'];
	   		$f=T('product_check')->add($i);
	   		$insert['pflag']=$i['pflag'];
	   		$insert['checkid']=$f;
	   		$insert['shelvesnum']=$info['shelvesnum']+1;
	   		T('product')->update($insert,$where);
	   		M('msg','am')->sysmsg($info['uid'],$info['productid'].'审核失败',$reson['reason']);
	   		break;
	   	
	   	
	   }
		out('状态更新完成');
		
		
		
	
		}
		
		
		if(!$info)error('数据不存在');
		$this->view(null,array('data'=>$info));
	}
public function control_stopsell(){
		$where=get(array('int'=>array('productid'=>1)));
		$mod    = T('merchant');
		$info=T('product')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'product_category','catid','catid'),1)->get_one($where);
		
		if($_POST){
			/*if($info['status']!=0){
				error('该商品已无法操作');
			}*/
		$f=get(array('int'=>array('status'=>1)));
		$reson=get(array('string'=>array('reason')));
		/*if($f['pflag'])*/
       switch($f['status']){
	   	
	   		case 1:
	   		$i['productid']=$where['productid'];
	   		$i['addtime']=time();
	   		
	   		$i['reason']=$reson['reason'];
	   		$i['adminid']=parent::$wrap_admin['adminid'];
	   		$f=T('product_check')->add($i);
	   		$insert['status']=0;
	   	
	   		T('product')->update($insert,$where);
	   		M('msg','am')->weigui_msg_jc($info['uid'],$info['productid'],$reson['reason']);
	   		break;
	   		case 2:
	   		$i['productid']=$where['productid'];
	   		$i['addtime']=time();
	   		
	   		$i['reason']=$reson['reason'];
	   		$i['adminid']=parent::$wrap_admin['adminid'];
	   		$f=T('product_check')->add($i);
	   		$insert['status']=3;
	   	
	   		
	   		T('product')->update($insert,$where);
	   		M('msg','am')->weigui_msg($info['uid'],$info['productid'],$reson['reason']);
	   		break;
	   		default:error('操作未知');
	   	
	   }
		out('状态更新完成');
		
		
		
	
		}
		
		
		if(!$info)error('数据不存在');
		$this->view(null,array('data'=>$info));
	}
}

?>
