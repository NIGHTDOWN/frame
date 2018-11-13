<?php
namespace ng169\db;
use ng169\lib\Option;
use ng169\db\Dbsql;
use ng169\Y;
checktop();
class daoClass
{
  public $_db = null;
  public $debug = G_DB_DEBUG;
  public $t, $w, $b, $l, $j, $g, $Gw;
  public $f = '*,v.*';
  private $tablename;
  private $joinword = ' left join ';
  private $table_key = array();
  private $table_all_key = array();
  private $pri_key = null;
  private $dbqz = DB_PREFIX;
  private $xh = array();
 /* private $cache = '';*/
  private $loop = array();
  private $notgetkey = null;
  private $bs = null;
  private $oldbs = null;
  /**
  * 初始化pdo
  * @param undefined $dbconf
  * 
  * @return
  */
  public function __construct($dbconf = 'main')
  {
    $dbs = Option::get('db');

    if (isset($dbs[$dbconf])) {
      $conf = $dbs[$dbconf];
      $this->dbqz = $conf['dbpre'];
      $this->_db = new Dbsql($conf['dbhost'], $conf['dbuser'], $conf['dbpwd'], $conf['dbname'], $conf['charset']) or error(__('数据库配置不存在'));
    /*  $this->cache = & Y::$cache;//缓存不开启*/

    }
    else {
      error(__('数据库配置不存在'));
    }
  }
/**
* 初始化表模型
* @param string $table
* @param array $filedar字段名称
* 
* @return modelobj 返回模型
*/
  public function tabel($table, $filedar = null)
  {
    $this->t($table, $filedar = null);
  }
  private function _get_child($index, $val = 0, $parent = null)
  {
    $val = intval($val);
    if (in_array(($val), $this->loop)) {
      return false;
    }
    else {
      array_push($this->loop, $val);
    }

    if ($parent == null) {
      $parent = 'parentid';
    }
    $where = array($parent=> $val);
    $by = array('f'=> 'orders');
    $info      = $this->w($where)->b($by)->s(0);
    $info_back = $info;
    $i         = 0;
    $offer     = 0;
    if (is_array($info)) {
      foreach ($info as $key => $v) {
        $i++;
        if (!isset($v[$index])) {
          return $info;
        }
        if (!in_array($v[$index], $this->xh)) {
          $child = $this->_get_child($index, $v[$index], $parent);
        }
        if (is_array($child)) {
          array_splice($info_back, $offer + $i, '0', $child);
          $offer = $offer + sizeof($child);
        }
      }
    }
    else {

      return $info;
    }

    return $info_back;
  }
  public function get_child($index, $val = 0, $parent = null, $cachebool = 1)
  {

    if ($index) {
      $val       = intval($val);
      $cachename = $this->tablename . "_tree" . $val;

      $cache     = $this->cache;

      list($bool, $info) = $cache->get($cachename);
      if (($bool) && $cachebool) {

      }
      else {
        $info = $this->_get_child($index, $val, $parent);

        if ($info) {

          $cache->set($cachename, $info);
        }

        return $info;
      }

    }
    else {
      return null;
    }
    return $info;
  }
/**
* 初始化表模型
* @param string $table
* @param array $filedar字段名称
* 
* @return modelobj 返回模型
*/
  public function t($table, $filedar = null)
  {

    if (is_array($table)) {
      $this->tablename = "(".($table[0]).")";
      $this->f = '*';
      $t = "select " . $this->f . " from " . $this->tablename . " as v ";
      $this->notgetkey = TRUE;
      $this->t = $t;
      $newobj = clone $this;

      /*unset($this);*/
      return $newobj;
    }
    else {
      $this->tablename = $this->dbqz . $table;
      $t = "select " . $this->f . " from `" . $this->tablename . "` as v ";
    }
    if ($filedar != null) {
      $this->set_field($filedar);
    }
    $this->t = $t;
    $newobj = clone $this;
    /*unset($this);*/
    return $newobj;
  }

  public function set_field($field_arr, $check = 1)
  {
    if ($field_arr != null && is_array($field_arr) && $check) {
      $filed = null;
      foreach ($field_arr as $key => $a) {
        if (is_numeric($key)) {
          $filed .= ',' . $this->fix($a);
        }
        else {
          $filed .= ',' . $this->fix($key) . ' as ' . $a;
        }
      }
      $filed = trim($filed, ',');
      $this->t = str_replace($this->f, $filed, $this->t);
      $this->f = $filed;
    }
    else {

      $this->t = str_replace($this->f, $field_arr, $this->t);
      $this->f = $field_arr;
    }
    return $this;

  }
  public function join($join, $type = false)
  {
    $this->j($join, $type = false);
  }
  public function rjoin($join, $type = false)
  {
    $this->joinword = ' right join ';
    $this->j($join, $type = false);
  }
  public function ljoin($join, $type = false)
  {
    $this->joinword = ' left join ';
    $this->j($join, $type = false);
  }
  public function union($sql, $sql2)
  {
    $sql = $sql . ' union ' . $sql2;
    return $this->q($sql);
  }
  public function unionall($sql, $sql2)
  {
    $sql = $sql . ' union all ' . $sql2;
    return $this->q($sql);
  }
  private function isneedfix($str)
  {
    if (!strrpos($str, ".")) {
      return true;
    }
    else {
      return false;
    }
  }
  public function j($join, $bool = false)
  {
    $dbqz = $this->dbqz;
    $word = $this->joinword;
    $t    = $word . '`' . $dbqz . $join['t'] . '`';
    if (is_array($join)) {
      if ($this->isneedfix($join[0])) {
        $join[0] = 'v.' . $join[0];
      }
      if ($join['as'] == null) {
        $j1 = $t . ' as `' . $join['t'] . '`  on ' . $join[0] . " = `" . $join['t'] .
        "`." . $join[1];
      }
      else {
        $t = $word . " ( " . $join['t'] . " ) ";
        $j1= $t . ' as `' . $join['as'] . '`  on ' . $join[0] . " = `" . $join['as'] .
        "`." . $join[1];
      }
    }

    if ($bool) {
      $this->j .= $j1;
    }
    else {
      $this->j = $j1;
    }

    return clone $this;
  }
  public function select($type)
  {
    switch ($type) {
      case 'all':
      $type = 0;
      break;
      case 'one':
      $type = 1;
      break;
      case 'count':
      $type = 2;
      break;
    }
    $this->s($type);
  }
  public function s($type, $debug = null, $cache = null, $sql = null)
  {

    $w = $this->w ? ' where  ' . $this->w : ' ';
    if ($this->Gw != null && trim($this->Gw) != '') {
      if ($w != null && trim($w) != '') {
        $w = $w . ' and (' . $this->Gw . ')';
      }
      else {
        $w = ' where  ' . $this->Gw;
      }

    }
    if ($this->limit_where != null && trim($this->limit_where) != '') {
      if ($w != null && trim($w) != '') {
        $w = $w . ' and (' . $this->limit_where . ')';
      }
      else {
        $w = ' where  ' . $this->limit_where;
      }

    }


    if (!$sql) {
      $sql = $this->t . $this->j . $w . $this->g . ' ' . $this->b . $this->l;
    }

    if ($this->debug) {

      $Stime = microtime(true);

    }
    switch ($type) {
      case 0:
      if ($cache) {
        $index = md5($sql);
        if ($bool = $this->cache->get($index)) {
          $ret = $bool;
        }
      }
      else {
        $ret = $this->_db->query($sql);
        if ($cache) {
          $this->cache->set($index, $ret);
        }
      }

      break;
      case 1:
      if ($cache ) {
        $index = md5($sql);
        if ($bool = $this->cache->get($index)) {
          $ret = $bool;
        }
      }
      else {

        $ret = $this->_db->getone($sql);
        if ($cache) {
          $this->cache->set($index, $ret);

        }
      }

      break;
      case 2:
      $sql = str_replace($this->f, 'count(*)', $sql);

      if ($this->g) {

      }
      else {
        $sql = preg_replace("/select([\s\S]*?)from/is", "select count(*) from", $sql);
      }


      $ret = $this->_db->query($sql);
      break;
      case 3:
      $sql = $this->t;
      $sql = preg_replace("/select([\s\S]*?)from/is", "select count(1) from", $sql);

      $ret = $this->_db->query($sql);
      break;
      case 4:

      $ret = $sql;
      break;
      default:
    }

    if ($this->debug || $debug) {

      $Etime = microtime(true);
      $Ttime     = $Etime - $Stime;
      $str_total = var_export($Ttime, true);
      if (substr_count($str_total, "E")) {
        $float_total = floatval(substr($str_total, 5));
        $Ttime       = $float_total / 100000;
      }
      d('语句：' . $sql . '耗时' . $Ttime . '秒');
    }
    if ($this->debug) {
      return $ret;
    }
    else {
      return @$ret;
    }
  }
  public function where($where)
  {
    $this->w($where);
  }
  private function fix($str, $ispix = 1)
  {
    $pix = '';
    if ($ispix) {
      $pix = '`v`.';
    }

    if ($this->isneedfix($str)) {


      $tk = $this->getfiled( - 1);
      if (@in_array($str, $tk)) {
        $str = '`' . $str . '`';
        $str = $pix . $str;
      }
    }
    else {
      $str = explode('.', $str);
      if ($str[1] != '*') {
        $str[1] = '`' . $str[1] . '`';
      }
      $str = '`' . $str[0] . '`.' . $str[1];
    }
    return $str;

  }
  public function set_global_where($where, $operator = null, $type = 1, $andor = 'and', $break =
    0)
  {
    $this->Gw($where, $operator, $type, $andor, $break);
  }
  public function Gw($where, $operator = null, $type = 1, $andor = 'and', $break =
    0)
  {

    $word = ' ';
    $w    = null;
    $z = null;

    $op = $operator;
    if ($andor == null) {
      $andor = 'and';
    }
    if ($operator == null) {
      $operator = "=";
    }
    $operator = " " . $operator . " ";

    if (is_array($where) && sizeof($where)) {
      foreach ($where as $key => $w1) {

        $key = $this->fix($key);
        if (is_array($w1)) {

          switch (sizeof($w1)) {
            case '0':

            break;
            case '1':
            if (isset($w1[0])) {
              $w .= ' ' . $andor . " {$key}{$operator}'{$w1[0]}'  ";
            }
            else {
              $w .= ' ' . $andor . " {$key}<={$w1[1]}  ";
            }
            break;
            case '2':
            if ((is_numeric($w1[0]) && is_numeric($w1[1])) && !$break) {
              $w .= ' ' . $andor . " {$key} " . ' BETWEEN ' . " {$w1['0']} and {$w1['1']} ";
              break;
            }
            default:
            $andor = 'or';
            foreach ($w1 as $v) {
              $z .= " $andor {$key}{$operator}'{$v}'  ";
            }
            $z     = trim($z);
            $z     = trim($z, $andor);
            $andor = 'and';
            $z     = " (" . $z . ")";
            $w .= ' ' . $andor . $z;
            break;
          }
        }
        else {

          switch (is_numeric($w1)) {
            case true:
            $w .= ' ' . $andor . " {$key}{$operator}{$w1}  ";
            break;
            case false:
            if ($op != null) {
              $w .= ' ' . $andor . " {$key} {$operator} '{$w1}'  ";
            }
            else {
              $w .= ' ' . $andor . " {$key} like '{$w1}%'  ";
            }
            break;
          }
        }

        $w = trim($w);
        $w = trim($w, ($andor));
        $w = " (" . $w . ")";
      }
    }
    else {
      $w = $where;

    }
    $w = trim($w);
    $w = trim($w, $andor);
    $w = "" . $w . "";

    if ($type) {
      $this->Gw = $w;
    }
    else {
      if ($this->Gw == null) {
        $this->Gw .= $w;
      }
      else {
        $this->Gw .= ' and (' . $w . ') ';
      }
    }

    return $this;
  }

  public function w($where, $operator = null, $type = 1, $andor = 'and', $break =
    0)
  {

    if (is_array($where)) {
      if (!sizeof($where)) {
        return $this;
      }

      $word = ' ';
      $w    = null;
      $z = null;
      $op = $operator;
      if ($andor == null) {
        $andor = 'and';
      }
      if ($operator == null) {
        $operator = "=";
      }
      $operator = " " . $operator . " ";

      if (is_array($where) && sizeof($where)) {
        foreach ($where as $key => $w1) {

          $key = $this->fix($key);

          if (is_array($w1) && $w1) {

            switch (sizeof($w1)) {

              case '1':
              if (!$break) {

                if (isset($w1[0])) {

                  if ($operator == ' = ') {
                    $w .= ' ' . $andor . " {$key}>='{$w1[0]}'  ";
                  }
                  else {
                    $w .= ' ' . $andor . " {$key}{$operator}'{$w1[0]}'  ";
                  }
                }
                else {
                  $w .= ' ' . $andor . " {$key}<={$w1[1]}  ";
                }
                break;
              }
              case '2':
              if ((is_numeric($w1[0]) && is_numeric($w1[1])) && !$break) {
                $w .= ' ' . $andor . " {$key} " . ' BETWEEN ' . " {$w1['0']} and {$w1['1']} ";
                break;
              }
              default:

              foreach ($w1 as $v) {
                $z .= " or {$key}{$operator}'{$v}'  ";

              }
              $z = trim($z);
              $z = trim($z, 'or');
              $z = " (" . $z . ")";

              if (sizeof($w1) == 1) {
                $w .= ' ' . $z;
              }
              else {
                $w .= ' ' . $andor . $z;
              }
              break;
            }

          }
          else {

            switch (is_numeric($w1)) {
              case true:
              $w .= ' ' . $andor . " {$key}{$operator}'{$w1}'  ";

              break;
              case false:

              if ($op != null) {
                $w .= ' ' . $andor . " {$key} {$operator} '{$w1}'  ";
              }
              else {
                $w .= ' ' . $andor . " {$key} like '{$w1}%'  ";
              }
              break;
            }
          }

          if ($w) {
            $w = trim($w);
            $w = trim($w, ($andor));
            $w = " (" . $w . ")";
          }
        }
      }

      $w = trim($w);
      $w = trim($w, $andor);
      $w = "" . $w . "";

    }
    else {
      $w = $where;
    }

    if ($type) {
      $this->w = $w;
    }
    else {
      if ($this->w == null) {
        $this->w .= $w;
      }
      else {

        if ($w) {
          $this->w .= ' and (' . $w . ') ';
        }

      }
    }

    return $this;
  }
  public function getkey()
  {
    if ($this->pri_key == null) {
      $tbname = $this->tablename;
      $sql    = 'DESCRIBE ' . $tbname;
      $index  = md5($sql);
      list($bool, $data) = $this->cache->get($index);
      if ($bool) {
        $ar = $data;
      }
      else {
        $ar = $this->_db->query($sql);
        $this->cache->set($index, $ar);
      }

      foreach ($ar as $key => $v) {
        if ($v['Key'] == 'PRI') {
          $this->pri_key = $v['Field'];
          return $this->pri_key;
        }
      }
    }
    return $this->pri_key;
  }
  public function k()
  {
    return $this->getkey();
  }
  public function getfiled($p = 1)
  {

    if ($this->notgetkey) {
      return false;
    }
    if ($p == 1) {
      $key = & $this->table_all_key;
    }
    else {
      $key = & $this->table_key;
    }
    if (1) {
      $b = array();
      if ($p == 1) {
        $sql = "select * from " . $this->tablename . ' as v ' . $this->j . ' limit  1';
        $ar  = $this->_db->query($sql);

      }
      if ($p == 1 && is_array($ar)) {
        foreach ($ar as $key => $v) {
          if (!in_array($key, $b)) {
            array_push($b, $key);
          }
        }
      }
      else {

        $tbname    = $this->tablename;
        $sql       = 'DESCRIBE ' . $tbname;
        $index     = md5($sql);
        $filecache = new  \ng169\cache\File();
        /*list($bool, $data) = $this->cache->get($index);*/
        list($bool, $data) = $filecache->get($index);
        if ($bool) {
          $ar = $data;
        }
        else {
          $ar = $this->_db->query($sql);
          /*$this->cache->set($index, $ar);*/

        }

        foreach ($ar as $key => $v) {

          if ($p == 0) {
            if ($v['Key'] != 'PRI' && $v['Extra'] != 'auto_increment') {
              array_push($b, $v['Field']);
            }
          }
          else {
            array_push($b, $v['Field']);
          }
        }
      }
      $key = array_unique($b);
    }
    return $key;
  }
  public function f($p = 1)
  {
    return $this->getfiled($p);
  }
  public function query($sql)
  {
    $this->q($sql);
  }
  public function q($sql)
  {
    $res = $this->_db->query($sql);

    return $res;

  }
  public function order($order)
  {
    $this->b($order);
  }
  public function getbs()
  {

    return $this->bs;
  }
  public function b($order)
  {
    $this->oldbs = $this->b;
    $word = ' order by ';
    if (is_array($order)) {
      switch ($order['s']) {
        case 'up':
        $bword = 'ASC';
        break;
        case 'down':
        $bword = 'DESC';
        break;
        default:
        $bword = 'ASC';
        break;
      }
      $this->bs = $bword;

      $tablekey = $this->getfiled(1);
      $b        = null;

      if (is_array($order['f'])) {

        foreach ($order['f'] as $key => $b1) {
          $b1    = trim($b1, '`');
          $field = explode('.', $b1);

          if (in_array($field[0], $tablekey) || in_array($field[1], $tablekey)) {
            $b = $this->fix($b1);

            if (is_array($order['s'])) {
              switch ($order['s'][$key]) {
                case 'up':
                $bwordtmp = 'ASC';
                break;
                case 'down':
                $bwordtmp = 'DESC';
                break;
                default:
                $bwordtmp = 'ASC';
                break;
              }
              $bb .= ", " . $b . ' ' . $bwordtmp . ' ';

            }
            else {

              $bb .= ", " . $b . ' ' . $bword . ' ';
            }

          }

        }
        $bb = trim($bb, ",");
        if ($bb) {
          $this->b = $word . $bb . ' ';
        }

      }
      else {
        if (isset($order['f']) && $order['f'] != '') {
          $field = explode('.', $order['f']);
          /*  if (in_array($field[0], $tablekey) || in_array($field[1], $tablekey)) {
          $bb = $this->fix($order['f']);
          if ($bb) {

          $this->b = $word . $bb . ' ' . $bword;
          }
          } else {*/
          $b     = $order['f'];
          $this->b = $word . ' ' . $order['f']. ' ' .$bword;
          /* }*/

        }
      }

    }
    else {
      if ($order) {
        $this->b = $word . $order;

      }

    }
    $this->bsword = $b;
    return $this;
  }
  private $bsword = '';
  public function fixby()
  {


    $this->b = $this->oldbs;
    return $this;
  }
  public function getbyword()
  {
    return $this->bsword;
  }
  public function limit($limit,$key = null)
  {
    $this->l($limit);
  }
  public function l($limit,$key = null,$fh = null)
  {
    if (!is_array($limit)) {
      $word = ' limit ';
      $this->l = $word.intval($limit);
      return $this;
    }
    $word = ' limit ';
    $this->l = $word.intval($limit[1]);
    if ($key) {

    }
    else {
      $key = 'v.'.$this->getkey();
    }

    if (is_array($limit[0])) {

      /*if($limit[0][0]>=$limit[0][1]){
      $w="($key between {$limit[0][1]} and {$limit[0][0]})";
      }else{
      $w="($key between {$limit[0][0]} and {$limit[0][1]})";
      }*/
      $w = '';
      /*d($limit);*/
      /*foreach($limit[0] as $l){
      $w=$w.",".$l;
      }*/
      $w = implode(',',$limit[0]);
      $w = trim($w,',');
      $w = trim($w,' ');

      $w = "$key in ($w)";
      $this->set_limit_where($w);
      /*$this->l = '';*/
      return $this;
    }

    if ($fh == null) {
      if ($this->getbs() == 'ASC') {
        $fh = ">=";
      }
      else {
        $fh = "<=";
      }

    }
    else {
      $fh = $fh;
    }

    $ha = explode('.',$key);
    if ($ha[1]) {
      $w = "$key $fh {$limit[0]}";
    }
    else {
      $w = "v.$key $fh {$limit[0]}";
    }


    $this->set_limit_where($w);



    return $this;
    //以下是旧版limit 不适用大数据读取
    /*$l = null;
    $word = ' limit ';
    if (count($limit) != 1) {

    $l = $word . intval($limit[0]) . ',' . intval($limit[1]);
    $this->l = $l;
    } else {
    $l = $word . intval($limit[0]);
    $this->l = $l;
    }
    return $this;*/
  }
  private function set_limit_where($where)
  {
    $this->limit_where = $where;

  }
  private $limit_where = '';
  public function g($name)
  {
    $word = ' group by ';
    $this->g = $word . $name;
    return $this;
  }
  public function del()
  {
    $this->d();
  }
  public function d()
  {
    $w   = $this->w ? ' where  ' . $this->w : ' ';

    $sql = $this->t . $w;
    $sql = str_replace('select *,v.*', ' delete ', $sql);
    $sql = str_replace('as v', '', $sql);
    $sql = str_replace('`v`.', '', $sql);

    return $this->_db->query($sql);
  }
  public function i($t, $ar, $auto = 1)
  {

    $t    = $this->dbqz . $t;
    $name = null;
    $value = null;
    $douhao = ',';
    foreach ($ar as $index=>$val) {
      $name .= "`".$index."`".$douhao;
      $value .= "'".$val."'".$douhao;
    }
    $name = trim($name,$douhao);
    $value= trim($value,$douhao);
    $sql  = "insert into $t ($name) values ($value)";
    return $this->_db->insert($sql);
    /*return $this->_db->exec($t, $ar, $auto);*/
  }


  public function insert($t, $ar)
  {
    $this->i($t, $ar);
  }
  public function updata($t, $ar, $where = null)
  {

    return $this->u($t, $ar, $where);
  }
  public function u($t, $ar, $where = null, $bool = true)
  {
    if (sizeof($ar) == 0) {
      return 0;
    }

    $t    = $this->dbqz . $t;
    $name = null;
    $value = null;
    $douhao = ',';
    foreach ($ar as $index=>$val) {
      $name .= "`".$index."`='".$val."'".$douhao;

    }
    $name = trim($name,$douhao);

    $sql  = "update  $t set $name ";
    if ($where) {
      $where = $this->_arraytostring($where);
    }
    if ($where) {
      $sql = $sql." where ".$where;
    }




    return $this->_db->exec($sql);
  }
  private function _arraytostring($array)
  {
    if (!is_array($array)) {
      return $array;
    }

    $string = '';
    if (is_array($array) && sizeof($array)) {
      foreach ($array as $key => $w1) {
        $key = $this->fix($key, 0);
        if (is_array($w1)) {
          $andor    = 'and';
          $operator = '=';
          $w        = '';
          switch (sizeof($w1)) {
            case '0':

            break;
            case '1':
            if (isset($w1[0])) {

              if ($operator == ' = ') {
                $w .= ' ' . $andor . " {$key}>='{$w1[0]}'  ";
              }
              else {
                $w .= ' ' . $andor . " {$key}{$operator}'{$w1[0]}'  ";
              }
            }
            else {
              $w .= ' ' . $andor . " {$key}<={$w1[1]}  ";
            }
            break;
            /* case '2':
            if ((is_numeric($w1[0]) && is_numeric($w1[1])) && !$break) {
            $w .= ' ' . $andor . " {$key} " . ' BETWEEN ' . " {$w1['0']} and {$w1['1']} ";
            break;
            }*/
            default:
            foreach ($w1 as $v) {
              $z .= " or {$key}{$operator}'{$v}'  ";

            }
            $z = trim($z);
            $z = trim($z, 'or');
            $z = " (" . $z . ")";
            $w .= ' ' . $andor . $z;
            break;
          }
          $string .= $w;
        }
        else {
          if (preg_match('/\>|\<|like\s|=|in\s|between\s|not\s/', strtolower($w1))) {
            $string .= " and " . $key . $w1;
          }
          else {
            $string .= " and $key='$w1'";
          }
        }

      }
    }
    $string = trim(trim($string), 'and');
    return $string;

  }
}

