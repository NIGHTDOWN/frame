<?php


namespace ng169\model\index;
use ng169\Y;


checktop();
class index extends Y
{

 public function get1(){
 	$w=array('gcheck'=>1,'shelves'=>1,'status'=>0,'pflag'=>1);
 	/*$w['gstime']=array('1'=>time());
	$w['getime']=array('0'=>time());*/
	$time=time();
   return  T('groupon')->join_table(array('t'=>'product','pid','productid'),1)->order_by(array('s'=>'down','f'=>'sells'))->set_limit(3)->set_where("'gstime'<={$time} and 'getime'>={$time}")->set_where($w)->get_all();
 }
 public function get2(){
     $w=array('gcheck'=>1,'shelves'=>1,'status'=>0,'pflag'=>1);
 	/*$w['gstime']=array('1'=>time());
	$w['getime']=array('0'=>time());*/
	$time=time();
   return  T('groupon')->join_table(array('t'=>'product','pid','productid'),1)->order_by(array('s'=>'down','f'=>'likes'))->set_limit(3)->set_where("'gstime'<={$time} and 'getime'>={$time}")->set_where($w)->get_all();
 }
 public function get3(){
    $w=array('gcheck'=>1,'shelves'=>1,'status'=>0,'pflag'=>1);
 	/*$w['gstime']=array('1'=>time());
	$w['getime']=array('0'=>time());*/
	$time=time();
	
   return  T('groupon')->join_table(array('t'=>'product','pid','productid'),1)->order_by(array('s'=>'down','f'=>'gaddtime'))->set_limit(3)->set_where("'gstime'<={$time} and 'getime'>={$time}")->set_where($w)->get_all();
 }
 
 public function getcategoryproduct($catid){
 	
 	$name="product_category_tree__".$catid;
 	list($bool,$data)=Y::$cache->get($name);
		if($bool){
			$c=$data;
			//先读缓存
		}else{
			$c=M('tree','am')->getctree('product_category_tree',$catid);
		
		Y::$cache->set($name,$c,0);
		}

 	if(!$c)return false;
 	$where=array('shelves'=>1,'status'=>0,'pflag'=>1);	
 	$hot= T('product')->order_by(array('f'=>'sells','s'=>'down'))->set_limit(3)->set_global_where('catid in('.implode(',',$c).')')->set_field('productname,productid,smallimg1')->get_all($where);
 	
 	$data['hot']=$hot;
 	$cat=T('product_category')->set_field('catid,catname')->set_limit(6)->set_where(array('catid'=>$c),'in')->get_all();
 	
 	$data['cat']=$cat;	
 	return $data;
 }
 public function getcateproduct($catid){
 	/*$catid=T('product_category')->get_all_tree_id('catid');*/
 	return T('product')->set_limit(6)->get_all(array('status'=>0,'pflag'=>1,'shelves'=>1,'elite'=>1,'catid'=>$catid));
 }
 //商城公告
 public function scnews(){
	return 	T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->set_limit(10)->order_by(array('s'=>'down','f'=>'v.orders,abid'))->get_all(array('alias'=>'scgg','flag'=>0));
	}
 public function footgetxfz(){
 return 	T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->order_by(array('s'=>'down','f'=>'v.orders'))->get_all(array('alias'=>'xfz','flag'=>0));
 }
 public function footgetxssl(){
 	 return 	T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->order_by(array('s'=>'down','f'=>'v.orders'))->get_all(array('alias'=>'xssl','flag'=>0));
 }
 public function footgetfkfs(){
 	 return 	T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->order_by(array('s'=>'down','f'=>'v.orders'))->get_all(array('alias'=>'fkfs','flag'=>0));
 }
  public function footgethelp(){
 	 return 	T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->order_by(array('s'=>'down','f'=>'v.orders'))->get_all(array('alias'=>'help','flag'=>0));
 }
  public function footgetabout(){
 	 return 	T('singlepage')->join_table(array('t'=>'singlepage_category','catid','catid'))->order_by(array('s'=>'down','f'=>'v.orders'))->get_all(array('alias'=>'about','flag'=>0));
 }
 public function getarticle(){
 	return T('article')->set_limit(8)->order_by(array('f'=>'addtime','s'=>'down'))->get_all(array('flag'=>0,'elite'=>1));
 }
 public function getcomment(){
 	$dat= T('product_comment')->join_table(array('t'=>'product','productid','productid'),1)->set_where(array('shelves'=>1,'status'=>0,'pflag'=>1,'cmlevel'=>'1','cmflag'=>0))->join_table(array('t'=>'merchant','muid','muid'),1)->order_by(array('s'=>'down','f'=>'sells'))->set_limit(7)->group_by('product.productid')->get_all();
 
 	return $dat;
 }
}

?>
