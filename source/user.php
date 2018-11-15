<?php






$c=D_MEDTHOD;
$a=D_FUNC;


$control_base = ROOT. './source/control/userbase.php';
$control_path = ROOT. './source/control/user/'.$c.'.php';



if (!file_exists($control_path)) {
    
	error('User Controller file ['.$c.'] is not found!');
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
		error('User Controller Action ['.$a.'] is not found!');
	}
    unset($control);
}

#验证是否为有效Controller
function _check_valid_controller($name) {
    $validc = APP::loadingValidController('index');
    if (empty($validc)) {
        error('All User Controller is forbiden!');
        die();
        
    }
    else {
        if (!in_array($name, $validc)) {
            error('User Controller ['.$name.'] is forbiden!');
            die();
        }
    }
}
?>
