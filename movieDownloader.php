<?php
	include_once('updateData.php');
	include_once('test.php');
	function downloadSongs($movieName,$movieLink)
	{
		if (!file_exists("Mushake Music"))
			mkdir("Mushake Music");
		if(!file_exists("Mushake Music/".$movieName))
			mkdir("Mushake Music/".$movieName);
		echo $movieName." Folder Created. Downloading Files : <br/>";
		ob_flush();
		flush();
		sleep(1);
		$moviePage=file_get_html($movieLink);
		
		foreach($moviePage->find('a') as $hrefElement)
		{	
			$hrefLink=$hrefElement->href;
			$hrefInnerValue=$hrefElement->innertext;
			if(preg_match("/link[1-2]*\.songspk\.name\/song/",$hrefLink) || preg_match("/mp3slash\.net\/indian/",$hrefLink))
			{
				//$hrefLink=preg_replace("/ /","%20",$hrefLink);
				//$url=file_get_contents($hrefLink);
				//$url="http://link1.songspk.name/song1.php?songid=10446";
				//set_time_limit(0);
				$fp = fopen ("Mushake Music/".$movieName."/".trim(preg_replace("/<.*>/"," ",$hrefInnerValue)).".mp3", 'w+');
				$ch = curl_init(str_replace(" ","%20",$hrefLink));
				//curl_setopt($ch, CURLOPT_TIMEOUT, 600);
				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_exec($ch);
				curl_close($ch);
				fclose($fp);
				echo trim(preg_replace("/<.*>/"," ",$hrefInnerValue))." Downloaded<br/>";
				ob_flush();
				flush();
				sleep(1);
			}
		}
		
		echo "All Files Downloaded in ".$movieName." Folder.";
	}
	function downloadMovie($movieName)
	{
		$finalList=getMovieLinks($movieName);
		foreach($finalList as $movieName=>$movieLink)
		{
			//echo $movieName."&nbsp;&nbsp;".$movieLink."<br/>";	
			if(!strpos($movieLink,"albums.songspk.link/"))
				$movieLink="http://www.songspk.link/".$movieLink;	
			downloadSongs($movieName,$movieLink);
		}
	}
	//downloadMovie("delhi 6");

?>