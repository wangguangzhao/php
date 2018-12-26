<?php

namespace php\base;

/**
 * php常见面试题
 * @author 王光照
 *
 */
class Question{


	/**
	 * 弱类型
	 */
	public function question1(){
		$str1 = 'yabadabadoo';
		$str2 = 'yaba';
		if (strpos($str1,$str2)) {
			echo "\"" . $str1 . "\" contains \"" . $str2 . "\"";
		} else {
			echo "\"" . $str1 . "\" does not contain \"" . $str2 . "\"";
		}
	}
	
	/**
	 * 下面的输出结果会是怎样？
	 */
	public function question2(){
		$x = 5;
		echo $x;
		echo "<br />";
		echo $x+++$x++;
		echo "<br />";
		echo $x;
		echo "<br />";
		echo $x---$x--;
		echo "<br />";
		echo $x;
	}

	
	/**
	 * 关于变量的引用；
	 * $a、$b的值各是多少
	 */
	public function question3(){
		$a = '1';
		$b = &$a;
		$b = "2$b";
		echo $a;
		echo "<br />";
		echo $b;
	}
	
	/**
	 * 下面是true还是false
	 */
	public function question4(){
		$a = true and false;
		echo $a;
		echo "<br />";
		$a = true && false;
		echo $a;
		echo "<br />";
		$a = false or true ;
		echo $a;
		echo "<br />";
		$a = true || false;
		echo $a;
		echo "<br />";
		
	}
	
	/**
	 *下面的代码有什么问题吗？输出会是什么，怎样修复它 
	 */
	public function question5(){
		$referenceTable = array();
		$referenceTable['val1'] = array(1, 2);
		$referenceTable['val2'] = 3;
		$referenceTable['val3'] = array(4, 5);
		
		$testArray = array();
		
		$testArray = array_merge($testArray, $referenceTable['val1']);
		var_dump($testArray);  
		$testArray = array_merge($testArray, $referenceTable['val2']);
		var_dump($testArray);  
		$testArray = array_merge($testArray, $referenceTable['val3']);
		var_dump($testArray); 
	}
	/**
	 *$x应该是输出什么？ 
	 */
	public function question6(){
		$x = true && false;
		var_dump($x); 
	}
	/**
	 * 经过下面的运算 $x的值应该是多少？
	 */
	public function question7(){
		$x = 3 + "15%" + "$25";
	}
	/**
	 * 运行下面的代码，$text 的值是多少？strlen($text)又会返回什么结果？
	 */
	public function question8(){
		$text = 'John ';
		$text[10] = 'Doe';
	}
	/**
	 * 下面的输出结果会是什么
	 */
	public function question9(){
		$v = 1;
		$m = 2;
		$l = 3;
		if( ($l > $m) > $v){  
		    echo "yes";
		}else{
		    echo "no";
		}
	}
	/**
	 *执行下面代码$x会变成什么值呢？ 
	 */
	public function question10(){
		$x = NULL;
		if ('0xFF' == 255) {  
		    $x = (int)'0xFF';
		}
		echo $x; //0
	}
	
}