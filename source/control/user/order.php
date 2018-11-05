<?php checktop();
class control extends userbase
{
    public function control_applytk()
    {}
    public function control_comment()
    {
        $get = get(array('string' => array('oid' => 1)));
        gourl(geturl($get, 'shop', 'comment', 'index'));
    }
    public function control_sure()
    {
        $get1 = get(array('string' => array('oid' => 1)));
        $f = M('order',
            'im')->usersure($get1['oid']);
        if ($f) {
            out('亲，交易完成；赏个评价吧。',
                geturl(array('oid' => $get1['oid']),
                    'comment'));
        }

        error('确认失败');
    }
    public function control_run()
    {
        $c = D_MEDTHOD;
        $a = D_FUNC;
        /*$this->page_size=15;*/
        $get=get(array('string'=>array('productname','merchantname')));
        if($get['productname'] ){
			$ordernum=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->set_field('v.ordernum')->set_where('v.uid='.$this->get_userid(1))->search('productname',tohex($get['productname']))->group_by('v.ordernum')->get_all();
			foreach($ordernum as $v){
				$z.=$v['ordernum'].',';
			}
			$sera=trim($z,',');
			if($sera){
				$ww="ordernum in ($sera)";
			}
		}
        
        $model = T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('*,merchantname')->set_where(array('uid' => $this->get_userid(1)))->set_global_where(array('delflag' => 0));
        $model = $this->init_where($model);
        if($ww){
			$model=$model->set_where($ww);
		}
         $page = $this->make_page($model,4,10);
        $model = $model->order_by(array('s' => 'down',
            'f' => 'orderid'));
        
       
       
        $data = $model->set_limit($this->get_page_limit())->get_all();
        foreach ($data as $k => $v) {
            $nums = T('order_product')->set_field(('sum(num) as totalnums'))->order_by(array('f' => 'id',
                's' => 'down'))->get_one(array('ordernum' => $v['ordernum']));
            $data[$k]['productcount'] = $nums['totalnums'];
            
            $data[$k]['productlist'] = T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t' => 'product',
                'v.productid',
                'productid'),
                1)->order_by(array('f' => 'id',
                's' => 'down'))->join_table(array('t' => 'merchant',
                'muid',
                'muid'),
                1)->get_all(array('ordernum' => $v['ordernum']));
             $data[$k]['prorow'] = sizeof($data[$k]['productlist']);
        }
        $var_array = array('data' => $data,
            'page' => $page,'get'=>$get);
        $this->view(null,
            $var_array);
    }
    public function control_waitpay()
    {$c = D_MEDTHOD;
        $a = D_FUNC;
        /*$this->page_size=15;*/
        $get=get(array('string'=>array('productname','merchantname')));
        if($get['productname'] ){
			$ordernum=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->set_field('v.ordernum')->set_where('v.uid='.$this->get_userid(1))->search('productname',tohex($get['productname']))->group_by('v.ordernum')->get_all();
			foreach($ordernum as $v){
				$z.=$v['ordernum'].',';
			}
			$sera=trim($z,',');
			if($sera){
				$ww="ordernum in ($sera)";
			}
		}
        
        $model = T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('*,merchantname')->set_where(array('uid' => $this->get_userid(1)))->set_global_where(array('delflag' => 0,'status' => 0,
            'payflag' => 0));
        $model = $this->init_where($model);
        if($ww){
			$model=$model->set_where($ww);
		}
         $page = $this->make_page($model,4,10);
        $model = $model->order_by(array('s' => 'down',
            'f' => 'orderid'));
        
       
       
        $data = $model->set_limit($this->get_page_limit())->get_all();
        foreach ($data as $k => $v) {
            $nums = T('order_product')->set_field(('sum(num) as totalnums'))->order_by(array('f' => 'id',
                's' => 'down'))->get_one(array('ordernum' => $v['ordernum']));
            $data[$k]['productcount'] = $nums['totalnums'];
            
            $data[$k]['productlist'] = T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t' => 'product',
                'v.productid',
                'productid'),
                1)->order_by(array('f' => 'id',
                's' => 'down'))->join_table(array('t' => 'merchant',
                'muid',
                'muid'),
                1)->get_all(array('ordernum' => $v['ordernum']));
             $data[$k]['prorow'] = sizeof($data[$k]['productlist']);
        }
        $var_array = array('data' => $data,
            'page' => $page,'get'=>$get);
    	
    	
    	
       
        $this->view('order_index',
            $var_array);
    }
public function control_waitsure()
    {$c = D_MEDTHOD;
        $a = D_FUNC;
        /*$this->page_size=15;*/
        $get=get(array('string'=>array('productname','merchantname')));
        if($get['productname'] ){
			$ordernum=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->set_field('v.ordernum')->set_where('v.uid='.$this->get_userid(1))->search('productname',tohex($get['productname']))->group_by('v.ordernum')->get_all();
			foreach($ordernum as $v){
				$z.=$v['ordernum'].',';
			}
			$sera=trim($z,',');
			if($sera){
				$ww="ordernum in ($sera)";
			}
		}
        
        $model = T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('*,merchantname')->set_where(array('uid' => $this->get_userid(1)))->set_global_where(array('delflag' => 0,'status' => 2,
            'sure' => 0));
        $model = $this->init_where($model);
        if($ww){
			$model=$model->set_where($ww);
		}
         $page = $this->make_page($model,4,10);
        $model = $model->order_by(array('s' => 'down',
            'f' => 'orderid'));
        
       
       
        $data = $model->set_limit($this->get_page_limit())->get_all();
        foreach ($data as $k => $v) {
            $nums = T('order_product')->set_field(('sum(num) as totalnums'))->order_by(array('f' => 'id',
                's' => 'down'))->get_one(array('ordernum' => $v['ordernum']));
            $data[$k]['productcount'] = $nums['totalnums'];
            
            $data[$k]['productlist'] = T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t' => 'product',
                'v.productid',
                'productid'),
                1)->order_by(array('f' => 'id',
                's' => 'down'))->join_table(array('t' => 'merchant',
                'muid',
                'muid'),
                1)->get_all(array('ordernum' => $v['ordernum']));
             $data[$k]['prorow'] = sizeof($data[$k]['productlist']);
        }
        $var_array = array('data' => $data,
            'page' => $page,'get'=>$get);
    	
    	
    	
       
        $this->view('order_index',
            $var_array);
    }
    public function control_dfh()
    {
       $c = D_MEDTHOD;
        $a = D_FUNC;
        /*$this->page_size=15;*/
        $get=get(array('string'=>array('productname','merchantname')));
        if($get['productname'] ){
			$ordernum=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->set_field('v.ordernum')->set_where('v.uid='.$this->get_userid(1))->search('productname',tohex($get['productname']))->group_by('v.ordernum')->get_all();
			foreach($ordernum as $v){
				$z.=$v['ordernum'].',';
			}
			$sera=trim($z,',');
			if($sera){
				$ww="ordernum in ($sera)";
			}
		}
        
        $model = T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('*,merchantname')->set_where(array('uid' => $this->get_userid(1)))->set_global_where(array('delflag' => 0,'status' => 1,
            'sure' => 0));
        $model = $this->init_where($model);
        if($ww){
			$model=$model->set_where($ww);
		}
         $page = $this->make_page($model,4,10);
        $model = $model->order_by(array('s' => 'down',
            'f' => 'orderid'));
        
       
       
        $data = $model->set_limit($this->get_page_limit())->get_all();
        foreach ($data as $k => $v) {
            $nums = T('order_product')->set_field(('sum(num) as totalnums'))->order_by(array('f' => 'id',
                's' => 'down'))->get_one(array('ordernum' => $v['ordernum']));
            $data[$k]['productcount'] = $nums['totalnums'];
            
            $data[$k]['productlist'] = T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t' => 'product',
                'v.productid',
                'productid'),
                1)->order_by(array('f' => 'id',
                's' => 'down'))->join_table(array('t' => 'merchant',
                'muid',
                'muid'),
                1)->get_all(array('ordernum' => $v['ordernum']));
             $data[$k]['prorow'] = sizeof($data[$k]['productlist']);
        }
        $var_array = array('data' => $data,
            'page' => $page,'get'=>$get);
    	
    	
    	
       
        $this->view('order_index',
            $var_array);
    }
    public function control_waitcomment()
    {
       $c = D_MEDTHOD;
        $a = D_FUNC;
        /*$this->page_size=15;*/
        $get=get(array('string'=>array('productname','merchantname')));
        if($get['productname'] ){
			$ordernum=T('order')->join_table(array('t'=>'order_product','ordernum','ordernum'))->set_field('v.ordernum')->set_where('v.uid='.$this->get_userid(1))->search('productname',tohex($get['productname']))->group_by('v.ordernum')->get_all();
			foreach($ordernum as $v){
				$z.=$v['ordernum'].',';
			}
			$sera=trim($z,',');
			if($sera){
				$ww="ordernum in ($sera)";
			}
		}
        
        $model = T('order')->join_table(array('t'=>'merchant','muid','muid'))->set_field('*,merchantname')->set_where(array('uid' => $this->get_userid(1)))->set_global_where(array('delflag' => 0,'status' => 3,
            'cflag' => 0));
        $model = $this->init_where($model);
        if($ww){
			$model=$model->set_where($ww);
		}
         $page = $this->make_page($model,4,10);
        $model = $model->order_by(array('s' => 'down',
            'f' => 'orderid'));
        
       
       
        $data = $model->set_limit($this->get_page_limit())->get_all();
        foreach ($data as $k => $v) {
            $nums = T('order_product')->set_field(('sum(num) as totalnums'))->order_by(array('f' => 'id',
                's' => 'down'))->get_one(array('ordernum' => $v['ordernum']));
            $data[$k]['productcount'] = $nums['totalnums'];
            
            $data[$k]['productlist'] = T('order_product')->set_field(('v.id,v.productid,v.productname,v.smallimg,v.num,v.bid,v.spec,v.price,merchantname,v.muid,v.tkflag,shflag'))->join_table(array('t' => 'product',
                'v.productid',
                'productid'),
                1)->order_by(array('f' => 'id',
                's' => 'down'))->join_table(array('t' => 'merchant',
                'muid',
                'muid'),
                1)->get_all(array('ordernum' => $v['ordernum']));
             $data[$k]['prorow'] = sizeof($data[$k]['productlist']);
        }
        $var_array = array('data' => $data,
            'page' => $page,'get'=>$get);
    	
    	
    	
       
        $this->view('order_index',
            $var_array);
    }
    public function control_del()
    {
        $w = array('oid' => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $where2['ordernum'] = $where['oid'];
        $where2['delflag'] = 0;
      /*  $where2['status'] = array(3,
            4);*/
        $where2['uid'] = $this->get_userid(1);
        
        $model = T('order')->update(array('delflag' => 1),
            $where2);
        out('删除成功',
            null,
            $model);
    }
    public function control_cancel()
    {
        $w = array('oid' => 1);
        $where = G(array('array' => $w))->get();
        if (sizeof($where) == 0) {
            $where = G(array('int' => $w))->get();
        }
        $where2['ordernum'] = $where['oid'];
        $where2['delflag'] = 0;
        $where2['status'] = 0;
        $where2['uid'] = $this->get_userid(1);
        $model = T('order')->update(array('status' => 4,
            'closetype' => 1),
            $where2);
        if ($model) {
            out('订单已经取消');
        }

        error('订单取消失败');
    }
    public function control_detail()
    {
        $c = D_MEDTHOD;
        $a = D_FUNC;
        $get = get(array('string' => array('oid' => 1)),
            array('oid' => '订单编号'));
        $where['ordernum'] = $get['oid'];
        /*$where['uid']=$this->get_userid(1);*/
        $model = T('order')->join_table(array('t' => ('order_product'),
            'ordernum',
            'ordernum'),
            1)->join_table(array('t' => ('merchant'),
            'order_product.muid',
            'muid'),
            1)->set_field('*,v.*,merchant.phone as sphone,merchant.address as saddress')->set_where(array('uid' => $this->get_userid(1)))->set_where(array('productid' => 0),
            '!=')->set_global_where($where);
        $data = $model->get_one();
        if (!$data) {
            error('订单不存在');
        }

        $data['productlist'] = T('order_product')->order_by(array('f' => 'id',
            's' => 'down'))->get_all(array('ordernum' => $data['ordernum']));
        $var_array = array('data' => $data,
            'page' => $page);
        $this->view(null,
            $var_array);
    }
    public function control_txfh()
    {
       $get=get(array('string'=>array('oid'=>1)),array('oid'=>'订单ID'));
       $where['uid']=$this->get_userid(1);
       $where['ordernum']=$get['oid'];
       $where['status']=1;
       $data=T('order')->get_one($where);
       
       if(!$data)error('目前订单状态无法执行');
       $w2['uid']=$where['uid'];
       $w2['orderid']=$data['orderid'];
       $w2['date']=date('ymdH');
       $tx=T('order_txfh')->get_one($w2);
        if($tx)error('已经发送了提醒;如果商户还未发货;请稍后在发送');
        $w2['addtime']=time();
        T('order_txfh')->add($w2);
        M('msg','am')->txfh($data['ordernum']);
        out('系统已经发送通知了..');
    }
}
