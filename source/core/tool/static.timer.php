<?php




class timer{
    private $lock; 
    
    public static function create($F,$I_time){
        ignore_user_abort(true); 
        set_time_limit(0); 
        require_once $F;

        while(1) { 
            
            ¡¡¡¡sleep(300); 
        } 


    }
    
    private static function _isloack(){
        
        
    }
    
    public static function lock($F){
        $php_lock_fp = @fopen($F, "w+") or die("Couldn't open the lock file !\n");
        if (flock($php_lock_fp, LOCK_EX + LOCK_NB)) {   
            
            
            return true;
        } else {
            @fclose($php_lock_fp);
            return false;
            
        }
    }
    
    private static function _lock($F){}
    public static function unlock($F){}

}
?>
