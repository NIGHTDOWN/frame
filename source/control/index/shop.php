<?php

namespace ng169\control\index;
use ng169\control\indexbase;




checktop();

class shop extends indexbase{
	public function control_collect(){
		
		if(!$this->get_userid()){
			error('请登入');
		}
		$get=get(array('int'=>array('muid'=>1)));
		$get['rzflag']=array(1,2);
		$info=T('merchant')->get_one($get);
		
		/*seo_init();*/
		if(!$info){
			error('ID错误');
		}
		if($get['muid']==$this->get_muid()){
			error('不能收藏自己的店铺');
		}
		$insert['uid']=$this->get_userid();
		$insert['muid']=$get['muid'];
		$isexiset=T('collect_shop')->get_one($insert);
		if($isexiset){
			error('该店铺已经收藏');
		}
		/* $insert['oldprice']=$isexiset['price'];*/
		$insert['addtime']=time();
		$f=T('collect_shop')->add($insert);
		if($f){
			T('merchant')->update(array('scollects'=>$info['scollects']+1),array('muid'=>$info['muid']));
			out('收藏成功');
		}
		error('收藏失败');
	}
	public function control_show(){
	
		$get=get(array('int'=>array('id'=>1)));
		$where['muid']=$get['id'];
		$this->vlog($this->get_userid(),$get['id']);
		$info=T('merchant')->join_table(array('t'=>'user','uid','uid'))->set_where(array('muid'=>$where['muid']),'=')->get_one();
	
		if(!$info){
			error('ID错误');
		}
		if($info['rzflag']==0){
			error('店铺未认证');
		}
		if($info['storeflag']){
			error('店铺关闭');
		}
		$this->seoadd('首页 - '.$info['merchantname'],$info['licence'],$info['intro']);
		
		$where['melite']=1;
		$where['shelves']=1;
		$where['status']=0;
		$where['pflag']=1;
		
		$plist=T('product')->set_limit(8)->order_by(array('f'=>'sells','s'=>'down'))->get_all($where);
		unset($where['melite']);
		$hotplist=T('product')->set_limit(8)->order_by(array('f'=>'collects','s'=>'down'))->get_all($where);
		$this->view(null,array('data'=>$info,'plist'=>$plist,'hot'=>$hotplist));
		
		
	}
	public function control_purchase(){
    
		$w=get(array('int'=>array('id'=>1)));
		$where=array('muid'=>$w['id']);
		$shopinfo=$where;
		$shopinfo['rzflag']=array(1,2);
		$info=T('merchant')->join_table(array('t'=>'user','uid','uid'))->get_one($shopinfo);
		
		if(!$info){
			error('ID错误');
		}
		if($info['storeflag']){
			error('店铺关闭');
		}
		$this->seoadd('商品列表 - ' .$info['merchantname'],$info['licence'],$info['intro']);
		$where['shelves']=1;
		$where['status']=0;
		$where['pflag']=1;
		$where['gcheck']=1;
		$get=get(array('string'=>array('word'),'int'=>array('price1','price2')));
		if($get['word']){
			$where['productname']=$get['word'];
		}
		if($get['price1']){
			$where['price']=array($get['price1']);
		}
		if($get['price2']){
			$where['price']=array('1'=>$get['price2']);
		}
		$model=T('groupon')
		->join_table(array('t'=>'product','pid','productid'))
		->order_by(array('f'=>'product.productid','s'=>'down'))
		->join_table(array('t'=>'product_attribute','product.productid','productid'),1)->group_by('v.pid');
		
		$model=$model->set_where($where);
		$model     = $this->init_order($model);
		$page      = $this->make_page($model,4,4);
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		$where2['id']=$info['muid'];
		$where2['word']=$get['word'];
		$where2['price1']=$get['price1'];
		$where2['price2']=$get['price2'];
		
		if(is_array($this->orderby) && $this->orderby['s']=='down'){
			$by='up';
		}else{
			$by='down';
		}
		
		$this->view(null,array('data'=>$info,'plist'=>$data,'page'=>$page,'where'=>$where2,'by'=>$by));
	}
public function control_comment(){
	
	
	
	
	
	
	
	
	
	
	
	
	
		$get=get(array('int'=>array('id'=>1)));
		$where['muid']=$get['id'];
		$this->vlog($this->get_userid(),$get['id']);
		$info=T('merchant')->join_table(array('t'=>'user','uid','uid'))->set_where(array('muid'=>$where['muid'],'rzflag'=>array(1,2)),'=')->get_one();
		if(!$info){
			error('ID错误');
		}
		$this->seoadd('信用评价 - '.$info['merchantname'],$info['licence'],$info['intro']);
	
		$plist=T('product_comment')->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'product','productid','productid'),1)->set_limit(15)->order_by(array('f'=>'cmtime','s'=>'down'))->get_all($where);
		
		$com=M('mcomment','im')->getcountlist($where['muid']);
		/*$week['cmtime']=array(time()-7*G_DAY,time());
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
		$com['bsmouth']['center']=T('product_comment')->get_count($week);*/
		$this->view(null,array('data'=>$info,'comment'=>$plist,'commentnum'=>$com));
		
		
	}
public function control_intro(){
		$get=get(array('int'=>array('id'=>1)));
		$where['muid']=$get['id'];
		$this->vlog($this->get_userid(),$get['id']);
		$where['rzflag']=array(1,2);
		$info=T('merchant')->join_table(array('t'=>'user','uid','uid'))->get_one($where);
		if(!$info){
			error('ID错误');
		}
		if($info['storeflag']){
			error('店铺关闭');
		}
		$this->seoadd('店铺简介 - '.$info['merchantname'],$info['licence'],$info['intro']);
	
		$this->view(null,array('data'=>$info,'plist'=>$plist,'hot'=>$hotplist));
		
		
	}
	public function control_run(){
		$get=get(array('string'=>array('word')));
		$w=get(array('int'=>array('catid')));
		$this->vlog($this->get_userid());
		$wstring='catid:'.$w['catid'].',word:'.$get['word'];
		$where['rzflag']=array(1,2);
		$where['catid']=$w['catid'];
		$province=get(array('int'=>array('provinceid')));

		if($province['provinceid'] && $province['provinceid']!='0'){
		$where['provinceid']=$province['provinceid'];
		$wstring=$wstring.',provinceid:'.$province['provinceid'];
		}
		$model=T('merchant')->set_field('v.*,username,catname')->order_by(array('f'=>'muid','s'=>'down'))->set_global_where($where)->join_table(array('t'=>'merchant_category','catid','catid'),1)->join_table(array('t'=>'user','uid','uid'),1)->set_where($where);
		$model     = $this->init_order($model);
		$page=$this->make_page($model);
		/*d($this->get_page_limit());*/
		
		$catinfo=T('merchant_category')->set_where(array('catid'=>$w['catid']),'=')->get_one();
		if($get['word']){
			$word=$get['word'];
			$model=$model->set_where(array('catname'=>$word,'metakeyword'=>$word,'merchantname'=>$word,'licence'=>$word),null,1,'or');
			
			$this->seoadd($get['word'].' - '.Y::$conf['site_name'].'搜索' ,$catinfo['metakeyword'],$catinfo['metadesc']);
		}else{
			$this->seoadd($catinfo['catname'],$catinfo['metakeyword'],$catinfo['metadesc']);
		}
		$data      = $model->set_limit($this->get_page_limit())->get_all();
		if(is_array($this->orderby) && $this->orderby['s']=='down'){
			$by='up';
		}else{
			$by='down';
		}
		$hot=$model->set_limit(10)->get_all();
		$cat=T('merchant_category')->order_by(array('s'=>'down','f'=>'orders'))->set_field('catid,catname')->get_all(array('flag'=>0));
		
	/*	$this->view('shop_cat',array('cat'=>$cat),null,1);*/
		$this->view('',array('cat'=>$cat,'data'=>$data,'page'=>$page,'where'=>$where2,'by'=>$by,'wherestring'=>$wstring,'hot'=>$hot,'word'=>$get['word']));
		
		
	}
	public function control_qr(){
		$get=get(array('string'=>array('id'=>1)));
		$url=geturl($get,'show','shop','index');
		M('qr','im')->get($url);
	}

	public function control_search(){
		$get=get(array('int'=>array('id'=>1)),array('id'=>'ID'));
		$info=T('shop_category')->get_all(array('muid'=>$get['id'],'depth'=>0));
		$this->vlog($this->get_userid(),$get['id']);
		$this->seoadd('店铺搜索 - '.$info['merchantname'],$info['licence'],$info['intro']);
	
		$this->view(null,array('data'=>$info,'get'=>$get));
	}

}

?>
