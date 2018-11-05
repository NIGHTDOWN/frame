<?php





checktop();
class serverorderModel extends Y
{
	private $db = 'merchant_server_order';
    private $key='sid';
    private $key2='orderid';
    public function  getinfo($orderid){
        if(!$orderid){error('订单号丢失');}
        $where=array('orderid'=>$orderid);
        $mod=T($this->db);
        $data=$mod->get_one($where);
        if($data){
            return $data;
        }else{
            error('订单不存在');
        }
    }
    public function  uporder($orderid){
        if(!$orderid){error('订单号丢失');}
        $where=array('orderid'=>$orderid);
        $mod=T($this->db);
        $info=$mod->get_one($where);
        if($info['paystatus'] && $info['paytime']){
            closepage();
        }
        $in=array('paystatus'=>1,'paytime'=>time(),'status'=>6);
        $data=$mod->update($in,$where);
        if($data){
            return $data;
        }else{
            error('订单不存在');
        }
    }
    private function _getpower($data,$sourcepower,$nums){
        
        $dc=24*3600;
        
        $long=$data['long']*$nums;
       
        $power=array();
        if($data['xb']){
            
            $power['xb']=1;  
            $power['xblong']= $long;
            if($sourcepower['xb'] && $sourcepower['xbetime']<time()){
                $power['xbetime']+=$dc*$long+$sourcepower['xbetime'];
            }
            
            if($sourcepower['xb'] && $sourcepower['xbetime']>=time()){
                $power['xbetime']=time()+$dc*$long;
                $power['xbtime']=time();
            }
            
            if(!$sourcepower['xb']){
                $power['xbetime']=time()+$dc*$long;
                $power['xbtime']=time();
            }
            
        }
        if($data['smrz']){
            $power['smrz']=1;  
            $power['smrzlong']= $long;
            if($sourcepower['xb'] && $sourcepower['smrzetime']<time()){
                $power['smrzetime']=$dc*$long+$sourcepower['smrzetime'];
            }
            
            if($sourcepower['smrz'] && $sourcepower['smrzetime']>=time()){
                $power['smrzetime']=time()+$dc*$long;
                $power['smrztime']=time();
            }
            
            if(!$sourcepower['smrz']){
                $power['smrzetime']=time()+$dc*$long;
                $power['smrztime']=time();
            }  
            
        }
        if($data['qyrz']){
            $power['qyrz']=1;  
            $power['qyrzlong']= $long;
            if($sourcepower['xb'] && $sourcepower['qyrzetime']<time()){
                $power['qyrzetime']=$dc*$long+$sourcepower['qyrzetime'];
            }
            
            if($sourcepower['qyrz'] && $sourcepower['qyrzetime']>=time()){
                $power['qyrzetime']=time()+$dc*$long;
                $power['qyrztime']=time();
            }
            
            if(!$sourcepower['qyrz']){
                $power['qyrzetime']=time()+$dc*$long;
                $power['qyrztime']=time();
            }    
            
        }
        if($data['vip']){
            
            $power['vip']=1;  
            $power['viplong']= $long;
            if($sourcepower['vip'] && $sourcepower['vipetime']<time()){
                $power['vipetime']=$dc*$long+$sourcepower['vipetime'];
            }
            
            if($sourcepower['vip'] && $sourcepower['vipetime']>=time()){
                $power['vipetime']=time()+$dc*$long;
                $power['viptime']=time();
            }
            
            if(!$sourcepower['vip']){
                $power['vipetime']=time()+$dc*$long;
                $power['viptime']=time();
            }

        }
        if($data['products']){
            
            $power['products']= $data['products']*$nums+$sourcepower['products'];
            
        }
        if($data['servers']){
            $power['servers']= $data['servers']*$nums+$sourcepower['servers'];
            
        }
        if($data['coupons']){
            $power['coupons']= $data['coupons']*$nums+$sourcepower['coupons'];
        }
        if($data['activitys']){
            $power['activitys']= $data['activitys']*$nums+$sourcepower['activitys']; 
        }
        if($data['grouppurchases']){
            $power['grouppurchases']= $data['grouppurchases']*$nums+$sourcepower['grouppurchases'];
        }
        if($data['custommenuflag']){
            
            $power['custommenuflag']=1;  
            $power['custommenuflaglong']= $long;
            if($sourcepower['custommenuflag'] && $sourcepower['custommenuflagetime']<time()){
                $power['custommenuflagetime']+=$dc*$long+$sourcepower['custommenuflagetime'];
            }
            
            if($sourcepower['custommenuflag'] && $sourcepower['custommenuflagetime']>=time()){
                $power['custommenuflagetime']=time()+$dc*$long;
                $power['custommenuflagtime']=time();
            }
            
            if(!$sourcepower['custommenuflag']){
                $power['custommenuflagetime']=time()+$dc*$long;
                $power['custommenuflagtime']=time();
            }
        }
        if($data['custombannerflag']){
            
            $power['custombannerflag']=1;  
            $power['custombannerflaglong']= $long;
            if($sourcepower['custombannerflag'] && $sourcepower['custombannerflagetime']<time()){
                $power['custombannerflagetime']+=$dc*$long+$sourcepower['custombannerflagetime'];
            }
            
            if($sourcepower['custombannerflag'] && $sourcepower['custombannerflagetime']>=time()){
                $power['custombannerflagetime']=time()+$dc*$long;
                $power['custombannerflagtime']=time();
            }
            
            if(!$sourcepower['custombannerflag']){
                $power['custombannerflagetime']=time()+$dc*$long;
                $power['custombannerflagtime']=time();
            }
        }
        if($data['bespokeflag']){
            
            $power['bespokeflag']=1;  
            $power['bespokeflaglong']= $long;
            if($sourcepower['bespokeflag'] && $sourcepower['bespokeflagetime']<time()){
                $power['bespokeflagetime']+=$dc*$long+$sourcepower['bespokeflagetime'];
            }
            
            if($sourcepower['bespokeflag'] && $sourcepower['bespokeflagetime']>=time()){
                $power['bespokeflagetime']=time()+$dc*$long;
                $power['bespokeflagtime']=time();
            }
            
            if(!$sourcepower['bespokeflag']){
                $power['bespokeflagetime']=time()+$dc*$long;
                $power['bespokeflagtime']=time();
            }
        }
     
        return $power;
    }
    
    public function kt($orderid){
        if(!$orderid){error('订单号丢失');}
        $where=array('orderid'=>$orderid);
        $mod=T($this->db);
        $info=$mod->get_one($where);
        if($info['paystatus'] && $info['paytime'] && $info['status']!=5){
            
            $server=T('merchant_server');
            $sid=array('sid'=>$info['sid']);
            $uid=array('muid'=>$info['muid']);
            $sinfo=$server->get_one($sid);
            $storeinfo=T('merchant')->join_table(array('t'=>'store','muid','muid'))->get_one($uid);
            if(!$storeinfo){
                error('账号不存在');
            };
            $p=$this->_getpower($sinfo,$storeinfo,$info['nums']);
            
            
            $mod=T('store');
            $uid=array('muid'=>$info['muid']);
            if($mod->check_exist($uid)){
                $b=$mod->update($p,$uid);  
            }else{
                $b=$mod->add(array_merge($p,$uid));  
            }
            return $b;
            
            
        }
        
        
        
    }
}

?>
