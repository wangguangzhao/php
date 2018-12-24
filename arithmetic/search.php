<?php

/*
	经典查询算法
*/

class Search{

	//待查询数组
	protected $arr = array();

	public function __construct($arr){
		if(!is_array($arr)) throw new Exception("param arr is not a array");
		$this->arr = $arr;

	}
	/*
		遍历查找
		要求：待检索数组有序、无序都可以
		@param  string  $value 检索值
		@return 索引值 或 -1：未找到
	*/
	public function sequenceSearch($value){
		$len = count($this->arr);
		if($len<1) return -1;
	
		for($i = 0;$i<$len;$i++){
			if($this->arr[$i] == $value){
				return $i;
			}
		}
		return -1;

	}
	//排序
	private function sort(){
		include "./sort.php";
		$sortobj = new Sort($this->arr);
		return $sortobj->selectSort();
	}

	/*
		二分查找:基于循环方式实现
		要求：待检索数组有序
		@param  string  $value 检索值
		@return 索引值 或 -1：未找到
	*/
	public function binarySearchone($value){
		$arr = $this->sort();
		$len = count($arr);
		$low =0;
		$high = $len-1;
		while($low<=$high){
			$mid = floor(($low+$high)/2);
			if($value > $arr[$mid]){
				$low = $mid+1;
			}else if($value < $arr[$mid]){
				$high = $mid-1;
			}else{
				return $mid;
			}
		}
		
		return -1;
	}
	/**
	 * 二分查找：基于递归方式实现
	 * 要求：待检索数组有序
	 * @param String $value
	 * @return 索引值 或-1 -1:未找到
	 */
	public function binarySearchtwo($value){
		$arr = $this->sort();
		$len = count($arr);
		return $this->binarySearchrecursion($arr, $value, 0, $len);
	}
	/**
	 * @param array $arr
	 * @param string $value
	 * @param integer $low
	 * @param integer $high
	 * @return 索引值 或-1 -1:未找到
	 * 
	 */
	private function binarySearchrecursion($arr,$value,$low,$high){
			if($low>$high) return -1;
			$mid = floor(($low+$high)/2);
			if($value > $arr[$mid]){
				return $this->binarySearchrecursion($arr, $value, $mid+1, $high);
			}else if($value < $arr[$mid]){
				return $this->binarySearchrecursion($arr, $value, $low,  $mid-1);
			}else{
				return $mid; 
			}
	}
	
	

}

$arr = [1,2,3,41,51,62,66,72,82,91];
$searchObj = new Search($arr);

// $rel = $searchObj->binarySearch(41);
// $rel = $searchObj->binarySearchtwo(33);
echo $rel;