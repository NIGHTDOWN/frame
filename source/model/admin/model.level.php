<?php




checktop();

class levelModel extends Y
{
    private $info;
    private $tree;
    private $locklevelcheck = 'locklevelcheck';
    private $level1cash = 8000;
    public function load($uid)
    {
        $where = array('flag'=>0,'exit'=>0,'uid' =>$uid);
        $info = T('user')->set_field(array('level','treeid','v.uid'))->join_table(array('t'=>'user_tree','uid','uid'),1)->get_one($where);
        if (!$info)return false;
        if ($info['level'] >= 6)return false;
        list($bool,$data) = Y::$cache->get($this->locklevelcheck);
        if (!$data) {
            YLog::txt('用户家族升级开启');
            Y::$cache->set($this->locklevelcheck,1);
            $this->info = $info;
            $this->treecheck();
            Y::$cache->set($this->locklevelcheck,0);
            YLog::txt('用户家族升级结束');
        }else {

            YLog::txt('用户家族检测锁定');
            error('用户家族检测锁定');
        }
    }
    

    private function treecheck($max = 100)
    {

        $tree = explode(G_BREAK,$this->info['treeid']);
        $size = count($tree);

        $bystr= implode(',',$tree);
        $users= T('user')->set_field(array('uid','level'))->set_where(" `uid` in ($bystr) and `exit`=0 and `flag`=0")->order_by("field(`uid`,$bystr) desc")->set_limit($max)->get_all();

        foreach ($users as $user) {
            if ($this->isup($user['uid'],$user['level'])) {
                $insert = array('level'=>(intval($user['level']) + 1));
                $where = array('uid'=>$user['uid']);
                T('user')->update($insert,$where);
            }else {
                
                break;
            }
        }
        return true;
    }
    
    private function isup($uid,$level)
    {
        if (!$uid)return false;
        if ($level >= 6 || $level < 0)return false;
        $where = array('uid'=>$uid);

        switch ($level) {
            case '0':
            $where['status'] = 1;
            $info = T('lh')->set_field('sum(cash) as count',0)->get_one();

            if (!$info)return false;
            $cash = $info['count'];
            if ($cash >= $this->level1cash) return true;
            break;
            case '1':
            $count = $this->count($uid,$level);
            if ($count >= 5)return true;
            break;
            case '2':
            $count = $this->count($uid,$level);
            if ($count >= 3)return true;
            break;
            case '3':
            $count = $this->count($uid,$level);
            if ($count >= 3)return true;
            break;
            case '4':
            $count = $this->count($uid,$level);
            if ($count >= 3)return true;
            break;
            case '5':   $count = $this->count($uid,$level);
            if ($count >= 3)return true;break;

        }
        return false;
    }
    private function count($uid,$level)
    {
        $mod = T('user');
        return  $mod->set_where(array('gid'  =>$uid,'level'=>$level))->get_count();
    }
}

?>
