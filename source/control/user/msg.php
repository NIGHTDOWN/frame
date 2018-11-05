<?php

checktop();
class control extends userbase
{
	public function control_creat()
	{
		$guid = get(array('int'=>array('muid'=>1)));
		$merinfo=T('merchant')->set_field('uid,merchantname')->get_one($guid);
		if(!$merinfo)error('聊天对象不存在');
		$uid = $this->get_userid(1);
		if($uid == $merinfo['uid'])
		{
			error('不能跟自己交谈');
		}
		$w1['uid']=$uid;
		$w1['touid']=$merinfo['uid'];
		$w2['uid']=$merinfo['uid'];
		$w2['touid']=$uid;
		$cheatid=T('cheatlist')->get_one($w1);
		if(!$cheatid)
		{$cheatid=T('cheatlist')->get_one($w2);
		}
		if(!$cheatid){
			$insert['uid']=$uid;
			$insert['u1name']=parent::$wrap_user['nickname'];
			$insert['u2name']=$merinfo['merchantname'];
			$insert['touid']=$merinfo['uid'];
			$insert['addtime']=time();
			$insert['chtime']=time();
			$iid=T('cheatlist')->add($insert);
			$id=$iid;
		}else{
			$id=$cheatid['id'];
			$insert['chtime']=time();
			T('cheatlist')->update($insert,array('id'=>$id));
		}
		gourl(geturl(array('id'=>$id),null,'msg','user'));
		
	}
public function control_cheat()
	{
		$guid = get(array('string'=>array('user'=>1)),array('user'=>'聊天对象'));
		$merinfo=T('user')->set_field('uid,username,nickname')->set_where(array('username'=>$guid['user']),'=')->get_one();
		if(!$merinfo)error('聊天对象不存在');
		$uid = $this->get_userid(1);
		if($uid == $merinfo['uid'])
		{
			error('不能跟自己交谈');
		}
		$w1['uid']=$uid;
		$w1['touid']=$merinfo['uid'];
		$w2['uid']=$merinfo['uid'];
		$w2['touid']=$uid;
		$cheatid=T('cheatlist')->get_one($w1);
		if(!$cheatid)
		{$cheatid=T('cheatlist')->get_one($w2);
		}
		if(!$cheatid){
			$insert['uid']=$uid;
			$insert['u1name']=parent::$wrap_user['nickname']?parent::$wrap_user['nickname']:parent::$wrap_user['username'];
			$insert['u2name']=$merinfo['nickname']?$merinfo['nickname']:$merinfo['username'];
			$insert['touid']=$merinfo['uid'];
			$insert['addtime']=time();
			$insert['chtime']=time();
			$iid=T('cheatlist')->add($insert);
			$id=$iid;
		}else{
			$id=$cheatid['id'];
			$insert['chtime']=time();
			T('cheatlist')->update($insert,array('id'=>$id));
		}
		gourl(geturl(array('id'=>$id),null,'msg','user'));
		
	}
	public function control_run()
	{
		$c     = D_MEDTHOD;
		$a     = D_FUNC;

		$get=get(array('int'=>array('id')));
		if($get['id']){
		$select=T('cheatlist')->get_one($get);
		$uid=$this->get_userid(1);
		if($select['uid']!=$uid && $select['touid']!=$uid ){
			$select=null;
		}
		}
		$sq1 = T('cheatlist')->set_field('*')->set_where(array('uid' => $this->get_userid(1)))->get_sql();
		$sq2 = T('cheatlist')->set_field('*')->set_where(array('touid' => $this->get_userid(1)))->get_sql();
		$sql=$sq1 .'union '.$sq2;
		/*$model = $model->order_by(array('f'=> 'id','s'=> 'down'));*/
		
		$model=T(array($sql));
		
		$model = $model;
		
		$page      = $this->make_page($model,null,null,'id',false);
 		$model=$model->order_by(array('f'=> 'chtime','s'=> 'down'));
 		
		$data      = $model->set_limit($this->get_page_limit(),'id')->get_all();

		$var_array = array('data'=> $data,'page'=> $page,'select'=>$select);

		$this->view(null, $var_array);
	}
	public function control_getlast(){
		if(!YUrl::ismoible())error('访问错误');
		$get=get(array('int'=>array('id'=>1)));
		if($get['id']){
		$select=T('cheatlist')->get_one($get);
		$uid=$this->get_userid(1);
		if($select['uid']!=$uid && $select['touid']!=$uid ){
			$select=null;
			error('聊天不存在');
		}
		}else{
			error('错误');
		}
		$datz=T('cheatmsg')->set_where($get)->order_by(array('f'=>'sendtime','s'=>'down'))->get_one();
		if($datz)out($datz);
		error('无数据');
	}
public function control_gethead(){
		
		$get=get(array('int'=>array('uid'=>1)));
		if($get['uid']){
		$select=T('user')->set_field('uid,headimg')->set_where($get)->get_one();
		
		if($select['headimg']!=""){
			out($select['headimg']);
		}}
		
		$defult=G_STATIC."/img/head.png";
		out($defult);
	}
	public function control_show(){
		$get=get(array('int'=>array('id')));
		if($get['id']){
		$select=T('cheatlist')->get_one($get);
		$uid=$this->get_userid(1);
		if($select['uid']!=$uid && $select['touid']!=$uid ){
			$select=null;
			error('聊天不存在');
		}
		}else{
			/*YOut::page404();*/
			return false;
		}
		
		//标记已读
		$this->read($get['id']);
		
		$where=array('id'=>$select['id']);
		$data=T('cheatmsg')->set_limit(40)->set_where($where)->order_by(array('f'=>'sendtime','s'=>'down'))->get_all();
		$data=array_reverse($data);
		$cid=$data[0]['cid'];
		if($cid){
		$data2=T('cheatmsg')->set_limit(array($cid,1),'cid',"<")->set_where($where)->order_by(array('f'=>'sendtime','s'=>'down'))->get_one();	
		}
		
		
		$s[$select['uid']]=$select['u1name'];
		$s[$select['touid']]=$select['u2name'];
		$s['id']=$select['id'];
		$s['dxname']=$select['uid']!=$uid?$select['u1name']:$select['u2name'];
		
		$var_array = array('data'=>$data ,'sname'=>$s,'history'=>$data2,'lastid'=>$cid);
		
		$this->view(null, $var_array);
	}
	public function read($id){
		if($id){
			$get=array('id'=>$id);
		$select=T('cheatlist')->get_one($get);
		$uid=$this->get_userid(1);
		if($select['uid']!=$uid && $select['touid']!=$uid ){
			$select=null;
			error('聊天不存在');
		}
		}
		
		//标记已读
		$mynum=$select['uid']==$uid?1:2;
		$zd='u'.($mynum).'num';
		if($select[$zd]<=0)return false;
		T('cheatlist')->update(array($zd=>0),$get);
	}
	public function control_history(){
		$get=get(array('int'=>array('id'=>1,'cid'=>1)));
		$where=array('id'=>$get['id']);
		if($get['id']){
		$select=T('cheatlist')->get_one($where);
		$uid=$this->get_userid(1);
		if($select['uid']!=$uid && $select['touid']!=$uid ){
			$select=null;
			error('聊天不存在');
		}
		}else{
			YOut::page404();
		}
		$data=T('cheatmsg')->set_limit(array($get['cid'],50),'cid','<')->set_where($where)->order_by(array('f'=>'sendtime','s'=>'down'))->get_all();
		
		$json['data']=($data);
		$json['last']=$data[sizeof($data)-1]['cid'];
		out($json);
	}
	public function control_read(){
		$get=get(array('int'=>array('id'=>1)));
		$this->read($get['id']);
		out('已经阅读了');
	}
	public function control_send(){
		
		$get=get(array('int'=>array('id'=>1),'string'=>array('msg'=>'html')),array('msg'=>'消息'));
		
		
		if(!$get['msg'])error('不能发送空消息');
		if(strlen($get['msg'])>5000)error('消息过长');
		$where=array('id'=>$get['id']);
		if($get['id']){
		$select=T('cheatlist')->get_one($where);
		$uid=$this->get_userid(1);
		if($select['uid']!=$uid && $select['touid']!=$uid ){
			$select=null;
			error('聊天不存在');
		}
		}
		$mynum=$select['uid']==$uid?1:2;
		$i['fid']=$this->get_userid(1);
		$i['sendtime']=time();
		$i['msg']=$get['msg'];
		$i['id']=$select['id'];
		$id=T('cheatmsg')->add($i);
		//未读数量加+1;
		$update['chtime']=time();
		$update['u1num']=$select['u1num']+1;
		$update['u2num']=$select['u2num']+1;
		$update['u'.($mynum).'num']=0;
		
		T('cheatlist')->update($update,$where);
		//聊天时间更新;
		Y::import('socket','lib');
		$i['touid']=$select['uid']==$i['fid']?$select['touid']:$select['uid'];
		$i['name']=$select['uid']==$i['fid']?$select['u1name']:$select['u2name'];
		socketClass::phpsend(getip(),DB_SOCKPOST,array('action'=>'cheat','data'    =>$i));
		/*d(strlen($get['msg']));*/
		out($i);
}
}
