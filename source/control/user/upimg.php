<?php

namespace ng169\control\user;

use ng169\control\userbase;

checktop();

class upimg extends userbase{
	private $dir_base = "data/attachment/";
	private $config=array('filetype'=>'','upfilepath'=>'','upfilesize'=>'');
    
	public function control_run(){
        
		
		Y::import('upfile', 'tool');
		Y::loadTool('image');
		$conf = &$this->config;
		$conf['filetype']=Y::$conf['filetype'];
      
		$conf['upfilepath']=Y::$conf['upfilepath'].'/'.D_GROUP.'/upfile/';
		$conf['upfilesize']=Y::$conf['upfilesize'];
		$upobj = new upfileClass($conf);
		
		if($_FILES){
			$out = null;
			foreach($_FILES as $key => $name){
				$a = $upobj->upload($key);
               
				if(!$a['flag']){
					/* M('log','am')->log(false,null,null,null,$a.error);*/
					out($a['error'],null,$a['flag']);
				}
				if( $a['data']['source']){
                    
					/*  d($a,1);
					if(YImage::isimg($a['data']['source'])){
					$sizes=explode(',',Y::$conf['max_img_size']);
					$size['width']=$sizes[0];
					$size['height']=$sizes[1];
					YImage::makeThumb($a['data']['source'],$size,$a['data']['source']);
                    
					}*/
					$f .= $a['data']['source'].',';
				}
			}
			$f=trim($f,',');

			out($f,null,1);
		}
	}
	public function control_file(){
		
		Y::import('upfile', 'tool');
		Y::loadTool('image');
		$conf = $this->config;
		$conf['filetype']=Y::$conf['filetype'];
		$conf['upfilepath']=Y::$conf['upfilepath'].'/tmp/';
		$conf['upfilesize']=Y::$conf['upfilesize'];
		$upobj = new upfileClass($conf);
		if($_FILES){
			$out = null;
			foreach($_FILES as $key => $name){
				$a = $upobj->upload($key);
                
				if(!$a['flag']){
					M('log','am')->log(false,null,null,null,$a.error);
					out($a['error'],null,$a['flag']);
                    
				}
				$f = $a['data']['source'];
			}
        
			out($f,null,1);
		}
	}
	public function control_json_up(){

		Y::import('upfile', 'tool');
		Y::loadTool('image');
		$conf = &$this->config;
		$conf['filetype']=Y::$conf['filetype'];
      
		$conf['upfilepath']=Y::$conf['upfilepath'].'/tmp/';
		$conf['upfilesize']=Y::$conf['upfilesize'];
		$upobj = new upfileClass($conf);
        
		$upobj = new upfileClass($conf);
		if($_FILES){
			$out = null;
			foreach($_FILES as $key => $name){
				$a = $upobj->upload($key);
                
				if(!$a['flag']){
                  
					echo json_encode(array('error' => 1, 'message' => $a['error']));
					exit;
				}
				$f = $a['data']['source'];
			}
          
            
			echo json_encode(array('error' => 0, 'url' => $f));
			exit;
		}
        
        
		die();
        
        


	}

}

?>
