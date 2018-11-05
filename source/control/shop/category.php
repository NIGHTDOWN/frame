<?php





checktop();
class control extends shopbase{
	public
	function control_product(){
		
		if(parent::$wrap_user['rzflag']==1 || parent::$wrap_user['rzflag']==2){
			$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('product')->set_field('productid,productname,scatid,smallimg1')->set_global_where(array('status'=>0,'muid'=>$this->get_muid(1)))->order_by(array('s'=>'down','f'=>'addtime'));

	
$model=$model->set_where(get(array('string'=>array('productname'))));
		$page      = $this->make_page($model,4,12);


		$data      = $model->set_limit($this->get_page_limit())->get_all();
$scatid=get(array('int'=>array('scatid')));
		$var_array = array('data'   =>$data,'page'=>$page,'scatid'=>$scatid['scatid']);
		$this->view(null,$var_array);
		}else{
			error('店铺未认证');
		}
	
	}
	public
	function control_setpro(){
		
		if(parent::$wrap_user['rzflag']==1 || parent::$wrap_user['rzflag']==2){
		$get=get(array('int'=>array('scatid'=>1),'string'=>array('val')));
		$where='productid in ('.trim($get['val'],',').') and muid='.$this->get_muid();
		$model=T('product');
		
		$model->update(array('scatid'=>$get['scatid']),$where);
out('设置完成');

		}else{
			error('店铺未认证');
		}
	
	}
	public
	function control_run(){
		
		if(parent::$wrap_user['rzflag']==1 || parent::$wrap_user['rzflag']==2){
			$c         = D_MEDTHOD;    $a         = D_FUNC;

		$model     = T('shop_category')->set_field('scatid,catname,orders,muid')->set_global_where(array('depth'=>0,'muid'=>$this->get_muid(1)))->order_by(array('s'=>'down','f'=>'orders'));

	

		$page      = $this->make_page($model);


		$data      = $model->set_limit($this->get_page_limit())->get_all();

		$var_array = array('data'   =>$data,'page'=>$page);
		$this->view(null,$var_array);
		}else{
			error('店铺未认证');
		}
	
	}
	public
	function control_change(){
		
		if(parent::$wrap_user['rzflag']==1 || parent::$wrap_user['rzflag']==2){
			
	  if(!YUrl::isAjax())error('非法访问');
	  $muid=$this->get_muid(); 
	  $data=get(array('string'=>array('action'=>1,'catname','orders','catid','pid')));
	  $a = $data['action'];
	  switch ($a) {
		  case 'add':
		 $num=M('scategory','im')->getl1num($muid);
		if(!$data['catname'])return false;
		 if($num>=10){
			 error('一级分类最多10个');
		 }
		 $insert['muid']=$muid;
		 $insert['catname']=$data['catname'];
		 $insert['addtime']=time();
		 $insert['depth']=0;
		 $insert['pid']=0;
		 $catid=T('shop_category')->add($insert);
		 out($catid);
		  break;
		  case 'add2':
		  if(!$data['pid'])return false;
		  if(!$data['catname'])return false;
		  $num=M('scategory','im')->getl2num($muid,$data['pid']);
		  
		  if($num>=5){
			  error('二级分类最多5个');
		  }
		  $insert['muid']=$muid;
		  $insert['catname']=$data['catname'];
		  $insert['addtime']=time();
		  $insert['depth']=1;
		  $insert['pid']=$data['pid'];
		  $catid=T('shop_category')->add($insert);
		  out($catid);
		   break;
		  case 'edit':
		 
		  if(!$data['catid'])error('错误');
		  if(!$data['catname'])return false;
		  $where=array('muid'=>$muid,'scatid'=>$data['catid']);
		 $in=T('shop_category')->get_one($where); 
		 if(!$in)error('错误');
		 if($in['catname']==$data['catname']){
			 return false;
		 }
		 T('shop_category')->update(array('catname'=>$data['catname']),$where); 
		 out('修改成功');
		  break;
		  case 'orders':
		 
		  if(!$data['catid'])error('错误');
		 
		  $where=array('muid'=>$muid,'scatid'=>$data['catid']);
		 $in=T('shop_category')->get_one($where); 
		 if(!$in)error('错误');
		 if($in['orders']==$data['orders']){
			 return false;
		 }
		 T('shop_category')->update(array('orders'=>intval($data['orders'])),$where); 
		 out('修改成功');
		  break;
		  case 'del':
		 
		  if(!$data['catid'])error('错误');
		 
		  $where=array('muid'=>$muid,'scatid'=>$data['catid']);
		 $in=T('shop_category')->get_one($where); 
		 if(!$in)error('错误');
		 if($in['depth']==0){
			$havechild=T('shop_category')->get_count(array('muid'=>$muid,'pid'=>$data['catid']));
			if($havechild>0)error('请先删除二级子分类');
		 }
		 T('shop_category')->del($where); 
		 out('删除成功');
		  break;
	  }

















		}else{
			error('店铺未认证');
		}
	
	}
}
?>
