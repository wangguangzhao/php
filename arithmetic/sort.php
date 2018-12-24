<?php
/*
	经典排序算法
	冒泡排序
	选择排序
	插入排序
	快速排序
	归并排序
*/

class Sort{

	protected $arr = array(); //待排序数组

	public function __construct($arr){
		if(!is_array($arr)) throw new Exception("param is not a array");
		$this->arr = $arr;
	}
	/*
		交换数组中两个元素
	**/
	private function swap($one,$two){
			$tmp = $this->arr[$one];
			$this->arr[$one] = $this->arr[$two];
			$this->arr[$two] = $tmp;
	}

	/*
		冒泡排序
		@param string $order asc:正序 desc 倒序
		@return array
	*/
	public function bubbleSort($order = "asc"){
			$len = count($this->arr);
			for($i=0;$i<$len;$i++){
				for($j=0;$j<$len-1-$i;$j++){
					if($order == "asc"){
							if($this->arr[$j]>$this->arr[$j+1]) $this->swap($j,$j+1);
					}else{
							if($this->arr[$j]<$this->arr[$j+1]) $this->swap($j,$j+1);
					}
				}
			}
			return $this->arr;
	}

	/*
		选择排序
		@param string $order asc:正序 desc 倒序
		@return array
	*/
	public function selectSort($order = "asc"){
		 
		 $len = count($this->arr);
		 for($i=0;$i<$len-1;$i++){
		 	$tmp = $i;
		 	for($j=$i+1;$j<$len;$j++){
		 		if($order == "asc"){
		 			if($this->arr[$j] < $this->arr[$tmp]) $tmp = $j;
		 		}else{
		 			if($this->arr[$j] > $this->arr[$tmp]) $tmp = $j;
		 		}
		 	}

		 	if($tmp != $i) $this->swap($i,$tmp);
		 }
		 return $this->arr;
		
	}


	/*
		插入排序
		@param string $order asc:正序 desc 倒序
		@return array
	*/
	public function insertSort($order = "asc"){
		 $len = count($this->arr);
		 if($len<2) return $this->arr;
		 for($i=1;$i<$len;$i++){
		 	$j = $i;
		 	$tmp = $this->arr[$i];
		 	if($order == "asc"){
		 		while($j>0 && $this->arr[$j-1]>$tmp){
		 			$this->arr[$j] = $this->arr[$j-1];
		 			$j--;
		 		}
		 	}else{
		 		while($j>0 && $this->arr[$j-1]<$tmp){
		 			$this->arr[$j] = $this->arr[$j-1];
		 			$j--;
		 		}
		 	}
		 	$this->arr[$j] = $tmp;

		 }
		 return $this->arr;
	}

	/*
		快速排序
		@param string $order asc:正序 desc 倒序
		@return array
	*/
	public function quickSort($order = "asc"){
	  	 return $this->quickSortexec($this->arr,$order);
	}
	private function quickSortexec($arr,$order){
		$len = count($arr);
		if($len < 2) return $arr;
		$left = $right = array();
		$tmp = $arr[0];
		for($i=1;$i<$len;$i++){
			if($order == "asc"){
				if($arr[$i] < $tmp){
					$left[] = $arr[$i];	
				}else{
					$right[] = $arr[$i];
				}
			}else{
				if($arr[$i] > $tmp){
					$left[] = $arr[$i];	
				}else{
					$right[] = $arr[$i];
				}
			}
		}
		return array_merge($this->quickSortexec($left,$order),array($tmp),$this->quickSortexec($right,$order));
	}
	/*
		归并排序
		动态规划将原始拆后逐个合并成有序数组
		@param string $order asc:正序 desc 倒序
		@return array
	*/
	public function mergeSort($order = "asc"){
		
		return $this->mergeSortexe($this->arr,$order);
	}

	private function mergeSortexe($arr,$order){
		$len = count($arr);
		if($len === 1) return $arr;
		$mid = floor($len/2);
		$left = array_slice($arr, 0,$mid);
		$right = array_slice($arr, $mid);
		$left = $this->mergeSortexe($left,$order);
		$right = $this->mergeSortexe($right,$order);
		//合并有序数组
		$rel = $this->merge($left,$right,$order);
		return $rel;
	}

	private function merge($left,$right,$order){
		$rel = array();
		$li = $ri =0;
		while($li<count($left) && $ri<count($right)){
			if($order =="asc"){
				if($left[$li]<$right[$ri]){
					$rel[] = $left[$li++];
				}else{
					$rel[] = $right[$ri++];
				}
			}else{
				if($left[$li]>$right[$ri]){
					$rel[] = $left[$li++];
				}else{
					$rel[] = $right[$ri++];
				}
			}
		}

		while($li<count($left)){
			$rel[] = $left[$li++];
		}
		while($ri<count($right)){
			$rel[] = $right[$ri++];
		}
		return $rel;
	}


	 
}


// $tmparr = [1,34,4,3,6,23,74,99,23,54,86];

// $sortObj = new Sort($tmparr);
// $rel = $sortObj->bubbleSort("desc");
 // $rel = $sortObj->selectSort();
 // $rel = $sortObj->mergeSort("desc");
// $rel = $sortObj->insertSort("desc");
// $rel = $sortObj->quickSort("Desc");

 
// print_r($rel);

