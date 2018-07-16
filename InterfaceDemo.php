<?php
/*
	接口demo
	接口定义的方法中的参数个数是现实必须相同
*/
interface Itest{
	function test();
}

class Ctest implements Itest{

	public function test($name){
		ECHO 23;
	}
}

$obj = new Ctest();
$obj->test("Wgz");