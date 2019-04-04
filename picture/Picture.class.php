<?php
 

/**
 * @author   lisj
 * @time    2016年4月11日-上午10:29:59
 */
class Picture {
	var $PICTURE_URL; // 要处理的图片
	var $DEST_URL; // 生成目标图片完整路径（包含名字）
	var $target_path; // 生成图片的路径（不包含名字）
	var $src_path;
	var $target_name; // 生成图片的名字
	var $target_type = 2; // 生成图片的类型 1 gif;2 jpg、jpeg ;3 png
	var $PICTURE_CREATE; // 要创建的图片
	var $TURE_COLOR; // 新建一个真彩图象
	var $PICTURE_WIDTH; // 原图片宽度
	var $PICTURE_HEIGHT; // 原图片高度
	var $interval_x = 16; // x轴方向上文字的间隔
	var $interval_y = 150; // y轴方向上文字的间隔
	var $WORD; // 经过UTF-8后的文字
	var $FONT_TYPE; // 字体类型
	var $FONT_SIZE = 18; // 字体大小
	var $FONT_WORD; // 文字
	var $font_rgb = array (
			0,
			0,
			0 
	); // 默认黑色
	var $ANGLE = 45; // 文字的角度，默认为45
	var $FONT_COLOR = "#000000"; // 文字颜色
	var $FONT_PATH = "H:\wamp5.6\www\github\php\picture\simfang.ttf"; // 字体库，默认为宋体
	var $mark_path; // 水印图片
	var $POSITION = 1; // 水印位置
	var $FORCE_X = 10; // 水印横坐标
	var $FORCE_Y = 10; // 水印纵坐标
	var $FORCE_START_X = 0; // 切起水印的图片横坐标
	var $FORCE_START_Y = 0; // 切起水印的图片纵坐标
	var $PICTURE_TYPE; // 图片类型
	var $PICTURE_MIME; // 输出的头部
	var $ALPHA = 10; // 文字水印的时候透明度在0-127之间，0表示完全不透明；图片水印的时候透明度在0-100，0表示完全透明。
	var $CIRCUMROTATE = 45.0; // 任意角度旋转 注意，必须为浮点数
	var $ERROR = array (
			'unalviable' => '没有找到相关图片!' 
	);
	// 支持图片的种类
	var $type = array (
			'jpg' => 2,
			'png' => 3,
			'jpeg' => 2,
			'gif' => 1 
	);
	
	/**
	 * 构造函数：函数初始化
	 */
	function __construct($PICTURE_URL, $target_name, $target_path) {
		$temp = pathinfo ( $PICTURE_URL );
		$name = $temp ['basename'];
		// $name =substr($name, 0,strpos($name, '.'));
		$path = $temp ['dirname'];
		$this->target_name = $target_name ? $target_name : $name;
		$this->target_path = $target_path ? $target_path : $path;
		$this->get_info ( $PICTURE_URL );
		$this->checkType ( $target_name );
		$this->DEST_URL = $this->target_path . '/' . $this->target_name;
	}
	function get_info($PICTURE_URL) {
		/**
		 * 处理原图片的信息,先检测图片是否存在,不存在则给出相应的信息
		 */
		@$SIZE = getimagesize ( $PICTURE_URL );
		
		if (! $SIZE) {
			trace ( $this->ERROR ['unalviable'] . '...error:' . $PICTURE_URL );
		}
		$this->PICTURE_URL = $PICTURE_URL;
		// 得到原图片的信息类型、宽度、高度
		$this->PICTURE_MIME = $SIZE ['mime'];
		$this->PICTURE_WIDTH = $SIZE [0];
		$this->PICTURE_HEIGHT = $SIZE [1];
		// 创建图片
		switch ($SIZE [2]) {
			case 1 :
				$this->PICTURE_CREATE = imagecreatefromgif ( $PICTURE_URL );
				$this->PICTURE_TYPE = "imagegif";
				$this->PICTURE_EXT = "gif";
				break;
			case 2 :
				$this->PICTURE_CREATE = imagecreatefromjpeg ( $PICTURE_URL );
				$this->PICTURE_TYPE = "imagejpeg";
				$this->PICTURE_EXT = "jpg";
				break;
			case 3 :
				$this->PICTURE_CREATE = imagecreatefrompng ( $PICTURE_URL );
				$this->PICTURE_TYPE = "imagepng";
				$this->PICTURE_EXT = "png";
				break;
		}
		/**
		 * 文字颜色转换16进制转换成10进制
		 */
		preg_match_all ( "/([0-f]){2,2}/i", $this->FONT_COLOR, $MATCHES );
		if (count ( $MATCHES ) == 3) {
			$this->RED = hexdec ( $MATCHES [0] [0] );
			$this->GREEN = hexdec ( $MATCHES [0] [1] );
			$this->BLUE = hexdec ( $MATCHES [0] [2] );
		}
	}
	
	// end of __construct
	/**
	 * 水印文字-直接将文字水印到图片上去
	 */
	function Marktext() {
		// 文字生成水印后保存位置
		// $temppath= $this->target_path .'/'.time(). '_'.$this->target_name;
		$this->WORD = mb_convert_encoding ( $this->FONT_WORD, 'UTF-8', 'auto' );
		$TEMP = imagettfbbox ( $this->FONT_SIZE, $this->ANGLE, $this->FONT_PATH, $this->WORD );
		$word_length = strlen ( $this->WORD );
		$word_width = abs($TEMP [2] - $TEMP [6]) > abs($TEMP [4] - $TEMP [0]) ? abs($TEMP [2] - $TEMP [6]) : abs($TEMP [4] - $TEMP [0]) ;
		$word_height = abs($TEMP [3] - $TEMP [7]) > abs($TEMP [5] - $TEMP [1]) ? abs($TEMP [3] - $TEMP [7]) : abs($TEMP [5] - $TEMP [1]);
		@$SIZE = getimagesize ( $this->PICTURE_URL );
		if (! $SIZE) {
			trace ( $this->ERROR ['unalviable'] . '...error:' . $this->PICTURE_URL );
		}
		$mark_width = $SIZE [0];
		$mark_height = $SIZE [1];
		$width = intval ( $mark_width / $word_width ) + 1;
		$height = intval ( $mark_height / $word_height ) + 1;
		$target_pic = $this->image_create_from_ext ( $this->PICTURE_URL );
		$rgb = $this->font_rgb;
		$TEXT2 = imagecolorallocatealpha ( $target_pic, $rgb [0], $rgb [1], $rgb [2], $this->ALPHA ); // 205 133 63
		for($i = 0; $i < $width; $i ++) {
			for($j = $height; $j > 0; $j --) {
				$dst_x = ($i *($word_width + ($this->FONT_SIZE*3)) + $this->FORCE_X)*1.5;
				$dst_y = ($j * ($word_height + ($this->FONT_SIZE*3))+ $this->FORCE_Y)*1.5;
				$rel = imagettftext ( $target_pic, $this->FONT_SIZE, $this->ANGLE, $dst_x, $dst_y, $TEXT2, $this->FONT_PATH, $this->WORD );
				 
			}
		}
		$temppath = $this->DEST_URL;
		switch ($this->target_type) {
			case 1 :
				$res = imagegif ( $target_pic, $temppath );
				break;
			case 2 :
				$res = imagejpeg ( $target_pic, $temppath );
				break;
			case 3 :
				$res = imagepng ( $target_pic, $temppath );
				break;
			default :
				return false; // 保存失败
		}
		if (! empty ( $res )) {
			$res = array ();
			$res ['savepath'] = $this->target_path;
			$res ['savename'] = $this->target_name;
		}
		return $res;
	}
	
	function createTextTransPic(){
		$TEMP = imagettfbbox ( $this->FONT_SIZE, 0, $this->FONT_PATH, $this->WORD );
		$word_length = strlen ( $this->WORD );
		$word_width = $TEMP [2] - $TEMP [6];
		$word_height = $TEMP [3] - $TEMP [7];
		@$SIZE = getimagesize ( $this->PICTURE_URL );
		if (! $SIZE) {
			trace ( $this->ERROR ['unalviable'] . '...error:' . $this->PICTURE_URL,'','水印' );
		}
		$img=imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/php/picture/tran.png');//PNG
		imagesavealpha($img,true);//这里很重要 意思是不要丢了$sourePic图像的透明色;
		//生成透明图片
		/* $img = imagecreatetruecolor ( 1000, 1000 );
		$color = imagecolorallocate ( $img, 255, 255, 255 );
		imagecolortransparent ( $img, $color );
		imagefill($img, 0, 0, $color); */
		$rgb=$this->font_rgb;
		$textcolor = imagecolorallocatealpha( $img, $rgb [0], $rgb [1], $rgb [2],$this->ALPHA);
		$width = intval ( 1000 / $word_width ) + 1;
		$height = intval ( 1000 / $word_height ) + 1;
		 for($i = 0; $i < $width; $i ++) {
			for($j = $height; $j > 0; $j --) {
				$dst_x = ($i *($word_width + ($this->FONT_SIZE*3)) + $this->FORCE_X)*1.5;
				$dst_y = ($j * ($word_height + ($this->FONT_SIZE*3))+ $this->FORCE_Y)*3;
				imagettftext ( $img, $this->FONT_SIZE, $this->ANGLE, $dst_x, $dst_y, $textcolor, $this->FONT_PATH, $this->WORD );
			}
		}
		$transName=substr($this->DEST_URL, 0,strpos($this->DEST_URL, '.'));
		imagepng ( $img, $transName.'_trans.png' );
	}
	/**
	 * 水印图片-只用于系统配置下的打水印
	 */
	function waterMark_pic() {
		$mark_path = $this->turn ( $this->mark_path, false );  // 旋转
		$res = $this->mark ( $mark_path, $this->PICTURE_URL ); // 水印
		$this->createPicTransPic($mark_path);
		
		return $res;
	}
	
	/**
	 * 旋转图片，然后透明图片打水印
	 */
	function markTranspic(){
		$mark_path = $this->turn ( $this->mark_path, false );  // 旋转
		$this->createPicTransPic($mark_path);//
	}
	
	
	/**
	 * 公共方法-打水印
	 */
	function MarkPic(){
		$mark_path = $this->turn ( $this->mark_path, false );
		$res = $this->mark ( $mark_path, $this->PICTURE_URL );
	}
	
	/**
	 * 图片旋转任意角度
	 * 
	 * @param 目标图片 $img_path        	
	 * @param 是否替换掉目标图片 $flag        	
	 * @return boolean|string
	 */
	function turn($img_path, $flag = true) {
		@$SIZE = getimagesize ( $img_path );
		if (! $SIZE) {
			trace ( '图片旋转时' . $this->ERROR ['unalviable'] . ':' . $img_path );
		}
		$img_width = $SIZE [0];
		$img_height = $SIZE [1];
		
		// 获取图片
		$img = $this->image_create_from_ext ( $img_path );
		imagealphablending($img,false);
		imagesavealpha($img,true);//这里很重要,意思是不要丢了图像的透明色;
		/**
		 * 创建一个画布
		 */
		$target_pic = imagecreatetruecolor ( $img_width, $img_height );
		$color = imagecolorallocatealpha( $target_pic, 255, 255, 255,127);
		imagealphablending($target_pic,false);//这里很重要,意思是不合并颜色,直接用图像颜色替换,包括透明色;
		imagesavealpha($target_pic,true);//这里很重要,意思是不要丢了图像的透明色;
		
		/**
		 * 将背景图拷贝到画布中
		 */
		imagecopy( $target_pic, $img, 0, 0, 0, 0, $img_width, $img_height);
		$bg = imagecolorallocatealpha( $target_pic, 255, 255, 255,127);
		$img_turn = imagerotate ( $target_pic, $this->CIRCUMROTATE, $bg,0 );
		// 水印图片旋转后的名字和最终生成的图片名字一致
		$temp = pathinfo ( $img_path );
		$name = $temp ['basename'];
		$name = $flag ? $name : time () . $name;
		$img_path = $this->target_path . '/' . $name;
		imagepng ( $img_turn, $img_path );
		return $img_path;
	}
	/**
	 *
	 * @param 水印的图片地址 $mark_path,要打水印的源图片$source_path        	
	 * @return number
	 */
	function mark($mark_path, $source_path) {
		/**
		 * 获取水印图片的信息
		 */
		@$SIZE = getimagesize ( $mark_path );
		if (! $SIZE) {
			trace ( '打水印时' . $this->ERROR ['unalviable'] . ':' . $mark_path );
		}
		$mark_width = $SIZE [0];
		$mark_height = $SIZE [1];
		// 创建水印图片
		$mark_pic = $this->image_create_from_ext ( $mark_path );
		
		@$SIZE = getimagesize ( $source_path );
		if (! $SIZE) {
			trace ( $this->ERROR ['unalviable'] . '...error:' . $source_path );
		}
		$source_width = $SIZE [0];
		$source_height = $SIZE [1];
		// 创建水印图片
		$source_pic = $this->image_create_from_ext ( $source_path );
		/**
		 * 判断水印图片的大小，并生成目标图片的大小，如果水印比图片大，则生成图片大小为水印图片的大小。否则生成的图片大小为原图片大小。
		 */
		if ($mark_width > $source_width) {
			$target_width = $mark_width - $this->FORCE_START_X;
		} else {
			$target_width = $source_width;
		}
		if ($mark_height > $source_height) {
			$target_height = $mark_height - $this->FORCE_START_Y;
		} else {
			$target_height = $source_height;
		}

		/**
		 * 将目标图片拷贝到背景图片上
		 */
		$width = intval ( $target_width / $mark_width)+1;
		$height=intval($target_height/$mark_height)+1;
		for ($i = 0; $i < $width; $i++) {
			for ($j = 0; $j < $height;$j++) {
				$dst_x=($i*$mark_width+$this->FORCE_X)*2;
				$dst_y=($j*$mark_height+$this->FORCE_Y)*2;
				imagecopymerge ( $source_pic, $mark_pic, $dst_x, $dst_y, $this->FORCE_START_X, $this->FORCE_START_Y, $mark_width, $mark_height,$this->ALPHA );
			}
		} 
		$target_path=$this->DEST_URL;
		switch ($this->target_type) {
			case 1: $res=imagegif($source_pic, $target_path); break;
			case 2: $res=imagejpeg($source_pic,$target_path);break;
			case 3: $res=imagepng($source_pic,$target_path); break;
			default: return false; //保存失败
		}
		if(!empty($res)){
			$res=array();
			$res['savepath']=$this->target_path;
			$res['savename']=$this->target_name;
		}
		return $res;
	}
	
	/**
	 * 生成透明图片，然后给该图片打上水印
	 * @param  $mark_path  logo
	 */
	function createPicTransPic($mark_path){
		@$SIZE = getimagesize ( $mark_path );
		if (! $SIZE) {
			trace ( '打水印时' . $this->ERROR ['unalviable'] . ':' . $mark_path );
		}
		$mark_width = $SIZE [0];
		$mark_height = $SIZE [1];
		
		
	
		// 创建水印图片
		$mark_pic = $this->image_create_from_ext ( $mark_path );
		imagesavealpha($mark_pic,true);//这里很重要,意思是不要丢了图像的透明色;
		//透明背景
	 	$img=imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/Public/resource/system/tran.png');//PNG
	 	$color = imagecolorallocatealpha( $img, 255, 255, 255,127);
		imagesavealpha($img,true);//这里很重要 意思是不要丢了$sourePic图像的透明色
		imagealphablending($img,false);
	 	$width = intval ( 1000 / $mark_width ) + 1;
		$height = intval ( 1000 / $mark_height ) + 1;
		 for ($i = 0; $i < $width; $i++) {
			for ($j = 0; $j < $height;$j++) {
				$dst_x=($i*$mark_width+$this->FORCE_X)*2;
				$dst_y=($j*$mark_height+$this->FORCE_Y)*2;
				//$dst_x = $i *$mark_width* $this->interval_x + $this->FORCE_X;
				//$dst_y = $j * $this->interval_y + $this->FORCE_Y;
				//此处没法设置透明度，只能用copy方法，不能用copmerge方法。
				imagecopy( $img, $mark_pic, $dst_x, $dst_y, $this->FORCE_START_X, $this->FORCE_START_Y, $mark_width, $mark_height);
			}
		}   
		$transName=substr($this->DEST_URL, 0,strpos($this->DEST_URL, '.'));
		imagepng ( $img, $transName.'_trans.png' );
	}
	function reduction($img_path){
		@$SIZE = getimagesize ( $img_path );
		if (! $SIZE) {
			trace ( '图片旋转时' . $this->ERROR ['unalviable'] . ':' . $img_path );
		}
		$img_width = $SIZE [0];
		$img_height = $SIZE [1];
		
		// 获取图片
		$img = $this->image_create_from_ext ( $img_path );
		imagealphablending($img,false);
		imagesavealpha($img,true);//这里很重要,意思是不要丢了图像的透明色;
		
		// 创建一个画布
		$target_pic = imagecreatetruecolor ( $img_width, $img_height );
		$color = imagecolorallocatealpha( $target_pic, 255, 255, 255,127);
		imagealphablending($target_pic,false);//这里很重要,意思是不合并颜色,直接用图像颜色替换,包括透明色;
		imagesavealpha($target_pic,true);//这里很重要,意思是不要丢了图像的透明色;
		// 将背景图拷贝到画布中
		imagecopymerge( $target_pic, $img, 0, 0, 0, 0, $img_width, $img_height,30);
		$dest_path='D:\work\wamp\www\Public\resource\system\1.png';
		imagepng($target_pic,$dest_path);
		return $dest_path;
		
	}
	function image_create_from_ext($imgfile){
		$info =getimagesize($imgfile);
		$im = null;
		switch ($info[2]) {
			case 1: $im=imagecreatefromgif($imgfile); break;
			case 2: $im=imagecreatefromjpeg($imgfile); break;
			case 3: $im=imagecreatefrompng($imgfile); break;
		}
		return $im;
	}
	
	public function checkType($pic_name){
		if(!empty($pic_name)){
			$type=substr($pic_name, strpos($pic_name, '.')+1,strlen($pic_name));
			//如果指定生成图片的类型符合，就按照制定的来；否则根据源图片来
			$typeArr=$this->type;
			if(array_key_exists($type, $typeArr)){
				$this->target_type=$typeArr[$type];
			}
		}
	}
	/**
	 * 析构函数：释放图片
	 */
	function __destruct() {
		/**
		 * 释放图片
		 */
		//if($this->TRUE_COLOR) imagedestroy ( $this->TRUE_COLOR );
		if($this->PICTURE_CREATE)imagedestroy ( $this->PICTURE_CREATE );
	}
	
	
	// end of class
}
?>  