<?php



namespace ng169\model\index;
use ng169\Y;

checktop();

class logisfee extends Y{
	public  function getprice($productid,$num=1){
		$data=T('product')->join_table(array('t'=>'logistemp','logistempid','logistempid'))->get_one(array('productid'=>$productid));
		if(!$data)return false;
		if($data['ltype'])return 0;
		//计价方式：0按件数    1按重量    2按体积',
		/*$money['py']=0;
		$money['ems']=0;*/
		switch($data['pricingmode']){
			case '0':
			if($data['kd']){
				if($num<=$data['kdnum']){
					$money['kd']=$data['kdmoney'];
				}else{
					$money['kd']=$data['kdmoney']+($num-$data['kdnum'])/$data['kdnummore']*$data['kdmoneymore'];
				}
			}
			if($data['py']){
				if($num<=$data['pynum']){
					$money['py']=$data['pymoney'];
				}else{
					$money['py']=$data['pymoney']+($num-$data['pynum'])/$data['pynummore']*$data['pymoneymore'];
				}
			}
			
			if($data['ems']){
				if($num<=$data['emsnum']){
					$money['ems']=$data['emsmoney'];
				}else{
					$money['ems']=$data['emsmoney']+($num-$data['emsnum'])/$data['emsnummore']*$data['emsmoneymore'];
				}
			}
			return $money;
			break;
			case '1':
			if($data['kd']){
				if(($num*$data['cubage'])<=$data['kdnum']){
					$money['kd']=$data['kdmoney'];
				}else{
					$money['kd']=$data['kdmoney']+(($num*$data['cubage'])-$data['kdnum'])/$data['kdnummore']*$data['kdmoneymore'];
				}
			}
			if($data['py']){
				if(($num*$data['cubage'])<=$data['pynum']){
					$money['py']=$data['pymoney'];
				}else{
					$money['py']=$data['pymoney']+(($num*$data['cubage'])-$data['pynum'])/$data['pynummore']*$data['pymoneymore'];
				}
			}
			
			if($data['ems']){
				if(($num*$data['cubage'])<=$data['emsnum']){
					$money['ems']=$data['emsmoney'];
				}else{
					$money['ems']=$data['emsmoney']+(($num*$data['cubage'])-$data['emsnum'])/$data['emsnummore']*$data['emsmoneymore'];
				}
			}
			return $money;
			break;
			case '2':
			if($data['kd']){
				if(($num*$data['weight'])<=$data['kdnum']){
					$money['kd']=$data['kdmoney'];
				}else{
					$money['kd']=$data['kdmoney']+(($num*$data['weight'])-$data['kdnum'])/$data['kdnummore']*$data['kdmoneymore'];
				}
			}
			if($data['py']){
				if(($num*$data['weight'])<=$data['pynum']){
					$money['py']=$data['pymoney'];
				}else{
					$money['py']=$data['pymoney']+(($num*$data['weight'])-$data['pynum'])/$data['pynummore']*$data['pymoneymore'];
				}
			}
			
			if($data['ems']){
				if(($num*$data['weight'])<=$data['emsnum']){
					$money['ems']=$data['emsmoney'];
				}else{
					$money['ems']=$data['emsmoney']+(($num*$data['weight'])-$data['emsnum'])/$data['emsnummore']*$data['emsmoneymore'];
				}
			}
			return $money;
			break;
		
		}
	}
public  function getprices($productids){
	//先分模板计算；
	//然后在按照各个模板求和
	/*foreach($logistempids as $k=>$v){
		
	}*/
	$money=null;
	$isno=null;

	$pros=implode(',',$productids);
	
	if($pros){
		$whwere='v.productid in('.$pros.')';
	}
	
	$cart=T('product')->set_field(array('sum(nums) as numss','v.productid'))->join_table(array('t'=>'cart','productid','productid'),1)->group_by('logistempid')->set_where($whwere)->get_all();
	
	foreach($cart as $volist){
		$p=$this->getprice($volist['productid'],$volist['nums']);
		
		if($p && is_array($p)){
			if(!$money){
				
					$money=$p;}
					else{
					foreach($p as $k=>$v){
					
						$money[$k]=$money[$k]+$v;
						$isno[$k]+=1;
			
			}
					}
		
		}
	}

	if(!$money)return $money;
	if(!$isno)return $money;
	
		if(is_array($isno)){
		arsort($isno);
		$max=array_search(min($isno),$isno);
		$max=$isno[$max];
		
		foreach($money as $k=>$v){
			
			if($isno[$k]<$max){
				unset($money[$k]);
			}
		}
		return $money;
		}else{
			return $money;
		}

}
}

?>
