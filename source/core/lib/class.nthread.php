<?php



checktop();

class nthreadClass extends Thread{
public function __construct($arg){
        $this->arg = $arg;
    }
    public function run(){
        if($this->arg){
            printf("Hello %s\n", $this->arg);
        }
    }
}

  
	

?>
