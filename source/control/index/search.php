<?php

checktop();

class control extends indexbase
{
    public function control_getmore()
    {
        $get = get(array('string' => array('key')));
        if (!$get['key']) {
            error('');
        }

        $wordlist = T('keyword')->set_limit(5)->set_field('word')->order_by(array('f' => array('hits', 'addtime', 'elite'), 's' => 'down'))->get_all(array('flag' => 0, 'word' => $get['key']));
        out($wordlist);

    }
    public function control_run()
    {

        /*$word=get(array('string'=>array('word')));*/

        $get = get(array('string' => array('word'), 'int' => array('price1', 'price2')));
        $ccat = M('keyword', 'im')->search($get['word']);

        $w = get(array('int' => array('catid')));
        $this->vlog($this->get_userid());
        $pcat = null;
        if ($w['catid']) {

            $p = M('tree', 'am')->getptree('product_category_tree', $w['catid']);

            $c = M('tree', 'am')->getctree('product_category_tree', $w['catid']);

            if (is_array($c)) {
                array_push($c, $w['catid']);

            } else {
                $c = array($w['catid']);
            }

            $pcat = T('product_category')->set_field('catid,catname')->set_where('catid in(' . implode(',', $p) . ')')->get_all();
            $ccat = T('product_category')->set_field('catid,catname')->set_where(array('parentid' => $w['catid']), '=')->get_all();

            $attribute = T('product_category_attribute')->order_by(array('f' => 'orders', 's' => 'up'))->set_where(array('catid' => $w['catid'], 'type' => 0, 'htmltype' => 1), '=')->order_by(array('s' => 'up', 'f' => 'weight'))->set_limit(5)->get_all();

        } else {
            $ccat = T('product_category')->set_field('catid,catname')->set_where(array('parentid' => 0), '=')->get_all();

        }

        $thisnum = sizeof($pcat) - 1;
        if ($thisnum <= 0) {
            $this->seoadd('所有商品 - ' . Y::$conf['site_name']);
        } else {
            $this->seoadd($pcat[$thisnum]['catname'], $pcat[$thisnum]['metakeyword'], $ccat[$thisnum]['metadesc']);
        }

        $where['shelves'] = 1;
        $where['status'] = 0;
        $where['pflag'] = 1;
        $where2 = $where;
        /*$where['storeflag']=0;*/
        /*$get    = get(array('string'=>array('word'),'int'   =>array('price1','price2')));*/

        if ($get['price1']) {
            $where['price'] = array($get['price1']);
        }
        if ($get['price2']) {
            $where['price'] = array('1' => $get['price2']);
        }
        /*$where['avalue']=$searchattr;*/
        $insert['address'] = $address['province'] . $address['city'] . $address['area'] . $address['address'];

        if ($province['provinceid'] && $province['provinceid'] != '0') {
            $where['merchant.provinceid'] = $province['provinceid'];
            $wstring = $wstring . ',provinceid:' . $province['provinceid'];
        }

        $attr = get(array('string' => array('att1', 'att2', 'att3', 'att4', 'att5')));
        $model = T('product')->set_field('v.*,merchantname')->order_by(array('f' => 'productid', 's' => 'down'))->set_global_where($where)->join_table(array('t' => 'merchant', 'muid', 'muid'), 1)->join_table(array('t' => 'product_attr', 'productid', 'productid'), 1);
        
     
        foreach ($attr as $v => $list) {
            if ($list == 'null') {
                unset($attr[$v]);
            }
        }
        $model = $model->set_where($attr, '=');
        if ($c) {

            $model = $model->set_where('v.catid in(' . implode(',', $c) . ')');
        }
        if ($get['word']) {
            $word = tohex($get['word']);
            /*$model = $model->set_where("match(productname) against ('*{$word}*' IN BOOLEAN MODE)");*/
            $model = $model->set_where("productname like '%{$word}%'   ");
        }
		
        $hot = T('product')->join_table(array('t' => 'merchant', 'muid', 'muid'))->set_where($where)->order_by(array('f' => 'sells', 's' => 'down'))->set_limit(6)->get_all();
		
        
        $model->order_by(array('s' => 'down', 'f' => 'collects'));
        $model = $this->init_order($model);
        $page = $this->make_page($model);
		
        $data = $model->set_limit($this->get_page_limit())->get_all();

        $where2['id'] = $w['catid'];
        $where2['word'] = $get['word'];
        $where2['price1'] = $get['price1'];
        $where2['price2'] = $get['price2'];
        $attrwhere = array_merge($attr, $where2);
        if (is_array($this->orderby) && $this->orderby['s'] == 'down') {
            $by = 'up';
            $attrwhere['by'] = $by;
        } else {
            $by = 'down';
            $attrwhere['by'] = $by;
        }
        /*$attrwhere=$attr;*/
        $attrwhere['catid'] = $w['catid'];

        $attrwhere[$this->orderby['s']] = $this->orderby['f'];
        $byattr = $attrwhere;
        unset($byattr['up']);
        unset($byattr['down']);
        $data = array('pcat' => $pcat, 'ccat' => $ccat, 'data' => $data, 'page' => $page, 'where' => $where2, 'by' => $by, 'attribute' => $attribute, 'attrwhere' => $attrwhere, 'byattr' => $byattr, 'hot' => $hot, 'wherestring' => $wstring);

        $this->view('product_category', $data);

        /*$this->view('product_category',array('pcat'=>$pcat,'ccat'=>$ccat,'data'=>$data,'page'=>$page,'where'=>$where2,'by'=>$by,'attribute'=>$attribute,'wherestring'=>$wstring,'attrwhere'=>$attrwhere,'hot'=>$hot));*/
    }

}
