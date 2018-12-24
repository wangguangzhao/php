<?php

spl_autoload_register(function($class){
	
	print_r($class);
	exit;
	
});

$test = new ExceptionDemo();
