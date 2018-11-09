<?php



namespace ng169\hook;
checktop();

function hook_get_label($params) {
    if (!empty($params)) {
        @extract($params);
        $name = strtolower(trim($params['name']));
        if (true === YValid::isSpChar($name)){
            
            $model_label = X::model('label', 'im');
            return $model_label->getOne($name);
            unset($model_label);        
        }
    } 
    
}
TPL::regFunction('label', 'hook_get_label');
?>
