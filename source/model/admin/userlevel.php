<?php


namespace ng169\model\admin;
use ng169\Y;


checktop();
class userlevel extends Y {
 //
    public function getlevel($level){
     
       if($level>=0 &&$level<=10 ){
	   	return 1;
	   }
	   elseif($level>10 &&$level<=40 ){
	   	return 2;
	   }
	   elseif($level>40 &&$level<=160 ){
	   	return 3;
	   }
	   elseif($level>160 &&$level<=800 ){
	   	return 4;
	   }
	 elseif($level>800 &&$level<=4800 ){
	   	return 5;
	   }
	    elseif($level>4800 &&$level<=9600 ){
	   	return 6;
	   }
	    elseif($level>9600 &&$level<=28800 ){
	   	return 7;
	   }
	    elseif($level>28800 &&$level<=115200 ){
	   	return 8;
	   }
	    elseif($level>115200 &&$level<=576000 ){
	   	return 9;
	   }
	    elseif($level>576000 &&$level<=2880000 ){
	   	return 10;
	   }
	    elseif($level>2880000 &&$level<=5760000 ){
	   	return 11;
	   }
	    elseif($level>5760000 &&$level<=17280000 ){
	   	return 12;
	   }
	    elseif($level>17280000 &&$level<=69120000 ){
	   	return 13;
	   }
	    elseif($level>69120000 &&$level<=345600000 ){
	   	return 14;
	   }
	  
	   elseif($level>=345600000){
	   	return 15;
	   }else{
	   	return false;
	   }
	   return false;
    }
    public function getlevelimg1($muid){
    	 $w=array('uid'=>$muid);
       $info= T('user')->set_field('ugood,ubad')->get_one($w);
      
       if(!$info)return false;
       $level=$info['ugood']-$info['ubad'];
      $l=$this->getlevel($level);
     
      if(!$l)return FALSE;
      return G_STATIC.'/images/user/'.$l.'.gif';
    }
     public function getlevelimg2($ugood=null){
    	 
       
      $l=$this->getlevel($ugood);
     
      if(!$l)return FALSE;
      return G_STATIC.'/images/user/'.$l.'.gif';
    }
    public function getlevelimg($muid){
      	$w=array('uid'=>$muid);
       	$info= T('user')->get_one($w);
      
       	if(!$info['ulevel'])return G_STATIC.'/images/user/1.gif';
     	return G_STATIC.'/images/user/vs'.$info['ulevel'].'.gif';
    }
 
}
?>