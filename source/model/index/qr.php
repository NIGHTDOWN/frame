<?php


namespace ng169\model\index;
use ng169\Y;


checktop();

class qr extends Y
{

    public function get($url)
    {
     
       Y::loadTool('image');
     return   YImage::qr($url);
    }


}

?>
