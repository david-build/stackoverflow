<?
	
	
	$img 			= imagecreatefrompng("res/source.png");
	$img_cover 		= imagecreatefrompng("res/transparent.png");
	$img_logo 		= imagecreatefrompng("res/logo.png");
	$font_path 		= "res/ptsans.ttf";
	$font_path_bold = "res/ptsans-bold.ttf";
	$save_file 		= "output/".uniqid().'.png';
	$quality		= 80;
	$temp			= "";
			
	$date 			= "25.07.2018, 15:00";
	$title 			= "Lorem ipsum dolor sit amet, consectetur adipiscing elit";
	
	/*-----------------------------------------------------------------
	| Накладываем полупрозрачный фон
	------------------------------------------------------------------*/
    imagealphablending($img, true);
    imagesavealpha($img, true);
    imagealphablending($img_cover, true);
    imagesavealpha($img_cover, true);    
    imagecopy($img, $img_cover, 0, 0, 0, 0, imagesx($img_cover), imagesy($img_cover));



	/*-----------------------------------------------------------------
	| Накладываем лого
	------------------------------------------------------------------*/
    imagealphablending($img, true);
    imagesavealpha($img, true);
    imagealphablending($img_logo, true);
    imagesavealpha($img_logo, true);
    imagecopy($img, $img_logo, 44, 44, 0, 0, imagesx($img_logo), imagesy($img_logo));
	
	
	/*-----------------------------------------------------------------
	| Накладываем текст и дату
	------------------------------------------------------------------*/
	$line = array(32, 64, 96);
	
	if (mb_strlen($title) > $line[0]) {
		
		$pos = mb_strlen(explode(' ', mb_substr($title, $line[0], 999), 2)[0]);
		$line[0] = $pos+$line[0];
		
	}
	if (mb_strlen($title) > $line[1]) {
		
		$pos = mb_strlen(explode(' ', mb_substr($title, $line[1], 999), 2)[0]);
		$line[1] = $pos+$line[1];
		
	}
	if (mb_strlen($title) > $line[0]) {
		$title = mb_substr($title, 0, $line[0])."\n".mb_substr($title, $line[0]+1, $line[1]-$line[0])."\n".mb_substr($title, $line[1]+1, $line[0]);
	}
	

	# Add date
	$color = imagecolorallocate($img, 155, 192, 239);
	$text = $date;
	imagettftext($img, 12, 0, 44, 152, $color, $font_path, $text);

	# Add City
	$color = imagecolorallocate($img, 155, 192, 239);
	$text = mb_strtoupper($city);
	imagettftext($img, 12, 0, 260, 151, $color, $font_path_bold, $text);

	# Add Title
	$color = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
	$text = $title;
	imagettftext($img, 24, 0, 44, 214, $color, $font_path_bold, $text);
	

	# Save Image
	imagepng($img, $save_file, 9);
	imagedestroy($img);				
	
	
?>