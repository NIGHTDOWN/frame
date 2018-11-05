<?php
checktop();
class control extends indexbase{

	
	public function control_run(){
		
		$this->vlog($this->get_userid());
		
 		if(YUrl::ismoible()){
 			
			$this->view();  
		}else{
	//	$this->view('index0',$array);
	/*$this->view('nav',$array);  */
			$this->view('index0',$array);  
			$this->view(null,$array);
		
		}
		
		
	
		
	}
	public function control_menu(){
		$name="pc_indexmenu";
		list($bool,$data)=Y::$cache->get($name);
		if($bool){
			$cat=$data;
			//先读缓存
		}else{
			$cat=T('product_category')->set_where('depth=1 and flag=0')->set_field('catname,catid,alias')->get_all();
		foreach($cat as $k=>$list){
		$cat[$k]['list']=T('product_category')->set_where('depth=2 and flag=0 and parentid='.$list['catid'])->set_field('catname,catid,alias')->get_all();	
		foreach($cat[$k]['list'] as $k2=>$list2){
			$cat[$k]['list'][$k2]['list']=T('product_category')->set_where('depth=3 and flag=0 and parentid='.$list2['catid'])->set_field('catname,catid,alias')->get_all();
		}
		
		}
		Y::$cache->set($name,$cat,0);
		}
		
		
		/*d($cat);*/
		
		$data=array('cat'=>$cat);
		
		
		
		
		$this->view('menu',$data);
	}
	public function control_cart(){
		
		$this->view('cartasyn');
      
	}
	public function control_area(){

		$this->view('area');
      
	}
	public function control_kb(){

		$this->view('kb');
      
	}
	public function control_gethot(){
		$name="pc_hot_category";
		list($bool,$data)=Y::$cache->get($name);
		if($bool){
			$cat=$data;
			//先读缓存
		}else{
			$cat=T('product_category')->set_where('depth=1 and flag=0 and elite=1')->order_by(array('f'=>'orders','s'=>'down'))->set_field('catid,catname,depth,alias')->get_all();
		
		Y::$cache->set($name,$cat,0);
		}




		$this->view('hot',array('data'=>$cat));
      
	}
	public function control_gg(){

		$this->view('gg');
      
	}
	public function control_hotsell(){
if(YUrl::ismoible()){
	$data=M('index','im')->get3();
	echo json_encode($data);
	die();
}else{
	$this->view('hotsell');
}
		
      
	}
public function control_getproduct(){

if(YUrl::ismoible()){
	$page=16;
	$get=get(array('int'=>array('s')));
	$where=array('shelves'=>1,'status'=>0,'pflag'=>1);
	$s=array($get['s']*$page,$get['s']*$page+$page);
	$data=T('product')->set_where($where)->set_limit($s)->order_by(array('s'=>'down','f'=>'productid'))->get_all();
	echo json_encode($data);
	die();
}else{
	echo 0;
	die();
}
		
      
	}
	public function control_logset(){
	
		
		if(YUrl::isAjax()){
			$get=get(array('int'=>array('logid'=>1,'type')));
			M('vlog','im')->settime($get['logid'],$get['type']);
		}else{
				YOut::page404();
			}
		
	}
	public function control_getad(){
		$id=get(array('string'=>array('id'=>1)),array('广告标识'));
		
	if($id['id']){
		
		$ad=get_ads($id['id']);
		
		if($ad){echo json_encode($ad);}else{
			
			return false;
		}
		
		return true;
	}else{
		/*echo 'fail';*/
		return false;
	}
	}
public function control_cate_getad(){
		$id=get(array('string'=>array('id'=>1,'catid'=>1)),array('id'=>'广告标识','catid'=>'分类'));
		
	if($id['id']){
		
		$ad=get_ads($id['id']);
		
		if($ad){echo json_encode($ad);}else{
			
			return false;
		}
		
		return true;
	}else{
		/*echo 'fail';*/
		return false;
	}
	}
}
?>
