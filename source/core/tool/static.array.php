<?php





checktop();
class Arr
{
	public static function unique_arr($array2D, $stkeep = false, $ndformat = true)
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
