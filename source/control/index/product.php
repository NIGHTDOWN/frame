<?php


namespace ng169\control\index;
use ng169\control\indexbase;
use ng169\Y;


checktop();

class product extends indexbase
{
	public function control_run()
	{
		// $this->vlog($this->get_userid());
		// $this->view(null,$array);
		gourl(geturl(null,'category','product'));
	}

	public function control_list()
	{

		$w = get(array('int'=>array('id'=>1)));

		$where = array('muid'=>$w['id']);
		$this->vlog($this->get_userid(),($get['id']));
		$shopinfo = $where;
		$shopinfo['rzflag'] = array(1,2);
		$info = T('merchant')->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'merchant_count','muid','muid'),1)->get_one($shopinfo);

		if(!$info)
		{
			error('ID错误');
		}
		if($info['storeflag'])
		{
			error('店铺关闭');
		}
		$this->seoadd('商品列表 - ' .$info['merchantname'],$info['licence'],$info['intro']);
		$where['shelves'] = 1;
		$where['status'] = 0;
		$where['pflag'] = 1;
		$get = get(array('string'=>array('word'),'int'   =>array('price1','price2','scatid')));
		
		if($get['price1'])
		{
			$where['price'] = array($get['price1']);
		}
		if($get['price2'])
		{
			$where['price'] = array('1'=>$get['price2']);
		}

		$model = T('product')->order_by(array('f'=>'productid','s'=>'down'))->set_where($where);
		if($get['scatid'])
		{
			$catid = M('scategory','im')->getallcatid($get['scatid']);
			if(is_array($catid))
			{
				$str   = implode(',',$catid);
				$str   = 'scatid in('.$str.')';
				$model = $model->set_where($str);
			}

		}
		if($get['word'])
		{
			
			$model = $model->search('productname',tohex($get['word']));
		}
		$page  = $this->make_page($model,4,12);
		$model = $this->init_order($model);
		
		
		$data  = $model->set_limit($this->get_page_limit())->get_all();
		$where2['id'] = $info['muid'];
		$where2['word'] = $get['word'];
		$where2['price1'] = $get['price1'];
		$where2['price2'] = $get['price2'];

		if(is_array($this->orderby) && $this->orderby['s'] == 'down')
		{
			$by = 'up';
		}
		else
		{
			$by = 'down';
		}
		$this->vlog($this->get_userid());
		$this->view(null,array('data' =>$info,'plist'=>$data,'page' =>$page,'where'=>$where2,'by'   =>$by));
	}

	public function control_category()
	{
		
		$w = get(array('int'=>array('catid')));
		$this->vlog($this->get_userid());
		$pcat = null;
		if(isset($w['catid']))
		{

			$p = M('tree','am')->getptree('product_category_tree',$w['catid']);

			$c = M('tree','am')->getctree('product_category_tree',$w['catid']);

			if(is_array($c))
			{
				array_push($c,$w['catid']);

			}
			else
			{
				$c = array($w['catid']);
			}


			$pcat = T('product_category')->set_field('catid,catname')->set_where('catid in('.implode(',',$p).')')->get_all();
			$ccat = T('product_category')->set_field('catid,catname')->set_where(array('parentid'=>$w['catid']),'=')->get_all();

			$attribute = T('product_category_attribute')->order_by(array('f'=>'orders','s'=>'up'))->set_where(array('catid'   =>$w['catid'],'type'    =>0,'htmltype'=>1),'=')->order_by(array('s'=>'up','f'=>'weight'))->set_limit(5)->get_all();

		}
		else
		{
			$ccat = T('product_category')->set_field('catid,catname')->set_where(array('parentid'=>0),'=')->get_all();

		}



		$thisnum = sizeof($pcat) - 1;
		if($thisnum <= 0)
		{
			
			$this->seoadd('所有商品 - ' .Y::$conf['site_name']);
		}
		else
		{
			$this->seoadd($pcat[$thisnum]['catname'] ,$pcat[$thisnum]['metakeyword'],$ccat[$thisnum]['metadesc']);
		}

		$where['shelves'] = 1;
		$where['status'] = 0;
		$where['pflag'] = 1;
		$where2 = $where;
		/*$where['storeflag']=0;*/
		$get    = get(array('string'=>array('word'),'int'   =>array('price1','price2')));
		
		if(isset($get['price1']))
		{
			$where['price'] = array($get['price1']);
		}
		if(isset($get['price2']))
		{
			$where['price'] = array('1'=>$get['price2']);
		}
		/*$where['avalue']=$searchattr;*/
		$insert['address']='';
//		$insert['address'] = $address['province'].$address['city'].$address['area'].$address['address'];


		if(isset($province['provinceid']) && $province['provinceid'] != '0')
		{
			$where['merchant.provinceid'] = $province['provinceid'];
			$wstring = $wstring.',provinceid:'.$province['provinceid'];
		}

		$attr = get(array('string'=>array('att1','att2','att3','att4','att5')));
		$model = T('product')->set_field('v.*,merchantname')->order_by(array('f'=>'productid','s'=>'down'))->set_global_where($where)->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'product_attr','productid','productid'),1);
		foreach($attr as $v=>$list){
			if($list=='null'){
				unset($attr[$v]);
			}
		}
		$model = $model->set_where($attr,'=');
		if(isset($c))
		{

			$model = $model->set_where('v.catid in('.implode(',',$c).')');
		}
		if(isset($get['word']))
		{
			$word = tohex($get['word']);
			$model = $model->set_where("match(productname) against ('*{$word}*' IN BOOLEAN MODE)");
		}


			$hot=T('product')->join_table(array('t'=>'merchant','muid','muid'))->set_where($where)->order_by(array('f'=>'sells','s'=>'down'))->set_limit(6)->get_all();


	
		$page=$this->make_page($model);
		$model->order_by(array('s'=>'down','f'=>'collects'));
		$model= $this->init_order($model);
	

		$data = $model->set_limit($this->get_page_limit())->get_all();

		$where2['id'] = isset($w['catid'])?$w['catid']:'';
		$where2['word'] = isset($get['word'])?$get['word']:'';
		$where2['price1'] = isset($get['price1'])?$get['price1']:'';
		$where2['price2'] = isset($get['price2'])?$get['price2']:'';

		if(is_array($this->orderby) && isset($this->orderby['s'])&&  $this->orderby['s'] == 'down')
		{
			$by = 'up';
			$attrwhere['by']=$by;
		}
		else
		{
			$by = 'down';
			$attrwhere['by']=$by;
		}
		$attrwhere=$attr;
		$attrwhere['catid']=isset($w['catid'])?$w['catid']:'';
		
		if(isset($this->orderby['s']) && isset($this->orderby['f'])){
			$attrwhere[$this->orderby['s']]=$this->orderby['f'];
		}
		
		$byattr=$attrwhere;
		unset($byattr['up']);
		unset($byattr['down']);
		$data = array('pcat'       =>$pcat,'ccat'       =>$ccat,'data'       =>$data,'page'       =>$page,'where'      =>$where2,'by'         =>$by,'attribute'  =>@$attribute,'attrwhere'  =>$attrwhere,'byattr'=>$byattr,'hot'        =>$hot);

		$this->view(null,$data);
	}
	public function control_collect()
	{
		$get = get(array('int'=>array('productid'=>1)));
		$info = T('product')->get_one($get);
		if($info['muid'] == $this->get_muid())
		{
			error('不能收藏自己的商品');
		}
		$insert['uid'] = $this->get_userid();
		$insert['productid'] = $get['productid'];
		$isexiset = T('collect_product')->get_one($insert);
		if($isexiset)
		{
			error('该商品已经收藏');
		}
		$insert['oldprice'] = $isexiset['price'];
		$insert['addtime'] = time();
		$f = T('collect_product')->add($insert);
		if($f)
		{
			T('product')->update(array('collects'=>$info['collcets'] + 1),array('productid'=>$info['productid']));
			M('ucount','im')->addcollect($this->get_userid());
			out('收藏成功');
		}
		error('收藏失败');
	}
	public function control_like()
	{
		$get = get(array('int'=>array('productid'=>1)));
		$info = T('product')->get_one($get);
		if($info['muid'] == $this->get_muid())
		{
			error('不能喜欢自己的商品');
		}
		$insert['ip'] = YRequest::getip();
		$insert['productid'] = $get['productid'];
		$isexiset = T('like_product')->get_one($insert);
		if($isexiset)
		{
			error('该商品已经喜欢');
		}
		$insert['oldprice'] = $isexiset['price'];
		$insert['addtime'] = time();
		$f = T('like_product')->add($insert);
		if($f)
		{
			T('product')->update(array('likes'=>$info['likes'] + 1),array('productid'=>$info['productid']));
			out('成功');
		}
		error('失败');
	}
	public function control_detail()
	{
		//流量记录日志；更新用户足记表，更新产品表
		$day = date('ym');

		$get = get(array('int'=>array('productid'=>1)));
		$this->vlog($this->get_userid(),M('vlog','im')->getpromuid($get['productid']),$get['productid']);
		$info = T('product')->set_field('*')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->get_one($get);
		
		if(!$info)
		{
			YOut::page404();error('产品不存在');
		}
		if($info['storeflag'])
		{
			YOut::page404();error('产品不存在');
		}
		if($this->get_muid() != $info['muid'])
		{
			if($info['pflag'] != 1)
			{
				YOut::page404();error('产品未审核');
			}
			if($info['shelves'] != 1)
			{
				YOut::page404();error('产品未上架');
			}
			if($info['status'] != 0)
			{
				YOut::page404();error('产品未上架');
			}

		}
		$group = T('groupon')->order_by(array('f'=>'gpid','s'=>'down'))->get_one(array('pid'   =>$info['productid'],'gcheck'=>1));

		if($group && $group['getime'] < time())
		{
			T('groupon')->update(array('gcheck'=>3),array('gpid'=>$group['gpid']));
			$groupflag=false;
		}
		elseif($group)
		{
			T('groupon')->update(array('ghits'=>$info['ghits'] + 1),array('gpid'=>$info['gpid']));
			$info = array_merge($info,$group);
			$groupflag=true;

		}
		$attribute = T('product_attribute')->get_all(array('productid'=>$info['productid']));
		$spec = T('product_specs')->order_by(array('s'=>'up','f'=>'id'))->get_all(array('productid'=>$info['productid']));
		$w = array('melite' =>1,'muid'   =>$info['muid'],'pflag'  =>1,'shelves'=>1);
		
		$hot = T('product')->set_limit(8)->order_by(array('f'=>array('collects'),'s'=>'down'))->get_all($w);
		
		$other = T('product')->set_limit(4)->order_by(array('f'=>array('sells'),'s'=>'down'))->get_all($w);
		
		$log = M('plog','im')->logp($info['productid']);
		if($log)
		{
			T('product')->update(array('hits'=>$info['hits'] + 1),array('productid'=>$info['productid']));

		}
		
		$array = array('data'     =>$info,'spec'     =>$spec,'attribute'=>$attribute,'hot'      =>$hot,'other'    =>$other,'group'=>$groupflag);
		$this->seoset($info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],$info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],Y::$conf['site_name'].' - ' .$info['merchantname'].' - '.$info['productname']);
if($groupflag){
	$this->view('purchase_detail',$array);
}else{
	$this->view(null,$array);
}
		


	}
	public function control_backdetail()
	{
		//流量记录日志；更新用户足记表，更新产品表
		$day = date('ym');

		$get = get(array('int'=>array('bid'=>1)));
		$info = T('back_product')->join_table(array('t'=>'merchant','muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->join_table(array('t'=>'order_product','bid','bid'),1)->get_one($get);
		if(!$info)
		{
			YOut::page404();error('快照不存在');
		}
		$order = T('order')->get_one(array('ordernum'=>$info['ordernum']));
		if(!parent::$wrap_admin['adminid'])
		{
			if($this->get_userid() != $order['uid'] && $this->get_muid() != $info['muid'])
			{
				error('对不起，你无权查看该宝贝的交易信息');
			}
		}

		/*	if($this->get_muid()!=$info['muid']){
		if($info['pflag']!=1){YOut::page404();error('产品未审核');}
		if($info['shelves']!=1){YOut::page404();error('产品未上架');}
		}*/

		$attribute = T('back_product_attribute')->get_all(array('bid'=>$info['bid']));
		/*$spec=T('product_specs')->order_by(array('s'=>'up','f'=>'id'))->get_all(array('productid'=>$info['productid']));*/
		$w = array('melite' =>1,'muid'   =>$info['muid'],'pflag'  =>1,'shelves'=>1);
		$hot = T('product')->set_limit(8)->order_by(array('f'=>array('hits','zans'),'s'=>'down'))->get_all($w);
		$other = T('product')->set_limit(4)->order_by(array('f'=>array('sells','hits','zans'),'s'=>'down'))->get_all($w);

		$array = array('data'     =>$info,'spec'     =>$spec,'attribute'=>$attribute,'hot'      =>$hot,'other'    =>$other);
		$this->seoset('【商品快照】'.$info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],$info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],Y::$conf['site_name'].' - ' .$info['merchantname'].' - '.$info['productname']);

		$this->view(null,$array);

	}
	public function control_qr()
	{
		$get = get(array('string'=>array('productid'=>1)));
		$url = geturl($get,'detail','product','index');
		M('qr','im')->get($url);
	}

}
?>
