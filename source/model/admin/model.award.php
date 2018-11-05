<?php


checktop();
class awardModel extends Y
{
    private $info;
    private $nowlevel = 0;
    private $rate = array(1=>7,2=>4,3=>2,4=>1,5=>0.5,6=>0.05,7=>0.01);
    public function load($lid)
    {
        $where = array('status'=>0,'lid'   =>$lid);
        $info = T('lh')->set_field(array('username','user.gid','cash','lid','treeid','v.uid'))->join_table(array('t'=>'user','uid','uid'),1)->join_table(array('t'=>'user_tree','uid','uid'),1)->get_one($where);
        if (!$info)return false;
        $this->info = $info;
        $this->nowlevel=$info['level'];
        $this->recommend();
        $this->management();
        $this->end();
    }
    private function end()
    {
        return  T('lh')->update(array('status'=>1,'etime' =>$_SERVER['REQUEST_TIME']),array('lid'=>$this->info['lid']));
    }
    
    private function recommend()
    {
        YLog::txt('推荐奖励结算');
        $money      = $this->info['cash'];
        $rate       = Y::$conf['zt_rate'];
        $sourceuser = $this->info;
        $uid        = $this->info['gid'];
        $userinfo   = userinfo($uid);
        $award      = $money * $rate;
        $rmb_f      = rmb($money);
        $award_f    = rmb($award);
        $mark       = "获取来自下级{$sourceuser['username']}舍得循环直推奖励;用户参与循环金额 RMB{$rmb_f};获得推荐奖励 RMB{$award_f}（发放至M钱包）";
        M('mlog','am')->addm($uid,$award,2,$mark);
        
        T('lh')->update(array('reward'=>$uid),array('lid'=>$this->info['lid']));
        return true;
    }
    
    private function management()
    {

        YLog::txt('管理奖励结算');
        $tree = explode(G_BREAK,$this->info['treeid']);
        $size = count($tree);
        if ($size < 2) {
            YLog::txt('用户家族太小无团队奖励');
            error('用户家族太小无团队奖励');
        }
        unset($tree[($size - 1)]);
        unset($tree[($size - 2)]);
        $bystr = implode(',',$tree);
        $users = T('user')->set_field(array('uid','level'))->set_where(" `uid` in ($bystr) and `exit`=0 and `flag`=0")->order_by("field(`uid`,$bystr) desc")->get_all();
        $rewardarr = array('reward1'=>0,'reward2'=>0,'reward3'=>0,'reward4'=>0,'reward5'=>0,'reward6'=>0,'reward7'=>0);
        $cash       = $this->info['cash'];
        $sourceuser = $this->info;
        $mod        = M('mlog','am');
        $cash_f     = rmb($cash);
        foreach ($users as $user) {
            $level = $user['level'];
            $uid   = $user['uid'];
            if ($level < 0) {
                break;
            }
            if ($this->loopcheck($level)) {
                
                if ($level <= 6 && $rewardarr['reward6'] == 0) {
                    
                    $rate    = ($this->rate[$level]) / 100;
                    $money   = $cash * $rate;
                    $money_f = rmb($money);
                    $mark    = "获取来自下级{$sourceuser['username']}舍得循环管理奖励;用户参与循环金额 RMB{$cash_f};获得管理奖励 RMB{$money_f}（发放至M钱包）";
                    $mod->addm($uid,$money,1,$mark);
                    $rewardarr['reward'.$level] = $uid;
                }else
                if ($level = 6 && $rewardarr['reward6'] != 0 && $rewardarr['reward7'] == 0) {
                    
                    $rate    = ($this->rate[7]) / 100;
                    $money   = $cash * $rate;
                    $money_f = rmb($money);
                    $u6      = userinfo($rewardarr['reward6'],'username');
                    $mark    = "获取来自隶属{$u6}下级{$sourceuser['username']}舍得循环市场奖励;用户参与循环金额 RMB{$cash_f};获得市场奖励 RMB{$money_f}（发放至M钱包）";
                    $mod->addm($uid,$money,1,$mark);
                    $rewardarr['reward7'] = $uid;
                }
            }
        }
        T('lh')->update($rewardarr,array('lid'=>$this->info['lid']));
        return true;
    }
    
    private function loopcheck($level)
    {
        if (!$level)return false;
       
        if ($level > $this->nowlevel) {
            $this->nowlevel = $level;
            return true;
        }
        if ($level == $this->nowlevel && $level = 6) {
            $this->nowlevel = $level + 1;
            return true;
        }
        return false;
    }

}
?>
