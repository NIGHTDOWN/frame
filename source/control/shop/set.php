<?php


namespace ng169\control\shop;

use ng169\control\shopbase;


checktop();
class set extends shopbase{

	public
	function control_run(){
		$info=T('merchant')->join_table(array('t'=>'merchant_category','catid','catid'))->get_one(array('muid'=>$this->get_muid()));
		if($_POST){
			
			$get=get(array('string'=>array('merchantname'=>1,'licence','intro','logo','header','provinceid','cityid','areaid','address','phone')));
			$f=T('merchant')->update($get,array('muid'=>$this->get_muid()));
			if($f){
				out('更新成功');
			}else{
				error('保存失败');
			}
		}
		
		
		$this->view(null, array('data'=>$info));
	}
	public
	function control_mobile(){
		$info=T('merchant')->get_one(array('muid'=>$this->get_muid()));
		if($_POST){
			
			$get=get(array('string'=>array('mstorepic'=>1,'mbanner'=>1)),array('店招','手机店铺Banner'));
			$f=T('merchant')->update($get,array('muid'=>$this->get_muid()));
			if($f){
				out('更新成功');
			}else{
				error('保存失败');
			}
		}
		
		
		$this->view(null, array('data'=>$info));
	}
	public
	function control_del(){
		$get=get(array('int'=>array('kfid'=>1)));
		$get['muid']=$this->get_muid();
		T('kf')->del($get);
		out('删除成功');
	}
	public
	function control_kf(){
		$info=T('kf')->get_all(array('muid'=>$this->get_muid()));
		if($_POST){
			
			$get=get(array('array'=>array('name','num','type','stime','etime')));
			$get2=get(array('array'=>array('kfid')));
			if(sizeof($get['name'])>5){
				error('只能添加5个客服');
			}
			$i=1;
			foreach($get['name'] as $k=>$v){
				if($i>5)break;
				$i++;
					$insert=array('muid'=>$this->get_muid(),'name'=>$v,'num'=>$get['num'][$k],'type'=>$get['type'][$k],'stime'=>($get['stime'][$k]),'etime'=>($get['etime'][$k]));
					
				if(is_int($k)){
				T('kf')->add($insert);
				}else{
					
					$w=array('kfid'=>$get2['kfid'][$k],'muid'=>$this->get_muid());
				
					T('kf')->update($insert,$w);
				}
			}
			
		out('保存成功');
		}
		$this->view(null, array('data'=>$info));
	}
	
	public function control_qr(){
      
		$myurl=geturl(array('id'=>$this->get_muid()),null,'shop','index');
		M('qr','im')->get($myurl);
	}
}
?>
