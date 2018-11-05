<?php




checktop();
class productModel  extends Y {
    public function add($muid,$catid,$detail,$props,$sku){
    	if(!$muid)return false;
    	if(!$catid)return false;
    	if(!$detail)return false;
    	
    	/*$insert=get(array('string'=>array('productname'=>1,'content'=>'html','smallimg1'=>1,'unit'=>1,'price'=>1,'smallimg2','smallimg3','smallimg4','smallimg5'),'int'=>array('logistempid'=>1,'weight','cubage','invoice'=>1,'shelves'=>1,'melite'=>1,'count'=>1)));*/
		
		$insert['price']=$detail['price'];
		$insert['temptype']    = 1;
		$insert['shelves']    = 1;
		$insert['count']    = $detail['num'];
		$insert['tbprice']    = $detail['tbprice'];
		$insert['tbid']    = $detail['tid'];
		$isadd=T('product')->get_one(array('tbid'=>$detail['tid']));
		if($isadd)return true;
		if(parent::$conf['auto_check_pro']){
			$insert['pflag']    = 1;
		}else{
			$insert['pflag']    = 0;
		}
		
		
		$insert['addtime']    = time();
		$insert['smallimg1']    = $detail['images'][0];
		$insert['smallimg2']    = $detail['images'][1];
		$insert['smallimg3']    = $detail['images'][2];
		$insert['smallimg4']    = $detail['images'][3];
		$insert['smallimg5']    = $detail['images'][4];
		$insert['muid']    = $muid;
		$insert['catid']    = $catid;
		if(!$detail['title'])return false;
	$insert['productname']=tohex($detail['title']);
	$insert['metatitle']=($detail['title']);
	$insert['metadesc']=($detail['desc']);
	$insert['content']=($detail['content']);
	
	
		$flag   = T('product')->add($insert);
	
		if($flag && $props){
			/*$attribute=get(array('array'=>array('aname','avalue','weights')));*/
			$attribute=$props;
			/*T('product_attribute')->del($where);*/
			if(is_array($props)){
					
				
				foreach($props as $k=>$list){
					$index=array_keys($list);
					/*d($index);*/
					$l=array();
					$l['productid']=$flag;
					$l['aname']=$index[0];
					$l['avalue']=$list[$index[0]];
					
					if($k<5){
						/*$key=intval($attribute['weights'][$k]);
						if($key<=5 && $key>=1){*/
							$index2='att'.($k+1);
						$inatt[$index2]=$list[$index[0]];
					/*	}*/
						/*$index='att'.($attribute[$k]['weights']);
						$inatt[$index]=$attribute['avalue'][$k];*/
					}
					
					
					T('product_attribute')->add($l);
				}}
				$inatt['productid']=$flag;
				T('product_attr')->add($inatt);
				
			/*$attribute=get(array('array'=>array('sname','svalue')));*/
			/*T('product_specs')->del($where);*/
			
			if(is_array($sku)){
				$i=0;
				foreach($sku as $k=>$list){
					
					if($i>=6){break;}
					$i++;
					$l=array();
					$l['productid']=$flag;
					$l['sname']=$k;
					$l['svalue']=$list;
				
					T('product_specs')->add($l);
				}
			}
    	M('mcount','im')->addprocount($muid);
    	return true;
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
		
	}
 }
public function update_content($product_tid,$tb_content){
	$data=T('product')->set_where('tbid='.$product_tid)->get_all();
	$up=array();
	
	foreach($data as $i=>$list){
		
		$productid=$list['productid'];
		if($i==0){
			if($list['content']==''){
				$up['content']=$tb_content['content'];
			}
			if($list['smallimg1']==''){
				$up['smallimg1']=$tb_content['images'][0];
			}
			if($list['smallimg2']==''){
				$up['smallimg2']=$tb_content['images'][1];
			}
			
			if($list['smallimg3']==''){
				$up['smallimg3']=$tb_content['images'][2];
			}
			if($list['smallimg4']==''){
				$up['smallimg4']=$tb_content['images'][3];
			}
			if($list['smallimg5']==''){
				$up['smallimg5']=$tb_content['images'][4];
			}
			if($list['productname']==''){
				$up['productname']=tohex($tb_content['title']);
			}
			
			if(sizeof($up)>0){
				T('product')->update($up,array('productid'=>$productid));	
			}
		
		}else{
			$this->del($productid);
		}
	}
}
public function del($pid){
	if(!$pid)return FALSE;
	$where=array('productid'=>$pid);
	
	if(!$pid)return false;
	$data=T('product')->get_one($where);
	if(!$data)return false;
	T('product')->del($where);
	T('product_attribute')->del($where);
	T('product_attr')->del($where);
	T('product_specs')->del($where);
	
	M('mcount','im')->delprocount($data['muid']);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
}
?>
