<?php
declare(strict_types=1);
/*
	类型运算类
*/

class TypeOperator{
	public $typeName = ""; //操作类型名称
	private $expression = ""; //运算表达式
	private $op = null; //操作符
	private $result = null;//运算结果
	public function __construct(){
		error_reporting(E_ALL & !E_WARNING);
	}
	//设置操作符
	public function setOp(String $op){
		$this->op = $op;
		return $this;
	}


	/*
		整型运算
	*/
	public function execOpInt(int $pOne,int $pTwo){
		$this->expression = $pOne." ".$this->op." ".$pTwo;
		$this->result = eval("return ".$this->expression.";");
		$this->typeName = "整形";
		return $this;
	}
	/*
		浮点型运算
	*/
	public function execOpFloat(float $pOne,float $pTwo){
		$this->expression = $pOne." ".$this->op." ".$pTwo;
		$this->result = eval("return ".$this->expression.";");
		$this->typeName = "浮点型";
		return $this;
	}

	/*
		字符串
	*/
	public function execOpString(String $pOne,String $pTwo){
		$this->expression = $pOne." ".$this->op." ".$pTwo;
		$this->result = eval("return ".$this->expression.";");
		$this->typeName = "字符串";
		return $this;
	}
	/*
		boolean
	*/
	public function execOpBoolean(bool $pOne,bool $pTwo){
		$this->expression = $pOne." ".$this->op." ".$pTwo;
		$this->result = eval("return ".$this->expression.";");
		$this->typeName = "boolean";
		return $this;
	}


	/*
		打印结果
	*/
	public function printResult(){
		echo $this->typeName.":".$this->expression."运算结果： ";
		var_dump($this->result);
		echo "<br>";
	}

}
$addObj = new TypeOperator();
$p1 = 8;
$p2 = 2;
$addObj->setOp("+")->execOpInt($p1,$p2)->printResult();
$addObj->setOp("-")->execOpInt($p1,$p2)->printResult();
$addObj->setOp("*")->execOpInt($p1,$p2)->printResult();
$addObj->setOp("/")->execOpInt($p1,$p2)->printResult();
$addObj->setOp("%")->execOpInt($p1,$p2)->printResult();
$addObj->setOp(">>")->execOpInt($p1,$p2)->printResult();
$addObj->setOp("<<")->execOpInt($p1,$p2)->printResult();
$addObj->setOp(">")->execOpInt($p1,$p2)->printResult();
$addObj->setOp("<")->execOpInt($p1,$p2)->printResult();
$addObj->setOp("!=")->execOpInt($p1,$p2)->printResult();
$addObj->setOp(" and ")->execOpInt($p1,$p2)->printResult(); //等同于&& 优先级不一样

$p1 = 8.2;
$p2 = 2.2;

$addObj->setOp("+")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp("-")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp("*")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp("/")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp("%")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp(">>")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp("<<")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp(">")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp("<")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp("!=")->execOpFloat($p1,$p2)->printResult();
$addObj->setOp(" and ")->execOpFloat($p1,$p2)->printResult(); //等同于&& 优先级不一样

$p1 = "ABCD";
$p2 = "DCBA";

$addObj->setOp("+")->execOpString($p1,$p2)->printResult();
$addObj->setOp("-")->execOpString($p1,$p2)->printResult();
$addObj->setOp("*")->execOpString($p1,$p2)->printResult();
$addObj->setOp("/")->execOpString($p1,$p2)->printResult();
// $addObj->setOp("%")->execOpString($p1,$p2)->printResult(); //报错
$addObj->setOp(">>")->execOpString($p1,$p2)->printResult();
$addObj->setOp("<<")->execOpString($p1,$p2)->printResult();
$addObj->setOp(">")->execOpString($p1,$p2)->printResult();
$addObj->setOp("<")->execOpString($p1,$p2)->printResult();
$addObj->setOp("!=")->execOpString($p1,$p2)->printResult();
$addObj->setOp(" and ")->execOpString($p1,$p2)->printResult(); 
$addObj->setOp(" or ")->execOpString($p1,$p2)->printResult(); 
$addObj->setOp(" xor ")->execOpString($p1,$p2)->printResult();


$p1 = true;
$p2 = true;

$addObj->setOp("+")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp("-")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp("*")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp("/")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp("%")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp(">>")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp("<<")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp(">")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp("<")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp("!=")->execOpBoolean($p1,$p2)->printResult();
$addObj->setOp(" and ")->execOpBoolean($p1,$p2)->printResult(); //等同于&& 优先级不一样
