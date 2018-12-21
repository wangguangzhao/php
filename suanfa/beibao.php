<?php
/**
 *
    背包问题：有一个背包，背包容量是M=150。有7个物品，物品可以分割成任意大小。
    要求尽可能让装入背包中的物品总价值最大，
    但不能超过总容量。
    物品 A B C D E F G
    重量 35 30 60 50 40 10 25
    价值 10 40 30 50 35 40 30



 */
$weight = [35,30,60,50,40,10,25];
$wp = [A,B,C,D,E,F,G];
$jz = [10,40,30,50,35,40,30];
beibao($weight,$wp,$jz);
//返回物品数组
function beibao($weight,$wp,$jz){
	$rel = array(); 
	$nums = count($weight);
	$sortjz = array();
	for($i=0;$i<$nums;$i++){
	
		$jz_weight = $jz[$i]/$weight[$i];
		$sortjz[] = (int)($jz_weight*10);
		$sortarr[] = ['weight'=>$weight[$i],"value"=>$jz[$i],"jz_weight"=>$jz_weight];
	}
	rsort($sortjz);
	array_multisort($sortarr,$sortjz);
var_dump($sortjz);exit;
	var_dump($sortarr);exit;
	
	//对物品价值/重量从大到小排序


	$jz = 0; //价值
	$widthtotal = 0; //总重量
	for($i=0;$i<$nums;$i++){

		if($widthtotal+$weight[$i]<150){
			$jz += $jz[$i];
			$widthtotal += $weight[$i];
		}else if($widthtotal < 150){ //总重量不超过150 但是下一个已经超过遍历之后的所有符合的情况
			for($j = $i+1; $j<$nums; $j++){
				if($widthtotal+$weight[$i]<=150){
					$jz += $jz[$i];
					$widthtotal += $weight[$i];
				}
			}
		}else{ //已超重
			break;
		}
	}
}
