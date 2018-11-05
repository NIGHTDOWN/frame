<?php



checktop();
class queueModel extends Y {
    public function start($id,$fromtype){
        if(!$id)return false;
        switch ($fromtype)
        {
            case 'out':
                
                $info=$this->_out($id); 
                if(!$info)return false;
                
                
                
                
                if($info['status'])return true;   
                if(($info['addtime']+Y::$conf['pd_min_time']*3600*24)>time())return false;
                if($this->queueoutm()<$this->queueinm())return false;
                if($this->queueoutp()<(Y::$conf['pre_queue_min']+1))return false;
                $payob= T('pay');
                $where=array('oid'=>$id,'flag'=>array(0,1,2,3));
                $field='sum(cash)';
                $cash=$payob->set_where($where)->set_field($field,0)->get_count(null,0);
                $js=10*floor($info['cash']/(Y::$conf['pre_queue_min']*10));

                if($cash==$info['cash']){
                    $flag=-1;
                    $v2=$where;
                    $v2['type']=0;
                    $d=$payob->get_all($v2);
                    if(!$d)return false;
                    foreach($d as $v){
                        if($flag<0){
                            $flag=$this->start($v['iid'],'in');
                        }else{
                            $flag=($this->start($v['iid'],'in'))&&$flag;
                        }
                    }
                    if(1){
                        T('pay')->update(array('addtime'=>time()),array('oid'=>$id,'flag'=>0));
                        $rate=(Y::$conf['pd_rate'])*floor((time()-$info['addtime'])/(3600*24));
                        T('out')->update(array('status'=>3,'rate'=>$rate,'ptime'=>time()),array('oid'=>$id));
                        return true;
                    }else{
                        return false;
                    }
                }
                $cash=$info['cash']-$cash;
                
                $numde=$this->queueinp();
                $fromid=$info['uid'];
                $oid=$info['oid'];
                
                if(($cash/2)<$js && !$numde ){
                    $touid=$this->_get_sys_uid();
                    M('pay','am')->pay($fromid,$touid,$cash,$oid); 
                }elseif(($cash/2)<$js && $numde){
                    
                    $oo=$this->_getbeforepayman($oid);
                    $d=$this->getdetop($oo);
                    if(!$d){
                        $touid=$this->_get_sys_uid();
                        M('pay','am')->pay($fromid,$touid,$cash,$oid); 
                    }
                    $f=M('pay','am')->pay($fromid,$d['uid'],$cash,$oid,$d['iid']); 
                    if($f){
                        $this->start($d['iid'],'in');
                    }
                }else{
                    
                    $oo=$this->_getbeforepayman($oid);
                    $d=$this->getdetop($oo);
                    $f=M('pay','am')->pay($fromid,$d['uid'],$js,$oid,$d['iid']); 
                    if(!f){
                        $touid=$this->_get_sys_uid();
                        M('pay','am')->pay($fromid,$touid,$js,$oid); 
                    }
                    if($f){
                        $this->start($d['iid'],'in');
                    }
                }   
                break;
            case 'in':
               
                $info=$this->_in($id);
              
                if(!$info)return false;
                if($info['status'])return true; 
                if($this->queueoutm()<$info['cash'])return false;
                if($this->queueoutp()<(Y::$conf['pre_queue_min']+1))return false;
              
                $payob= T('pay');
                $where=array('iid'=>$id,'flag'=>array(0,1,2,3));
                $field='sum(cash)';
                $cash=$payob->set_where($where)->set_field($field,0)->get_count();
               
                if($cash==$info['cash']){
                    $flag=-1;
                    $where=array('iid'=>$id,'flag'=>array(0,1,2,3),);;
                    $d=$payob->get_all($where);
                    if(!$d)return false;
                    foreach($d as $v){
                        if($flag<0){
                            $flag=$this->start($v['oid'],'out');
                        }else{
                            $flag=($this->start($v['iid'],'in'))&&$flag;
                        }
                    }
                    if(1){
                        T('pay')->update(array('addtime'=>time()),array('iid'=>$id,'flag'=>0));
                        return  T('in')->update(array('status'=>3),array('iid'=>$id));
                    }else{
                        return false;
                    }
                }
                $cash=$info['cash']-$cash;
               
                if(!$this->queueoutp()){
                    return false;
                }
                
                
                $js=10*floor((Y::$conf['pre_mp'])/(Y::$conf['pre_queue_min']*10));
                if(($cash/2)<$js){
                    $pay=$cash;
                }else{
                    $pay=$js;
                }
                $aa=$this->_getbeforerecvman($info['iid']);
                $oid=T('out')->join_table(array('t'=>'pay','oid','oid'))->set_field('v.*,(v.cash-sum(pay.cash)) as npay')->set_where(array('addtime'=>(time()-(Y::$conf['pd_min_time']*3600*24))),'<')->group_by('pay.oid')->set_global_where(array('uid'=>$aa,),'!=',null,null,1,0)->order_by(array('f'=>array('addtime'),'s'=>'up'))->get_all();
                foreach($oid as $k=>$v){
                    if((($v['npay']!=null) && $v['npay']<$pay) || $v['npay']=='0')
                    { 
                        unset($oid[$k]);
                    }
                }
             
                $i=mt_rand(0,sizeof($oid));
                $oid=$oid[$i];
                if(!$oid)return false;
                M('pay','am')->pay($oid['uid'],$info['uid'],$pay,$oid['oid'],$info['iid']);
                
                $this->start($oid['oid'],'out');
                break;
        }
        return true;
        $this->start($id,$fromtype);
    }
    private function getdetop($uid=null){
        $mod=T('in'); 
        $where=array('status'=>0);
        $mod=$mod->order_by(array('f'=>array($mod->get_primarykey()),'f'=>'down'))->set_where($where)->group_by('uid');
        if($uid){
            $filter=array('uid'=>$uid);
            $mod=$mod->set_global_where($filter,'!=',null,null,1,0);
        }
        
        $i=$mod->get_all();
        
        $size=sizeof($i);
        if($size>0){
            $b=mt_rand(0,$size-1);
            return $i[$b];
        }else{
            return false;
        }
    }
    private function _get_sys_uid(){
        $mod=T('user')->set_field(array('uid'))->set_where(array('type'=>1));
        $data=$mod->get_all();
        $num=sizeof($data);
        $zz=mt_rand(0,$num);
        $info=$data[$zz]['uid'];
        return $info;
    }
    
    public function _getbeforepayman($oid){
        $v=array('oid'=>$oid);
        $o= T('out')->get_one($v);
        $ob=T('pay')->set_field(array('v.touid'=>'uid'))->set_where($v)->get_all();
        $out=array($o['uid']);
        if($ob){
            foreach($ob as $v){
                array_push($out,$v['uid']);
            }
        }
        return $out;
        
    }

    public function _getbeforerecvman($iid){
        $v=array('iid'=>$iid);
        $o= T('in')->get_one($v);
        $ob=T('pay')->set_field(array('v.fromuid'=>'uid'))->set_where($v)->get_all();
        $out=array($o['uid']);
        if($ob){
            foreach($ob as $v){
                array_push($out,$v['uid']);
            }

            
        }
        return $out;
        
        
    }
    
    
    public function queueinp(){
        $mod=T('in'); 
        
        $where=array('status'=>0);
        return $mod->get_count($where);
    }
    
    public function queueoutp(){
        $mod=T('out'); 
        
        $where=array('status'=>0,'addtime'=>array(0,time()-Y::$conf['pd_min_time']*3600*24));
        return $mod->get_count($where);
    }
    
    public function queueinm(){
        $mod=T('in')->set_field('SUM(cash)'); 
        
        $where=array('status'=>0);
        return $mod->get_one($where);
    }
    
    public function queueoutm(){
        
        $mod=T('out')->set_field('SUM(cash)'); 
        
        
        $where=array('status'=>0,'addtime'=>array(0,time()-Y::$conf['pd_min_time']*3600*24));
        return $mod->get_one($where);
    }
    private function _in($id){
        $mod=T('in');
        return  $info=$mod->get_one(array('iid'=>$id));
    }
    
    private function _out($id){
        
        $mod=T('out');
        return  $info=$mod->get_one(array('oid'=>$id));
    }
}
?>
