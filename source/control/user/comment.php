<?php





checktop();
class control extends userbase{

	public
	function control_run(){
		

		$where['uid']=$this->get_userid(1);
		/*set_time_limit(1000000);   
		$i=0;
		while($i<1000000){
			$i++;
			$add['ordernum']='17042815192532562';
			$add['uid']='425';
			$add['cmcontent']='test';
			$add['cmtime']=time();
			$add['muid']=96;
			$add['cmlevel']=rand(0,2);
			
			
		
			T('comment_user')->add($add);
		}
		return 1;*/
	
		$count=M('ucomment','im')->getcountlist($this->get_userid(1));
		
		
		
		$model     = T('comment_user')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'order','ordernum','ordernum'),1)->set_where(array('uid'=>$this->get_userid(1)))->order_by(array('s'=>'down','f'=>'commid'));
		
		$page      = $this->make_page($model);
		$datalist      = $model->set_limit($this->get_page_limit())->get_all();
	

		$this->view(null,array('data'=>$info,'comment'=>$plist,'commentnum'=>$count,'datalist'=>$datalist,'page'=>$page));

	}
	public
	function control_other(){
		$where['uid']=$this->get_userid(1);
		
		$this->seoadd('信用评价 - '.$info['merchantname'],$info['licence'],$info['intro']);
	
		
		$count=M('ucomment','im')->getcountlist($this->get_userid(1));
		$model     = T('product_comment')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'order_product','productid','productid'),1)->order_by(array('s'=>'down','f'=>'cmtime'));
		$page      = $this->make_page($model);
		$datalist      = $model->set_limit($this->get_page_limit())->get_all();

		$this->view(null,array('data'=>$info,'comment'=>$plist,'commentnum'=>$count,'datalist'=>$datalist,'page'=>$page));

	}
	public function control_del(){
	$get=get(array('int'=>array('commid'=>1)));
	$get['uid']=$this->get_userid(1);
	$info=T('product_comment')->get_one($get);
	if(!$info)error('评论不存在');
	if($info['cmlevel']!=2)error('非差评不可操作');
	if((time()-$info['cmtime'])>(Y::$conf['comment_del_day']*G_DAY))error('操作'.Y::$conf['comment_del_day'].'日的评价不能操作');
	T('product_comment')->del($get);
	$uwhere=array('muid'=>$info['muid']);
	$user=T('merchant')->get_one($uwhere);
	if($user){
	$ubad=($user['bad']-1)>0?($user['bad']-1):0;
	T('merchant')->update(array('bad'=>$ubad),$uwhere);
	}
	out('评论删除成功',geturl(null,'other'));
}
}
?>
