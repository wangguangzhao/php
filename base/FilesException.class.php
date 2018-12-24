<?php

namespace php\base;

class FilesException extends \RuntimeException{
	 
	/**
	 * 文件不存在
	 * @param unknown $file
	 * @return \php\base\FilesException
	 */
	static  function fileNotExists($file){
		return new self("not find {$file}");
	}
	
	/**
	 * 文件无读权限
	 * @param unknown $file
	 * @return \php\base\FilesException
	 */
	static function fileCannotRead($file){
		return new self("{$file} is not allow read");
	}
	
	/**
	 * 文件无写权限
	 * @param unknown $file
	 * @return \php\base\FilesException
	 */
	static function fileCannotWrite($file){
		return new self("{$file} is not allow write");
	}
	
	/**
	 * 文件无可执行权限
	 * @param unknown $file
	 * @return \php\base\FilesException
	 */
	static function fileCannotExec($file){
		return new self("{$file} is not allow execute");
	}
	
}