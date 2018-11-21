<?php


namespace ng169\control\index;
use ng169\control\indexbase;
use ng169\Y;


checktop();

class purchase extends indexbase
{
  private $db_name = 'groupon';

  public function control_run()
  {
    $get = get(array('string' => array('word'),'int'    => array('price1','price2')),
    ['word'=>__('团购名称'),'price1'=>__('最低价'),'price2'=>__('最高价')]);  
    $ccat = M('keyword', 'im')->search(@$get['word']);
    $w    = get(array('int' => array('catid')));
    $this->vlog($this->get_userid());
    $pcat = null;

    if (@$w['catid']) {

      $p = M('tree', 'am')->getptree('product_category_tree', $w['catid']);

      $c = M('tree', 'am')->getctree('product_category_tree', $w['catid']);

      if (is_array($c)) {
        array_push($c, $w['catid']);

      }
      else {
        $c = array($w['catid']);
      }

      $pcat = T('product_category')->set_field('catid,catname')->set_where('catid in(' . implode(',', $p) . ')')->get_all();
      $ccat = T('product_category')->set_field('catid,catname')->set_where(array('parentid'=> $w['catid']), '=')->get_all();

      $attribute = T('product_category_attribute')->order_by(array('f'=> 'orders','s'=> 'up'))->set_where(array('catid'   => $w['catid'],'type'    => 0,'htmltype'=> 1), '=')->order_by(array('s'=> 'up','f'=> 'weight'))->set_limit(5)->get_all();

    }
    else {
      $ccat = T('product_category')->set_field('catid,catname')->set_where(array('parentid'=> 0), '=')->get_all();

    }

    $thisnum = sizeof($pcat) - 1;
    if ($thisnum <= 0) {
      $this->seoadd('所有商品 - ' . Y::$conf['site_name']);
    }
    else {
      $this->seoadd($pcat[$thisnum]['catname'], @$pcat[$thisnum]['metakeyword'], @$ccat[$thisnum]['metadesc']);
    }

    $where['shelves'] = 1;
    $where['status'] = 0;
    $where['pflag'] = 1;
    $where['gcheck'] = 1;
    $where['gflag'] = 0;
    /* $where2 = $where;*/
    /*$where['storeflag']=0;*/
    /*$get    = get(array('string'=>array('word'),'int'   =>array('price1','price2')));*/

    if (@$get['price1']) {
      $where['price'] = array($get['price1']);
    }
    if (@$get['price2']) {
      $where['price'] = array('1'=> $get['price2']);
    }
    /*$where['avalue']=$searchattr;*/
    $insert['address'] = @$address['province'] . @$address['city'] . @$address['area'] . @$address['address'];

    if (isset($province['provinceid']) && $province['provinceid'] != '0') {
      $where['merchant.provinceid'] = $province['provinceid'];
      $wstring = $wstring . ',provinceid:' . $province['provinceid'];
    }

    $attr = get(array('string' => array('att1','att2','att3','att4','att5')));
    $model = T($this->db_name)->join_table(array('t'=> 'product','pid','productid'),1)->set_field('v.*,merchantname')->order_by(array('f'=> 'product.productid','s'=> 'down'))->set_global_where($where)->join_table(array('t'=> 'merchant','gmuid','muid'), 1)->join_table(array('t'=> 'product_attr','pid','productid'), 1);

    foreach ($attr as $v => $list) {
      if ($list == 'null') {
        unset($attr[$v]);
      }
    }
    $model = $model->set_where($attr, '=');

    if (isset($c)) {

      $model = $model->set_where('product.catid in(' . implode(',', $c) . ')');
    }
    if (@$get['word']) {
      $word = tohex($get['word']);
      $model= $model->set_where("match(gtitle) against ('*{$word}*' IN BOOLEAN MODE)");
    }

    $hot = T($this->db_name)
    ->join_table(array('t'=> 'product','pid','productid'),1)
    ->join_table(array('t'=> 'merchant','gmuid','muid'),1)->set_where($where)->order_by(array('f'=> 'sells','s'=> 'down'))->set_limit(6)->get_all();

    $page = $this->make_page($model);

    $model->order_by(array('s'=> 'down','f'=> 'collects'));

    $model = $this->init_order($model,['product.productid','gsells','gstime','gprice']);

    $data  = $model->set_limit($this->get_page_limit())->get_all();

    $where2['id'] = @$w['catid'];
    $where2['word'] = @$get['word'];
    $where2['price1'] = @$get['price1'];
    $where2['price2'] = @$get['price2'];
    $attrwhere = array_merge($attr, $where2);
    if (is_array($this->orderby) && @$this->orderby['s'] == 'down') {
      $by = 'up';
      $attrwhere['by'] = $by;
    }
    else {
      $by = 'down';
      $attrwhere['by'] = $by;
    }

    $attrwhere['catid'] = $w['catid'];

    $attrwhere[@$this->orderby['s']] = @$this->orderby['f'];
    $byattr = $attrwhere;
    unset($byattr['up']);
    unset($byattr['down']);
    $data = array('pcat'       => @$pcat,'ccat'       => @$ccat,'data'       => @$data,'page'       => @$page,'where'      => @$where2,'by'         => @$by,'attribute'  => @$attribute,'attrwhere'  => @$attrwhere,'byattr'     => @$byattr,'hot'        => @$hot,'wherestring'=> @$wstring);

    $this->view('', $data);

  }
  public function control_detail()
  {
    //流量记录日志；更新用户足记表，更新产品表
    $day = date('ym');

    $get = get(array('int'=>array('gpid'=>1)));
    $info = T($this->db_name)->join_table(array('t'=>'product','pid','productid'))->join_table(array('t'=>'merchant','product.muid','muid'),1)->join_table(array('t'=>'user','merchant.uid','uid'),1)->get_one($get);
    $this->vlog($this->get_userid(),$info['muid'],$info['productid']);
    if (!$info) {
      YOut::page404();error('产品不存在');
    }
    if ($this->get_muid() != $info['muid']) {
      if ($info['pflag'] != 1) {
        YOut::page404();error('产品未审核');
      }
      if ($info['gcheck'] != 1) {
        YOut::page404();error('团购已失效');
      }
      if ($info['gstime'] > time()) {
        YOut::page404();error('团购已失效');
      }
      if ($info['getime'] < time()) {
        T('groupon')->update(array('gcheck'=>3),array('gpid'=>$info['gpid']));


        error('团购已过期');
      }
      if ($info['shelves'] != 1) {
        YOut::page404();error('产品未上架');
      }
    }
    gourl(geturl(array('productid'=>$info['productid']),'detail','product'));
    /*$attribute=T('product_attribute')->get_all(array('productid'=>$info['productid']));
    $spec=T('product_specs')->order_by(array('s'=>'up','f'=>'id'))->get_all(array('productid'=>$info['productid']));
    $w=array('melite'=>1,'muid'=>$info['muid'],'pflag'=>1,'shelves'=>1);
    $hot=T('product')->set_limit(array(0,8))->order_by(array('f'=>array('hits','zans'),'s'=>'down'))->get_all($w);
    $other=T('product')->set_limit(array(0,4))->order_by(array('f'=>array('sells','hits','zans'),'s'=>'down'))->get_all($w);
    $log=M('plog','im')->logp($info['productid']);

    if($log){
    T('product')->update(array('hits'=>$info['hits']+1),array('productid'=>$info['productid']));

    }
    $array=array('data'=>$info,'spec'=>$spec,'attribute'=>$attribute,'hot'=>$hot,'other'=>$other);
    $this->seoset($info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],$info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],Y::$conf['site_name'].' - ' .$info['merchantname'].' - '.$info['productname']);

    $this->view(null,$array);*/
  }
}
?>
