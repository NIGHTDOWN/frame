<?php




checktop();
class seoModel extends Y {
    public function getlist(){
        $seo= T('seo');
        
        $info=array();
        $mod_index=get_mod('index');
        foreach($mod_index as $key=>$val){
            foreach($val['action'] as $v=>$v2){
                if($v2['seo']){
                $idenfity=$key.'_'.$v;
                $db= $seo->get_one(array('identify'=>$idenfity));
                $info[$idenfity]=$db;
                }
            }
        }
        
        
        return $info;
        

    }
    public function getone($where){
        $seo=T('seo');
        return $seo->get_one($where);
    }
    public function del($where){
        
    }
    public function save($inset,$where){
        $seo=T('seo');
        if($seo->check_exist($where)){
            $b=$seo->updata(array('v'=>$inset,'w'=>$where));
        
        }else{
            $b=$seo->add(array_merge($inset,$where));
        }
        M('log','am')->log($b,$where,$insert);
        return $b;
    }
  
}
?>
