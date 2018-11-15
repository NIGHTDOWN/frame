<?php

namespace ng169\control\index;
use ng169\control\indexbase;




checktop();

class cat extends indexbase{
	public function control_run(){
		$this->vlog($this->get_userid());
		$uid=$this->get_userid(1);
		M('cart','im')->check($uid);
		$model1=T('cart')->set_field('yhtype,old,cid,productname,v.addtime,price,specs,v.productid,smallimg1,nums,originalprice,pflag,product.status,shelves,count,nowprice,product.muid,merchantname,merchant.phone')->join_table(array('t'=>'product','v.productid','productid'),1)->join_table(array('t'=>'merchant','product.muid','muid'),1)->order_by(array('s'=>'down','f'=>'v.muid,old,v.addtime'))->set_global_where(array('uid'=>$uid))->get_all();
		/*$model2=T('cart')->set_field('cid,productname,v.addtime,gprice as price,gcheck,specs,v.productid,smallimg1,nums,originalprice,pflag,product.status,shelves,count,nowprice,product.muid,merchantname,merchant.phone')->join_table(array('t'=>'product','v.productid','productid'),1)->join_table(array('t'=>'groupon','v.yhtype','gpid'),1)->join_table(array('t'=>'merchant','product.muid','muid'),1)->order_by(array('s'=>'down','f'=>'v.muid,v.addtime'))->set_global_where(array('uid'=>$uid,'yhtype'=>1))->get_sql();
		
		$sql="($model1) union all ($model2) order by addtime DESC";*/
		
		
		
		
	/*	$data=T('cart')->get_all(null,null,null,$sql);*/
	   /* $page      = $this->make_page($model);
		$data      = $model->set_limit($this->get_page_limit())->get_all();*/
		/*$data=array_merge($model2,$model1);*/
		$var_array = array('data'  =>$model1,'page'=>$page);

		
		$this->view(null,$var_array);
	}
	public function control_addnum(){
		$get=get(array('int'=>array('cid'=>1)));
		$get['uid']=$this->get_userid(1);
		$get2=get(array('int'=>array('nums'=>1)));
		/*$get['shelves']=1;
		$get['status']=0;
		$get['pflag']=1;*/
		if($get2['nums']<=0)error('数量不正确');
		$model=T('cart')->join_table(array('t'=>'product','v.productid','productid'),1)->get_one($get);
		if(!$model)error('记录不存在');
		if($model['old']!=0)error('失效');
		if($model['shelves']!=1)error('商品已下架');
		if($model['status']!=0)error('商品不存在');
		if($model['pflag']!=1)error('商品未审核');
		if($get2['nums']>$model['count']){
			error('库存不足');
		}
		T('cart')->update($get2,$get);
		out($get2['nums']*$model['nowprice']);
	   
		
		$this->view(null,$var_array);
	}
	public function control_del()
    {

        $w = array('product_id' => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $where2['cid']=$where['product_id'];
	$where2['uid']=$this->get_userid(1);
     
        $model = T('cart')->del($where2);
       M('ucount','im')->delcart($this->get_userid(1),sizeof($where2['cid']));
        out('删除成功');
    }   
}
?>
