<?php
include_once('editDistance.php');
function filter($inputString)
{
	$inputString = preg_replace("/[0-9]{4}/i","", $inputString);
	$inputString = preg_replace("/[-]+/", " ",$inputString);
	return trim($inputString);
}
function getMovieLinks($inputString)
{
	$json = json_decode(file_get_contents("data.json"),true);
	$minEditDistance=strlen($inputString)+1;
	$minMovieLink="";
	$finalList=array();
	$inputString=filter($inputString);
	foreach($json as $movieName=>$movieLink)
	{
		$currentEditDistance = getEditDistance($inputString,filter($movieName));
		if($currentEditDistance<$minEditDistance)
		{
			$minEditDistance=$currentEditDistance;
			$finalList=array();
			$finalList[$movieName]=$movieLink;
		}
		else if($currentEditDistance==$minEditDistance)
			$finalList[$movieName]=$movieLink;
	}
	/*
	foreach($finalList as $movieName=>$movieLink)
		echo $movieName."&nbsp;&nbsp;".$movieLink."<br>";
	*/
		return $finalList;
}
	//getMovieLinks("dil dadakne do");
?>