<?php


namespace ng169\hook;

checktop();
use ng169\tool\Yurl;
function url($params)
{
	
    if (!empty($params)) {
        @extract($params);
        $source=$params['source'];
        $args = $params['args']?$params['args']:$params['agrs'];
       
         $args1 = $params['args1']?$params['args1']:$params['agrs1'];
          $args2 = $params['args2']?$params['args2']:$params['agrs2'];
        $filter=$params['filter'];
        $filter=tplarray($filter);
        $args=tplarray($args);
        $args=$args?$args:array();
       
         $args1=tplarray($args1);
        $args1=$args1?$args1:array();
        
         $args2=tplarray($args2);
        $args2=$args2?$args2:array();
         
        if($source){
            $source=Y::$wrap_where;
        }
        if($filter && !is_array($filter)){
            unset($source[$filter]);
        }elseif($filter && is_array($filter)){
            foreach($filter as $f){
                unset($source[$f]);
            }
        }
        if(is_array($source)&&is_array($args)){
            $args=array_merge($source,$args);
        }
        if(is_array($args1)&&is_array($args)){
            $args=array_merge($args1,$args);
        }
         if(is_array($args2)&&is_array($args)){
         	
            $args=array_merge($args2,$args);
        }
        $action = (trim($params['action']));
        $mod = (trim($params['mod']));
        $type = (trim($params['group']));
        $ip = (trim($params['ip']));
        
        return YUrl::url($args, $action, $mod, $type,$ip);
    }
    return YUrl::url();
}


TPL::regFunction('url', 'url');



?>
