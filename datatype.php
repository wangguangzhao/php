<?php
/*
	php类型详解
*/
$memarystart = memory_get_usage () ;
// $str=1;
// $str="1";
// $str = array(1);
// $str =true;
// $str =new stdClass;
// $str=1.0;
// $str=fopen('./InterfaceDemo.php','r');
$str = null;
$memaryend = memory_get_usage () ;
// var_dump("is_int".is_int($str));
// var_dump("is_array".is_array($str));
// var_dump("is_bool".is_bool($str));
// var_dump("is_string".is_string($str));
// var_dump("is_object".is_object($str));
// var_dump("is_resource".is_resource($str));
// var_dump("is_numeric".is_numeric($str));
// var_dump("is_null".is_null($str));
// var_dump("is_float".is_float($str));
var_dump($memaryend-$memarystart);
 
 