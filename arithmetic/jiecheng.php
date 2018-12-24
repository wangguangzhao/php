<?php
/*
	求一个数的阶乘算法
	@paran $n 数字
	@return -1:参数不合法

*/
function dgjc($n){
	if($n<1) return "-1";
	if($n==1) return 1;
	return $n*dgjc($n-1);
}

function bljc($n){
	$rel = 1;
	if($n<1) return -1;
	$tmpval = $n;
	while($tmpval>0){
		$rel*=$tmpval;
		$tmpval--;
	}
	return $rel;

}
 
echo dgjc(10);
echo bljc(10);