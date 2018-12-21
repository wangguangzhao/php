<?php
header("Content-type:text/html;charset=utf-8");

/*
	校验字符串是否是回文串
	@param string $str

	@return boolean
*/
function checkPplalindrome($str){
		$len = strlen($str);
		if($len <= 1) return true;

		if($str[0] !== $str[$len-1]) return false;

		$str = substr($str,1,$len-2);
		return checkPplalindrome($str);
		
}

$rel = checkPplalindrome("123456789987654");
echo $rel;