<?php



namespace ng169\model\index;
use ng169\Y;

checktop();

class storeinfo extends Y
{
  public function getcknum($muid){
      if(!$muid)return false;
      $where['muid']=$muid;
      $where['shelves']=0;
      $where['temptype']=1;
      $where['status']=0;
      $where['pflag']=1;
     $num= T('product')->set_where($where)->get_count();
     return $num;
  }
  public function getwcknum($muid){
    if(!$muid)return false;
    $where['muid']=$muid;
    $where['temptype']=1;
    $where['status']=0;
    $where['pflag']=0;
   $num= T('product')->set_where($where)->get_count();
   return $num;
}
  public function getcsnum($muid){
    if(!$muid)return false;
    $where['muid']=$muid; $where['temptype']=1;
    $where['shelves']=1;
    $where['status']=0;
    $where['pflag']=1;
   $num= T('product')->set_where($where)->get_count();
   return $num;
}
  public function getwgnum($muid){
    if(!$muid)return false;
    $where['muid']=$muid; $where['temptype']=1;
    $where['shelves']=0;
    $where['status']=3;
    $where['pflag']=1;
   $num= T('product')->set_where($where)->get_count();
   return $num;
}
public function getxxnum($uid){
    if(!$uid)return false;
   
    $where['uid']=$uid;
    $where['udel']=0;
    $where['uread']=0;
   
   $num= T('sysmsg')->set_where($where)->get_count();
   return $num;
}

public function getoallnum($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    $where['sdelflag']=0;
    $where['status']=3;
   
   $num= T('order')->set_where($where)->get_count();
   return $num;
}
public function getowfknum($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    $where['sdelflag']=0;
    $where['status']=0;
   
   $num= T('order')->set_where($where)->get_count();
   return $num;
}
public function getoyfknum($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    $where['sdelflag']=0;
    $where['status']=1;
   
   $num= T('order')->set_where($where)->get_count();
   return $num;
}
public function getoyfhnum($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    $where['sdelflag']=0;
    $where['status']=2;
   
   $num= T('order')->set_where($where)->get_count();
   return $num;
}
public function getothnum($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    $where['sdelflag']=0;
    $where['status']=5;
   
   $num= T('order')->set_where($where)->get_count();
   return $num;
}
public function getopjnum($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    $where['sdelflag']=0;
    $where['status']=3;
    $where['scflag']=0;
   
   $num= T('order')->set_where($where)->get_count();
   return $num;
}
public function getodoingnum($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    $where['sdelflag']=0;
    $where['status']=array(0,1,2);
    
   
   $num= T('order')->set_where($where)->get_count();
   return $num;
}
public function getocashall($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
   
    $where['status']=3;
    
   
   $num= T('order')->set_where($where)->set_field('sum(totals) as num')->get_one();
   return $num['num'];
}
public function getocashsjall($muid){
    if(!$muid)return false;
   
    $where['muid']=$muid;
    
    $where['status']=3;
   $num= T('order')->set_where($where)->set_field('sum(paytotal) as num')->get_one();
   $num2= T('order')->set_where($where)->set_field('sum(tksums) as num')->get_one();
   return $num['num']-$num2['num'];
}
}

?>
