<?php
include_once('simple_html_dom.php');
function updateJSON()
{
	$list=array();
	foreach(range('a','z') as $alphabet)
		array_push($list,$alphabet);
	array_push($list,"numeric");

	$space='';
	for($x=0;$x<=3;$x++)
		$space=$space."&nbsp;";

	$movieMapping = array();
	foreach($list as $alphabet)
	{
		$html = file_get_html('http://www.songspk.link/'.$alphabet.'_list.html');
		foreach($html->find('div[class="catalog-album-holder"]') as $divElement)
		{
			foreach($divElement->find('a') as $hrefElement)
			{
				$innerValue=trim($hrefElement->innertext);
				$hrefValue=$hrefElement->href;
				if(strlen($innerValue)>1)
				{
					$innerValue=preg_replace("/\\t/", "", $innerValue);
					$movieMapping[trim($innerValue)]=trim($hrefValue);
				}
			}	
		}
		//break;
	}
	$json=json_encode($movieMapping,true);
	$file=fopen("data.json","w");
	file_put_contents("data.json",$json);
	fclose($file);
	//echo $json;
	echo "data.json Created!!";
}
//updateJSON();
?>