<?php






$c=D_MEDTHOD;
$a=D_FUNC;


$control_base = ROOT. './source/control/shopbase.php';
$control_path = ROOT. './source/control/shop/'.$c.'.php';



if (!file_exists($control_path)) {
    
	error('Shop Controller file ['.$c.'] is not found!');
}

else {
 
	im($control_base);
	im($control_path);
 
	$control = new control(); 
  
	$method = G_ACTION_PRE.$a;
    
	if (method_exists($control, $method) && $a{0} != '_') {
		$control->$method();
	} 
	else {
		error('Shop Controller Action ['.$a.'] is not found!');
	}
    unset($control);
}

#验证是否为有效Controller
function _check_valid_controller($name) {
    $validc = APP::loadingValidController('index');
    if (empty($validc)) {
        error('All Shop Controller is forbiden!');
        die();
    }
    else {
        if (!in_array($name, $validc)) {
            error('Shop Controller ['.$name.'] is forbiden!');
            die();
        }
    }
}
?>
