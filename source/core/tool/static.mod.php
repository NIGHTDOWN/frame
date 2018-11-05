<?php





checktop();
class YInit
{
	public static function mod($mod_dir)
	{
		if (is_dir($dir)) {if ($dh = opendir($dir)) {while (($file = readdir($dh)) !== false) {
            echo "filename: $file : filetype: " . filetype($dir . $file) . "\n";
        }
        closedir($dh);
    }
}
	}
    public static function action($handel)
	{
		foreach ($array2D as $v)
		{
		    $v = join(',', $v);
			$temp[] = $v;
			$temp = array_unique($temp);
			foreach ($temp as $k => $v)
			{
				$temp[$k] =  explode(",", $v);

				 }
			return  $temp;
			 }
	}
	 }

?>
