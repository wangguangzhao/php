<?php
/*
	动态规划算法
*/

//一个人上楼梯每次只能迈一级或两级问n级台阶共有几种走法
function func($n){
	echo 2;
	static $dp = array();
	if($n<3) return $n;
	if(!$dp[$n-1]) $dp[$n-1] = func($n-1);
	if(!$dp[$n-2]) $dp[$n-2] = func($n-2);
	
	return $dp[$n-1]+$dp[$n-2];
}

var_dump(func(14));