<?php

/*
	二分查找
	@param array $arr;
	@param string $val
	@return boolean
*/
function binarySearch1($arr,$val,$start,$end){

	if(!is_array($arr)||$end<$start) return false;
	$mid = intval(($start+$end)/2);
	if($arr[$mid]<$val){
		return binarySearch1($arr,$val,$mid+1,$end);
	}else if($arr[$mid]>$val){
		return binarySearch1($arr,$val,$start,$mid-1);
	}else{
		return true;
	}
}

function binarySearch($arr,$val){
	if(!is_array($arr)) return false;
	$len = count($arr);
	$i=0;
	while($i<=$len){
		$mid = intval(($i+$len)/2);
		if($val<$arr[$mid]){
			$len=$mid-1;
		}else if($val>$arr[$mid]){
			$i=$mid+1;
		}else{
			return true;
		}
	}
	return false;
}

$arr = [1,2,3,4,5,6,7,10,48,59,68,102];
$val=101;
// $rel = binarySearch1($arr,$val,0,count($arr));
$rel = binarySearch($arr,$val);
var_dump($rel);