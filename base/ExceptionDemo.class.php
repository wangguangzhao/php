<?php
/**
 * php异常处理详解
 * 
 */
namespace php\base;

class ExceptionDemo{
	
	
	public function __construct(){
		header("Content-type:text/html;charset=utf8");
		
	}
	
	public function badException(){
		try {
			$file = "./test.php";
			//校验文件是否存在（跟读写权限无关）
			if(!file_exists($file)) throw FilesException::fileNotExists($file);
			//无读权限
			if(!is_readable($file)) throw FilesException::fileCannotRead($file);
			//无写权限
			if(!is_writeable($file)) throw FilesException::fileCannotWrite($file);
			if(!is_executable($file)) throw FilesException::fileCannotExec($file);
				
			
		}catch (FilesException $e){
			$arr = [23,"23sfdfsd",23,4,"ddr"];
			echo print_r($arr,true);
			echo $e->getMessage();
		}
	}
	
	public function test($test){
		
	}
	
	
	
}
 