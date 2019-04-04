<?php

	 function waterMarkText($data) {
		 
		$Public =  "./";
		$srcPath = './mark.jpg';
		$name = '1.jpg';
		include "./Picture.class.php" ;

		$pic = new Picture ( $srcPath, $name ,$Public);
		$pic->FONT_WORD = $data['text'];
		$pic->FONT_SIZE =  $data['fontsize'] ;
		$pic->ANGLE = $data['angle'] ;
		$pic->ALPHA =  (1 - $data['opacity']) * 127;
		// var_dump($pic);exit;
		$r = $pic->Marktext ();
		if (! empty ( $r )) {
			$pic->createTextTransPic ();
		}
		return $r;
	}

	$data = [
	'text'=>'hello world',
	'fontsize'=>18,
	'angle'=>45,
	'opacity'=>'0.5',
];
waterMarkText($data);