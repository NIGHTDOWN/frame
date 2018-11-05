<?php




checktop();
class mlogModel extends Y {
 
     private $loop = true;
    private $db_name = 'mlog';
    
    
    public
    function log2($uid,$to = null,$num = null,$mark = null)
    {
        $c = D_MEDTHOD;
        $a = D_FUNC;
        if (!$uid || !$num )return 0; 
        
        $mptotal = T('user')->set_field(array('mcash'))->set_where(array('uid'=>$uid),'=')->get_one();

        $mptotal = $mptotal['mcash'];
        $log_arr['cash'] = $num;
        $log_arr['addtime'] = $_SERVER['REQUEST_TIME'];
        $log_arr['uid'] = $uid;
        $log_arr['oid'] = $to;
        
        $type = ($num > 0)?1:0;
        $num  = abs($num);
        if ($to) {
            if ($type) {
                $onum =-$num;
            }else {
                $onum = $num;
            }
			
		
            if ($this->loop) {
                $this->loop = false;
                $this->log2($to,$uid,$onum,$mark);
            }
            $come = T('user')->set_field(array('username'))->set_where(array('uid'=>$to),'=')->get_one();
            $come = $come['username'];

        }else {
            $come = '系统';
        }
        if ($type) {
            $mp    = $mptotal + $num;
            $mark1 = "获得来自{$come}{$num}个排单币,";
        }else {
            $mp = $mptotal - $num;
            if ($to) {
                $iii = '转账';
            }else {
                $iii = '消耗';
            }
            $mark1 = "{$iii}{$num}个排单币于{$come},";
        }
        $log_arr['mark'] = $mark1.$mark;
        $log_arr['mcash'] = $mp;
        $mp = array('mcash'=>$mp);
        $flag1 = T('user')->updata(array('v'=>$mp,'w'=>array('uid'=>$uid)));
        $flag2 = T($this->db_name)->add($log_arr);

        return $flag1 && $flag2;
    }
 
 
 
 
 
 
 
 
 
    
 /*   public function balance($oid){
        $mod=T('out');
        $w=array('oid'=>$oid);
        $info=$mod->get_one($w);
        if($info['status']!=1)return false;
        $bj=$info['cash'];
      
       
       $lx=$info['rate'];
        $s=$lx+$bj;
        $mark="";
        $this->add($info['uid'],$s,$mark);
    }*/
    public function add($uid,$cash,$mark){
        $w=array('uid'=>$uid);
        if($cash<0){
            $fh='-';
            $type=0;
        }else{
            $fh='+';
            $type=1;
        }
        $in=array('mcash'=>"mcash{$fh}".abs($cash));
        $this->log($uid,$cash,$mark);
        T('user')->update($in,$w,0);
  
    }
    public function log($uid,$cash,$mark){
        $u=userinfo($uid);
        $in=array('uid'=>$uid,'cash'=>$cash,'addtime'=>time(),'mark'=>$mark,'mcash'=>$u['mcash']);
        T('mlog')->add($in);
    } 














}
?>
