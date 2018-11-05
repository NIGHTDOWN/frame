<?php





checktop();

class qrModel extends Y
{

    public function get($url)
    {
     
       Y::loadTool('image');
     return   YImage::qr($url);
    }


}

?>
