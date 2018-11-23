<?php

namespace ng169\control\index;
use ng169\control\indexbase;

use ng169\Y;
use ng169\tool\Upfile;
use ng169\tool\Image;

checktop();

class upimg extends indexbase{
	private $dir_base = "data/attachment/";
	private $config=array('filetype'=>'','upfilepath'=>'','upfilesize'=>'');
  
	public function control_run(){

		/*Y::import('upfile', 'tool');
		Y::loadTool('image');*/
			
		$conf = $this->config;
		$conf['filetype']=Y::$conf['filetype'];
		$conf['upfilepath']=Y::$conf['upfilepath'].'/'.D_GROUP.'/upfile/';
		$conf['upfilesize']=Y::$conf['upfilesize'];		
		$upobj = new Upfile($conf);	
		
		if($_FILES){
			$out = null;
			foreach($_FILES as $key => $name){
				
				$a = $upobj->upload($key);
               
				if(!$a['flag']){
					/*M('log','am')->log(false,null,null,null,$a.error);*/
					out($a['error'],null,$a['flag']);
				}
				if( $a['data']['source']){
                  
					$f .= $a['data']['source'].',';
				}
			}
			$f=trim($f,',');
			out($f,null,1);
		}
	}
	public function control_file(){
		
		/*Y::import('upfile', 'tool');
		Y::loadTool('image');*/
		$conf = $this->config;
		$conf['filetype']=Y::$conf['filetype'];
		$conf['upfilepath']=Y::$conf['upfilepath'].'/tmp/';
		$conf['upfilesize']=Y::$conf['upfilesize'];
		$upobj = new Upfile($conf);
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
			M('log','am')->log(true,null,null,null,$f);
			out($f,null,1);
		}
	}
	public function control_json_up(){

		/*Y::import('upfile', 'tool');
		Y::loadTool('image');*/
		$conf = $this->config;
		$conf['upfilepath']=Y::$conf['upfilepath'].'/kfile/';
		if(YRequest::getGet('dir')=='image'){
			$conf['filetype']=Y::$conf['imgtype'];
			$conf['upfilesize']=Y::$conf['imgfilesize'];
		}else{
			$conf['filetype']=Y::$conf['filetype'];
			$conf['upfilesize']=Y::$conf['upfilesize'];
		}
        
		$upobj = new Upfile($conf);
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
