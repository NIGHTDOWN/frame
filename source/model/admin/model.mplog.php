<?php




checktop();

class mplogModel extends Y
{
    private $loop = true;
    private $db_name = 'mp';
    
    
    public
    function log($uid,$to = null,$num = null,$mark = null)
    {
        $c = D_MEDTHOD;
        $a = D_FUNC;
        if (!$uid || !$num )return 0; 
        
        $mptotal = T('user')->set_field(array('mp'))->set_where(array('uid'=>$uid),'=')->get_one();

        $mptotal = $mptotal['mp'];
        $log_arr['num'] = $num;
        $log_arr['addtime'] = $_SERVER['REQUEST_TIME'];
        $log_arr['uid'] = $uid;
        $log_arr['to'] = $to;
        
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
                $this->log($to,$uid,$onum,$mark);
            }
            $come = T('user')->set_field(array('username'))->set_where(array('uid'=>$to),'=')->get_one();
            $come = $come['username'];

        }else {
            $come = '系统';
        }
        if ($type) {
            $mp    = $mptotal + $num;
            $mark1 = "获得来自{$come}{$num}张门票,";
        }else {
            $mp = $mptotal - $num;
            if ($to) {
                $iii = '转账';
            }else {
                $iii = '消耗';
            }
            $mark1 = "{$iii}{$num}张门票于{$come},";
        }
        $log_arr['mark'] = $mark1.$mark;
        $log_arr['mp'] = $mp;
        $mp = array('mp'=>$mp);
        $flag1 = T('user')->updata(array('v'=>$mp,'w'=>array('uid'=>$uid)));
        $flag2 = T($this->db_name)->add($log_arr);

        return $flag1 && $flag2;
    }
}
?>
