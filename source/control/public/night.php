<?php
namespace ng169\control;
use ng169\Y;
use ng169\TPL;
use ng169\service\Output;
use ng169\tool\Request as YRequest;
use ng169\tool\Page as YPage;
use ng169\tool\Cookie as YCookie;
use ng169\tool\Out as YOut;
checktop();
class general extends Y
{
  public $tpl_path, $page_size   = 28,$pagestartid = 0, $log,$pagearray   = array(),$pagekey = null,$fh = null;
  public $group = null;
  private $callback = '_seo';
  public $orderby = array();
  /**
  * 检查是否需要登入
  * @return boolean
  */
  public function needlogin()
  {
    $action = D_FUNC;
    if (in_array(strtolower($action), $this->noNeedLogin) || in_array('*', $this->noNeedLogin)) {
      return false;
    }
    return true;;
  }
  /**
  * 检查是否需要权限
  * @return boolean
  */
  public function needpower()
  {
    $action = D_FUNC;
    if (in_array(strtolower($action), $this->noNeedPower) || in_array('*', $this->noNeedPower)) {
      return false;
    }
    return true;;
  }
  public function vlog($uid = null, $muid = null, $pid = null)
  {
    $logid = M('vlog', 'im')->log($uid, $muid, $pid);
    TPL::assign(array('vlogid'=> $logid));
    return $logid;
  }
  public function init($tpl_path, $size = 20, $db_log_name = null)
  {
    $this->tpl_path = $tpl_path;
    $this->page_size = $size;
    TPL::assign(array('tpl_path'=> $this->tpl_path,'res'     => parent::$urlpath . $this->tpl_path));
  }
  public function seoinit()
  {

    $this->seo['title'] = @Y::$conf['site']['site_name'];
    $this->seo['keyword'] = @Y::$conf['site']['site_keywords'];
    $this->seo['desc'] = @Y::$conf['site']['site_description'];

    TPL::assign(array('seo'=> $this->seo));
  }
  public function seoset($title = null, $keyword = null, $desc = null)
  {

    $this->seo['title'] = $title;

    $this->seo['keyword'] = $keyword;

    $this->seo['desc'] = $desc;

    TPL::assign(array('seo'=> $this->seo));
  }
  public function seoadd($title = null, $keyword = null, $desc = null)
  {

    $this->seo['title'] = $title . ' - ' . $this->seo['title'];

    $this->seo['keyword'] = $keyword . ' - ' . $this->seo['keyword'];

    $this->seo['desc'] = $desc . ' - ' . $this->seo['desc'];

    TPL::assign(array('seo'=> $this->seo));
  }
  public function fix_db_field($data_in_arr = null, $fix_arr = null)
  {
    if (is_array($fix_arr) && is_array($data_in_arr)) {
      foreach ($fix_arr as $key => $val) {
        if ($val != null && !is_numeric($key) && isset($data_in_arr[$val])) {
          $data_in_arr[$key] = $data_in_arr[$val];
          unset($data_in_arr[$val]);
        }
      }
    }
    return $data_in_arr;
  }
  public function initlevel()
  {
    $level = explode(',', @Y::$conf['pt_level_name']);
    return $level;
  }
  public function globaldoing()
  {
    if (D_MEDTHOD == 'wallet') {

      Y::loadTool('asyn');
      $url = geturl(null, 'automfl', 'aysnqian', 'admin');

      YAsyn::start($url, null);
    }

  }
  public function getcache($tplfile = null,$id = 1)
  {
    if ($tplfile == null) {
      $c = D_MEDTHOD;
      $a = D_FUNC;

      if ($a == 'run') {
        $a = 'index';
      }
      $tplfile = "{$c}_{$a}";
    }

    return TPL::getCache($this->_getTPLFile($tplfile),$id);
  }
  public function clear_tpl_cache($tplfile)
  {
    if ($tplfile == null) {
      $c = D_MEDTHOD;
      $a = D_FUNC;

      if ($a == 'run') {
        $a = 'index';
      }
      $tplfile = "{$c}_{$a}";
    }

    $file = $this->_getTPLFile($tplfile);

    TPL::clearCache($file);
  }
  public function view($tplfile = null, $var_array = null, $after_call = null, $cache = null)
  {

    if ($tplfile == null) {
      $c = D_MEDTHOD;
      $a = D_FUNC;

      if ($a == 'run') {
        $a = 'index';
      }
      $tplfile = "{$c}_{$a}";
    }
    $this->_tplfile = $this->_getTPLFile($tplfile);

    if ($var_array) {
      TPL::assign($var_array);
    }

    if ($after_call == null) {

      $group = YRequest::getGpc('m') ? YRequest::getGpc('m') : 'index';
      if ($group == 'index') {

        call_user_func(array($this,$this->callback));
      }
    }
    elseif ($after_call == 1) {

      call_user_func(array($this,$this->callback));
    }
    else {
    }

    $html = TPL::display($this->_tplfile, $cache);

    return;
  }

  public function get_userid($type = 0)
  {
    $userid = @parent::$wrap_user['uid'];

    if ($userid == null && $type) {
      error('请登入在操作', geturl(null, null, 'login', 'index'), 1);
    }

    return $userid;
  }
  public function get_muid($type = 0)
  {
    $muid = @parent::$wrap_user['muid'];
    if ($muid == null && $type) {
      error('请登入在操作', geturl(null, null, 'login', 'index'), 1);
    }
    return $muid;
  }
  public function get_name($uid)
  {
    $id = array('userid'=> $uid);
    $type = T('user')->set_field(array('type'))->get_one($id);
    switch ($type['type']) {

      case '1':
      $k   = 'username';
      $msg = T('member')->set_field(array($k))->get_one($id);
      return $msg[$k];
      break;
      case '2':
      $k   = 'merchantname';
      $msg = T('member')->set_field(array($k))->get_one($id);
      return $msg[$k];
      break;

    }

  }

  public function get_adminid()
  {
    $adminid = parent::$wrap_admin['adminid'];
    if ($adminid == null) {

      out('登入超时，请重新登入', geturl(null, 'login', 'login', 'admin'), 0, 1);

    }
    return $adminid;

  }

  public function get_area()
  {
    $m = M('city', 'im');
    return $m->_getarea();
  }

  public function init_where($table, $filder = null,$op = '')
  {

    /*if (isset($_POST['sflag']) || isset($_GET['sflag'])) {
    unset($_POST['sflag']);
    unset($_GET['sflag']);

    $get = $_GET;
    $post= $_POST;
    foreach ($post as $key => $val) {
    if (is_array($val) && sizeof($post) > 1) {
    if ((sizeof(array_filter($val))) != 0) {
    foreach ($val as $k2 => $v) {

    if (strtotime($v)) {
    $val[$k2] = strtotime($v);
    }
    if ($val[$k2] == null) {
    $val[$k2] = intval($val[$k2]);
    }
    }
    if (sizeof($val) != 0) {
    $post[$key] = '[' . implode(',', $val) . ']';
    }
    else {
    unset($post[$key]);
    }
    }
    else {
    unset($post[$key]);
    }
    }
    }
    $args = array_merge($get, $post);
    $args = array_filter($args, 'strlen');
    $url  = geturl($args, $args['a'], $args['c'], $args['m']);

    YOut::redirect($url);
    }
    else {*/
    $keyarr = [];
    /**
    * 加入可排序字段
    * 排序字段前缀识别
    */
    $bool   = ($filder != null && is_array($filder));
    if ($bool) {
      foreach ($filder as $index=>$string) {
        $string = explode('.',$string);
        if (sizeof($string) > 1) {
          $keyarr[$index] = $string[1];
        }
        else {
          $keyarr[$index] = $string[0];
        }
      }
    }
    else {
      $keyarr = $table->get_field();
    }
    if (gettype($table) == 'object') {
      $filed_arr = $keyarr;

      $w         = get(array('string'=> $filed_arr));

      foreach ($w as $key => $val) {

        if (isset($w[$key])) {

          if (!is_array($val) && preg_match('/^\[(\d*,\d*)\]$/', $val, $info)) {
            $w[$key] = explode(',', $info[1]);
            $w[$key] = array_filter($w[$key]);
          }
        }
      }

      $sw = G(array('string' => array('word')))->get();



      $table->set_where($w,$op);

      parent::$wrap_where = $w;

      $var_array  = array('where'=> $w,'word' => @$sw['word']);
      TPL::assign($var_array);
    }
    return $table;
    /*  }*/
  }
  /**
  * 排序
  * @param modelobject $table 模型实例
  * @param array $filder 排序字段
  *
  * @return object 排序模型对象
  */
  public function init_order($table,$filder = null)
  {
    $by = get(array('string' => array('up','down')));
    $keyarr = [];
    /**
    * 加入可排序字段
    * 排序字段前缀识别
    */
    $bool   = ($filder != null && is_array($filder));
    if ($bool) {
      foreach ($filder as $index=>$string) {
        $string = explode('.',$string);
        if (sizeof($string) > 1) {
          $keyarr[$index] = $string[1];
        }
        else {
          $keyarr[$index] = $string[0];
        }
      }
    }
    else {
      $keyarr = $table->get_field();
    }
    //存在就排序
    if (sizeof($by) >= 1) {
      foreach ($by as $key => $v) {
        if (!in_array($v, $keyarr)) {
          return $table;
        }
        if ($bool) {
          $index    = array_search($v,$keyarr);
          $orderkey = $filder[$index];
        }
        else {
          $orderkey = $v;
        }

        switch ($key) {
          case 'up':
          $word = array('f'=> $orderkey,'s'=> 'up');
          $table = $table->order_by($word);

          break;

          case 'down':
          $word = array('f'=> $orderkey,'s'=> 'down');

          $table = $table->order_by($word);
          break;

        }
      }

      if (is_array($word)) {
        $this->orderby = $word;

        $var_array = array('orderby'=> $word);
        TPL::assign($var_array);
      }

    }

    return $table;
  }
  public function get_page_limit($page_size = null)
  {
    if ($page_size != null) {
      $this->page_size = $page_size;
    }
    $thispage = $this->_thispage();
    $index    = ($thispage - 1) * $this->page_size;
    $index2   = ($thispage) * $this->page_size - 1;




    if (isset($this->pagearray[$index])) {

      $start = $this->pagearray[$index][$this->pagekey];

      if (isset($this->pagearray[$index2])) {

        $array = array_column($this->pagearray,$this->pagekey);
        $start2= array_slice($array,$index,$this->page_size);

        /*$start2=$this->pagearray[$index2][$this->pagekey];*/


      }


    }
    else {
      if ($this->fh == '>') {

      }
      else {
        $start = $this->pagestartid - ($thispage - 1) * $this->page_size;
      }

    }

    $end = $thispage * $this->page_size;

    if (!isset($start2)) {
      $in = $start;
    }
    else {
      /*$in[0]=$start;
      $in[1]=$start2;*/
      /*$array=array_column($this->pagearray,$this->pagekey);
      $in=array_slice($array,$index,$index2);*/
      $in = $start2;
      /*d($index);
      d($index2);
      d($in);*/
    }

    $limit = array(intval($in),intval($this->page_size));
    return $limit;
  }
  public function set_pagesize($size)
  {
    if ($size) {
      $this->page_size = $size;
    }
  }

  public function make_page($table, $maxpage = 4, $pagesize = null,$key = null,$iscache = 1)
  {


    if ($pagesize) {
      $this->set_pagesize($pagesize);
    }
    $panum = 5000;
    if ($key) {
      $prikey = $key;
    }
    else {
      $prikey = $table->get_primarykey();
    }


    $field = $table->table->f;

    $this->pagekey = $prikey;
    /* d($table->table->f);*/
    /* d($table->table->f);*/


    $bs = ($table->getby());
    if ($bs == 'ASC') {
      $b = 'up';
      $fh= '>';
      $s = '0';
    }
    else {
      $b = 'down';
      $fh= '<';
      $s = '99999999999';
    }
    $this->fh = $fh;

    $bword = ($table->getbyword());
    if ($bword) {
      $f = $bword;
    }
    else {
      $f = $prikey;
    }

    $sql = $table->set_field('v.'.$prikey)->order_by(array('s'=>$b,'f'=>$f))->set_limit(array($s,$panum + 1),$key,$fh)->get_sql();

    $index = md5($sql);
    if ($iscache) {
      list($bool,$data) = Y::$cache->get($index);
    }



    if ($bool && $iscache) {
      $nums = $data;
    }
    else {

      $nums = $table->set_field('v.'.$prikey)->order_by(array('s'=>$b,'f'=>$f))->set_limit(array($s,$panum + 1),$key,$fh)->get_all();
      if ($iscache) {
        Y::$cache->set($index,$nums);
      }

    }


    $table->fixby();
    if ($this->fh == '>') {
      $this->pagestartid = intval($nums[0][$prikey] - 1);
    }
    else {
      if (isset($nums[0]) && isset($nums[0][$prikey])) {
        $this->pagestartid = intval($nums[0][$prikey] + 1);
      }
      else {
        $this->pagestartid = 0;
      }

    }

    $this->pagearray = $nums;
    $table->set_field($field);

    /*$num = $table->get_count();*/
    $num = sizeof($nums);
    if (!$num)return false;
    if ($num > $panum) {
      $num = $table->get_count2();
    }
    else {
      $sums = $num;
    }

    $agrs = $_GET;
    unset($agrs['page']);
    /*unset($agrs['spage']);*/
    $a   = D_FUNC;
    $url = geturl($agrs, $a);
    Y::loadTool('page');
    $pagearray['total'] = $num;
    $pagearray['szie'] = isset($pagearray['szie']) ? $pagearray['szie'] : $this->page_size;
    $pagearray['pagenum'] = $this->_thispage();
    TPL::assign(array('pagearray'=> $pagearray,'pagesize' =>$sums));
    //    $pages = $start;

    $page = YPage::admin($num, $pagearray['szie'], $pagearray['pagenum'], $url, $maxpage);

    return $page;
  }

  public function make_category($table, $link_db_arr)
  {
    $search = array();
    $key = $table->get_filed();
    foreach ($link_db_arr as $field => $val) {
      if (in_array($field, $key)) {

        $field_dbobj = T($val['dbname']);
        if ($val['as'] != null) {

          $id = parent::$wrap_where[$val['as']];
          if ($id != null && $id != '' && $showchoose) {
            $f = $field_dbobj->get_field();
            $f = array_merge($f, array($val['as']=> $f = $field_dbobj->get_primarykey()));
            $f_get = $field_dbobj->set_field($f)->get_all();

          }
          else {

            if ($child) {
              $f = $field_dbobj->get_field();
              $f = array_merge($f, array($val['as']=> $f = $field_dbobj->get_primarykey()));
              $f_get = $field_dbobj->set_field($f)->set_where(array('parentid'=> $id))->get_all();
            }

          }
        }
        else {

          $id = parent::$wrap_where[$field];
          if ($id != null && $id != '' && $showchoose) {

            $f_get = $field_dbobj->get_all();

          }
          else {

            if ($child) {

              $f_get = $field_dbobj->set_where(array('parentid'=> $id))->get_all();
            }

          }
        }

      }

      $out = array('$field' => array('alais'=> $alais,'data' => $f_get));
      $search = array_merge($search, $out);
    }
    return $search;
  }



  private function _getTPLFile($tplname, $path = null)
  {

    $tplfile = $path ? $path . $tplfile : $this->tpl_path . $tplname;
    if (!file_exists(ROOT . './' . $tplfile . '.tpl') && !file_exists(ROOT .
        './' . $tplfile . '.html')) {
      out('模板文件[' . $tplname . ']不存在，请检查！', '', 0, 0);
    }
    else {
      $tplfile = file_exists(ROOT . './' . $tplfile . '.tpl') ? $tplfile . '.tpl' :
      $tplfile . '.html';
      return $tplfile;
    }
  }
  private function _seo()
  {
    \ng169\hook\seo();

  }
  public function _thispage()
  {
    $thispage = G(array('int' => array('page')))->get();

    if (count($thispage) != 0) {
      $thispage = $thispage['page'];
    }
    else {
      $thispage = 1;
    }
    if ($thispage < 1) {
      $thispage = 1;
    }
    return $thispage;
  }
  public function _getcookie($name)
  {

    parent::loadTool('cookie');
    $admininfo = YCookie::get($name);
    $Xcode     = Y::import('code', 'tool');
    $admininfo = $Xcode->authCode($admininfo, 'DECODE');

    $admininfo = unserialize($admininfo);

    return $admininfo;
  }

  public function _savecookie($name, $val)
  {
    $Xcode   = Y::import('code', 'tool');
    $infostr = serialize($val);
    $infocode= $Xcode->authCode($infostr, 'EECODE');
    parent::loadTool('cookie');
    YCookie::set($name, $infocode);
  }
  public function _delcookie($name)
  {
    parent::loadTool('cookie');
    YCookie::del($name);
  }
}
