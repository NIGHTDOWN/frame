<?php


namespace ng169\control\shop;

use ng169\control\shopbase;


checktop();
class comment extends shopbase{

	public
	function control_run(){
		$where['muid']=$this->get_muid(1);
		$info=T('merchant')->join_table(array('t'=>'user','uid','uid'))->set_where(array('muid'=>$where['muid'],'rzflag'=>array(1,2)),'=')->get_one();
		if(!$info){
			error('ID错误');
		}
		$this->seoadd('信用评价 - '.$info['merchantname'],$info['licence'],$info['intro']);
	
		$plist=T('product_comment')->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'product','productid','productid'),1)->set_limit(15)->order_by(array('f'=>'cmtime','s'=>'down'))->get_all($where);
		$week['muid']=$where['muid'];
		$week['cmtime']=array(time()-7*G_DAY,time());
		$week['cmlevel']=1;
		$com['week']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['week']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['week']['center']=T('product_comment')->get_count($week);
		$week['cmtime']=array(time()-31*G_DAY,time());
		$week['cmlevel']=1;
		$com['mouth']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['mouth']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['mouth']['center']=T('product_comment')->get_count($week);
		$week['cmtime']=array(time()-31*6*G_DAY,time());
		$week['cmlevel']=1;
		$com['smouth']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['smouth']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['smouth']['center']=T('product_comment')->get_count($week);
		$week['cmtime']=array(0,time()-31*6*G_DAY);
		$week['cmlevel']=1;
		$com['bsmouth']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['bsmouth']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['bsmouth']['center']=T('product_comment')->get_count($week);
		
		$model     = T('product_comment')->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'order_product','ordernum','ordernum'),1)->set_where(array('muid'=>$this->get_muid(1)))->order_by(array('s'=>'down','f'=>'cmtime'));
		$page      = $this->make_page($model);
		$datalist      = $model->set_limit($this->get_page_limit())->get_all();

		$this->view(null,array('data'=>$info,'comment'=>$plist,'commentnum'=>$com,'datalist'=>$datalist,'page'=>$page));

	}
	public
	function control_other(){
		$where['muid']=$this->get_muid(1);
		$info=T('merchant')->join_table(array('t'=>'user','uid','uid'))->set_where(array('muid'=>$where['muid'],'rzflag'=>array(1,2)),'=')->get_one();
		if(!$info){
			error('ID错误');
		}
		$this->seoadd('信用评价 - '.$info['merchantname'],$info['licence'],$info['intro']);
	
		$plist=T('product_comment')->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'product','productid','productid'),1)->set_limit(15)->order_by(array('f'=>'cmtime','s'=>'down'))->get_all($where);
		$week['muid']=$where['muid'];
		$week['cmtime']=array(time()-7*G_DAY,time());
		$week['cmlevel']=1;
		$com['week']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['week']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['week']['center']=T('product_comment')->get_count($week);
		$week['cmtime']=array(time()-31*G_DAY,time());
		$week['cmlevel']=1;
		$com['mouth']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['mouth']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['mouth']['center']=T('product_comment')->get_count($week);
		$week['cmtime']=array(time()-31*6*G_DAY,time());
		$week['cmlevel']=1;
		$com['smouth']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['smouth']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['smouth']['center']=T('product_comment')->get_count($week);
		$week['cmtime']=array(0,time()-31*6*G_DAY);
		$week['cmlevel']=1;
		$com['bsmouth']['good']=T('product_comment')->get_count($week);
		$week['cmlevel']=2;
		$com['bsmouth']['bad']=T('product_comment')->get_count($week);
		$week['cmlevel']=0;
		$com['bsmouth']['center']=T('product_comment')->get_count($week);
		
		$model     = T('comment_user')->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'order_product','ordernum','ordernum'),1)->set_where(array('muid'=>$this->get_muid(1)))->order_by(array('s'=>'down','f'=>'cmtime'));
		$page      = $this->make_page($model);
		$datalist      = $model->set_limit($this->get_page_limit())->get_all();

		$this->view(null,array('data'=>$info,'comment'=>$plist,'commentnum'=>$com,'datalist'=>$datalist,'page'=>$page));

	}
	public function control_del(){
	$get=get(array('int'=>array('commid'=>1)));
	$get['muid']=$this->get_muid(1);
	$info=T('comment_user')->get_one($get);
	if(!$info)error('评论不存在');
	if($info['cmlevel']!=2)error('非差评不可操作');
	if((time()-$info['cmtime'])>(Y::$conf['comment_del_day']*G_DAY))error('操作'.Y::$conf['comment_del_day'].'日的评价不能操作');
	T('comment_user')->del($get);
	$uwhere=array('uid'=>$info['uid']);
	$user=T('user')->get_one($uwhere);
	if($user){
	$ubad=($user['ubad']-1)>0?($user['ubad']-1):0;
	T('user')->update(array('ubad'=>$ubad),$uwhere);
	}
	out('评论删除成功',geturl(null,'other'));
}
}
?>
