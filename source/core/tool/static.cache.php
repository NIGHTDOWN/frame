<?php





checktop();
class YCache
{
    #�������
    private $cacheobj;
    #��������
    private $cachetype;
    #����ʱ��
    
    
    
   public function set($name,$value){
       
       $mem = new Memcache;
       $mem->connect("127.0.0.1", 11211);
       $mem->set('key', 'This is a test!', 0, 60);
       
       
   }
   public function get($name){}


}
?>
