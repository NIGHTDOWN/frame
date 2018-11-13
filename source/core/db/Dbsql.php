<?php


namespace ng169\db;
use  \PDO;

class Dbsql
{
  var $querynum = 0;
  var $link;
  var $charset;
  public function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $dbcharset =
    'utf8', $pconnect = 1, $halt = true)
  {
    $dsn = G_DB_TYPE.":host=$dbhost;dbname=$dbname";

    try {
      $this->link = new PDO($dsn, $dbuser, $dbpw,
        array(PDO::ATTR_PERSISTENT=> true));
    } catch (Exception $e) {
      error("Unable to connect: " . $e->getMessage());
    }

  }
  /**
  * 执行查询
  * @param string $sql
  *
  * @return data
  */
  public function  query($sql)
  {

    try {
      $this->link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//      $this->link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 3);
      $pdostream = $this->link->query($sql);
    
      $data = $pdostream->fetchAll(PDO::FETCH_ASSOC);
     
    } catch (\Exception $e) {

      error($e);
    }

    return $data;
  }
   /**
  * 执行查询
  * @param string $sql
  *
  * @return data
  */
  public function  getone($sql)
  {

    try {
      $this->link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//      $this->link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 3);
      $pdostream = $this->link->query($sql);
      $pdostream->setFetchMode(PDO::FETCH_ASSOC);
      $data = $pdostream->fetch();
      

   
    } catch (\Exception $e) {

      error($e);
    }

    return $data;
  }
  /**
  * 执行删
  * @param string $sql
  *
  * @return int row受影响的行数
  */
  public function  exec($sql)
  {

    $this->starttransaction();
    try {
      $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      d($sql);
      $row = $this->link->exec($sql);
      /*if($row)*/
      // 提交事务
      $this->commit();
    } catch (\Exception $e) {
      $this->rollback();
      /*throw $e;*/
      error($e);
    }


    return $row;

  }
  /**
  * 执行增
  * @param string $sql
  *
  * @return int 插入的主键ID
  */
  public function  insert($sql)
  {

    $this->starttransaction();
    try {
      $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $row = $this->link->exec($sql);
      $id=$this->link->lastInsertId();
      /*if($row)*/
      // 提交事务
      $this->commit();
    } catch (\Exception $e) {
      $this->rollback();
      /*throw $e;*/
      error($e);
    }


    return $id;

  }
  /**
  * 开启事务
  *
  * @return void
  */
  public function starttransaction()
  {
    $this->link->beginTransaction();
  }
  /**
  * 提交事务
  *
  * @return void
  */
  public function commit()
  {
    $this->link->commit();
  }
  /**
  * 回滚事务
  *
  * @return void
  */
  public function rollback()
  {
    $this->link->rollback();
  }
}











?>
