<?php





checktop();
class YCache
{
    #缓存对象
    private $cacheobj;
    #缓存类型
    private $cachetype;
    #缓存时长
    
    
    
   public function set($name,$value){
       
       $mem = new Memcache;
       $mem->connect("127.0.0.1", 11211);
       $mem->set('key', 'This is a test!', 0, 60);
       
       
   }
   public function get($name){}


}
?>
