<?php
	function getEditDistance($string1,$string2)
	{
		$string1=strtolower($string1);
		$string2=strtolower($string2);
		//echo "Finding Edit Distance<br>";
		$distance_array=array(array());
		for($x=0;$x<=strlen($string1);$x++)
		{
			$distance_array[$x][0]=$x;
		}
		for($y=0;$y<=strlen($string2);$y++)
		{
			$distance_array[0][$y]=$y;
		}
		for($x=1;$x<=strlen($string1);$x++)
		{
			for($y=1;$y<=strlen($string2);$y++)
			{
				$val1=min($distance_array[$x-1][$y]+1,$distance_array[$x][$y-1]+1);
				if($string1[$x-1]==$string2[$y-1])
					$val1=min($val1,$distance_array[$x-1][$y-1]);
				else
					$val1=min($val1,$distance_array[$x-1][$y-1]+1);
				$distance_array[$x][$y]=$val1;
			}
		}
		return $distance_array[strlen($string1)][strlen($string2)];
	}
	//echo levenshtein("saturday","sunday");
?>