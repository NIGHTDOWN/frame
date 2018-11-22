<?php


namespace ng169\control\index;
use ng169\control\indexbase;



checktop();

class jfstore extends indexbase
{
  private $db_name = 'jfproduct';
  public function control_run()
  {
    $this->vlog($this->get_userid());
    $c = D_MEDTHOD;    $a = D_FUNC;
    $where['shelves'] = 1;
    $where['temptype'] = 1;
    $where['elite'] = 1;
    $model = T($this->db_name)->join_table(array('t'=>'article_category','catid','catid'))->set_global_where($where);

    /*$model     = $this->init_where($model);

    $model     = $this->init_order($model);*/


    $page      = $this->make_page($model);


    $data      = $model->set_limit($this->get_page_limit())->get_all();

    $var_array = array('data'=>$data,'page'=>$page);
    $this->view(null,$var_array);

  }
  public function control_list()
  {
    $this->vlog($this->get_userid());
    $w = get(array('int'=>array('catid')));
    $pcat = null;
    if ($w['catid']) {
      $p    = M('tree','am')->getptree('product_category_tree',$w['catid']);
      $c    = M('tree','am')->getctree('product_category_tree',$w['catid']);
      $pcat = T('product_category')->set_where(array('catid'=>$p),'in')->get_all();
      $ccat = T('product_category')->set_where(array('parentid'=>$w['catid']),'=')->get_all();
      $attribute = T('product_category_attribute')->order_by(array('f'=>'orders','s'=>'up'))->set_where(array('catid'   =>$w['catid'],'type'    =>0,'htmltype'=>1),'=')->get_all();
    }
    else {
      $ccat = T('product_category')->set_where(array('parentid'=>0),'=')->get_all();
    }
    $attr = get(array('string'=>array('attrold','attr')));
    /*d($_GET);*/
    /*d($attr,1);*/
    if ($attr['attrold']) {
      $attr['attrold'] = explode('__',$attr['attrold']);

      foreach ($attr['attrold'] as $attr1) {
        $value = explode('_',$attr1);
        $attrwhere[($value[0])] = $value[1];
      }
    }

    if ($attr['attr']) {

      $value = explode('_',$attr['attr']);

      if ($value[1] == 'null') {
        unset($attrwhere[($value[0])]);
      }
      else {
        $attrwhere[($value[0])] = $value[1];
      }
    }
    $searchattr = array();
    $wherestring = '';

    if ($attrwhere && is_array($attrwhere)) {
      foreach ($attrwhere as $i=>$list) {
        $searchattr[] = $list;
        $wherestring .= $i."_".$list.'__';
      }
    }
    $wherestring = trim($wherestring,'__');
    $wstring     = 'catid:'.$w['catid'].',attrold:'.$wherestring;
    $thisnum     = sizeof($pcat) - 1;
    if ($thisnum <= 0) {
      $this->seoadd('所有商品 - ' .Y::$conf['site_name']);
    }
    else {
      $this->seoadd($pcat[$thisnum]['catname'] ,$pcat[$thisnum]['metakeyword'],$ccat[$thisnum]['metadesc']);
    }

    $where['shelves'] = 1;
    $where['temptype'] = 1;




    $model = T('jfproduct')->set_field('v.*')->order_by(array('f'=>'productid','s'=>'down'))->set_global_where($where)->join_table(array('t'=>'jfproduct_attribute','productid','productid'),1)->group_by('v.productid');

    if ($c) {

      $model = $model->set_where('v.catid in('.implode(',',$c).')');
    }



    ////////////////////
    $nsql = $model->get_sql();
    $sql  = preg_replace("/select([\s\S]*?)from/is", "select count(DISTINCT v.productid) as num from", $nsql);

    $num  = T('jfproduct')->dosql($sql);
    $hot  = $model->order_by(array('f'=>'sells','s'=>'down'))->set_limit(6)->get_all();
    $num = sizeof($num);
    $agrs= $_GET;
    unset($agrs['page']);
    $a   = D_FUNC;
    $url = geturl($agrs,$a);
    Y::loadTool('page');
    $pagearray['total'] = $num;
    $pagearray['szie'] = $pagearray['szie']?$pagearray['szie']:$this->page_size;
    $pagearray['pagenum'] = $this->_thispage();
    TPL::assign(array('pagearray'=>$pagearray));
    $page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, $maxpage);

    $model= $this->init_order($model);
    //////////////////////
    $data = $model->set_limit($this->get_page_limit())->get_all();
    $where2['id'] = $info['muid'];
    $where2['word'] = $get['word'];
    $where2['price1'] = $get['price1'];
    $where2['price2'] = $get['price2'];

    if (is_array($this->orderby) && $this->orderby['s'] == 'down') {
      $by = 'up';
    }
    else {
      $by = 'down';
    }

    $this->view(null,array('pcat'       =>$pcat,'ccat'       =>$ccat,'data'       =>$data,'page'       =>$page,'where'      =>$where2,'by'         =>$by,'attribute'  =>$attribute,'wherestring'=>$wstring,'attrwhere'  =>$attrwhere,'hot'        =>$hot));
  }
  public function control_detail()
  {
    //流量记录日志；更新用户足记表，更新产品表
    $day = date('ym');
    $this->vlog($this->get_userid());
    $get = get(array('int'=>array('productid'=>1)));
    $get['shelves'] = 1;
    $get['temptype'] = 1;
    $info = T('jfproduct')->get_one($get);
    if (!$info) {
      YOut::page404();
    }


    $attribute = T('jfproduct_attribute')->get_all(array('productid'=>$info['productid']));
    $spec = T('jfproduct_specs')->order_by(array('s'=>'up','f'=>'id'))->get_all(array('productid'=>$info['productid']));
    $w = array('elite'   =>1,'temptype'=>1,'shelves' =>1);
    $hot = T('jfproduct')->set_limit(8)->order_by(array('f'=>array('hits'),'s'=>'down'))->get_all($w);
    $other = T('jfproduct')->set_limit(1)->order_by(array('f'=>array('sells'),'s'=>'down'))->get_all($w);

    $log = M('plog','im')->logp($info['productid']);
    if ($log) {
      T('jfproduct')->update(array('hits'=>$info['hits'] + 1),array('productid'=>$info['productid']));
    }
    $array = array('data'     =>$info,'spec'     =>$spec,'attribute'=>$attribute,'hot'      =>$hot,'other'    =>$other);
    $this->seoset($info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],$info['productname'].' - ' .$info['merchantname'].' - '.Y::$conf['site_name'],Y::$conf['site_name'].' - ' .$info['merchantname'].' - '.$info['productname']);

    $this->view(null,$array);

  }
}
?>
