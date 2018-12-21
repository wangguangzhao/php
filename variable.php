<?php

/*
	变量及类型转换
*/

// $a = 1;
// $a = "1";
$a = array(1);
$a = new stdClass;
$b = $a;
$b=3;
var_dump($a); //1;

// $a = 1;
// $a = "1";
// $a = array(1);
$a = new stdClass;
$b = &$a;
$b=3;
var_dump($a); //3;



