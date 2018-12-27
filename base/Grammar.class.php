<?php
namespace php\base;
/**
 * 变量
 * 静态变量:1、静态变量属于静态存储方式，其存储空间为内存中的静态数据区（在静态存储区内分配存储单元），该 区域中的数据在整个程序的运行期间一直占用这些存储空间（在程序整个运行期间都不释放），也可以认为是其内存地址不变，直到整个程序运行结束
 * 2、所有的全局变量都是静态变量，而局部变量只有定义时加上类型修饰符static，才为局部静态变量。
 * 		静态局部变量：static类型的内部变量是一种只能在某个特定函数中使用，但一直占据存储空间的变量。
 * 		静态全局变量：全局变量本身就是静态存储方式，静态全局变量当然也是静态存储方式。
 * 类静态变量:静态存储在静态数据区，所有调用的地共享一份，可以修改，修改后所有调用的地都会变; 类内部可通过 self static两种方式访问
 * 常量:一经定义不允许修改或重新定义该常量（不起效），严格区分大小写
 * 类常量:一经定义不允许改变且所有能访问的地获取到的值都一样,类内部可通过 self static两种方式访问
 * 
 * 
 */
/** 普通局部变量 */
header("Content-type:text/html;charset=utf8");
function local() {
    $loc = 0; //这样，如果直接不给初值0是错误的。
    ++$loc;
    echo $loc . '<br>';
}
local(); //1
local(); //1
local(); //1
echo '<br>===================================<br/>';
 
/** static静态局部变量 */
function static_local() {
    static $local = 0 ; //此处可以不赋0值
    $local++;
    echo $local . '<br>';
}
static_local(); //1
static_local(); //2
static_local(); //3
//echo $local; 注意虽然静态变量，但是它仍然是局部的，在外不能直接访问的。
echo '<br>=======================================<br>';
 
/** static静态全局变量(实际上:全局变量本身就是静态存储方式,所有的全局变量都是静态变量) */
function static_global() {
    global $glo; //此处，可以不赋值0，当然赋值0，后每次调用时其值都为0，每次调用函数得到的值都会是1，但是不能想当然的写上"static"加以修饰，那样是错误的.
    $glo++;
    echo $glo . '<br>';
}
static_global(); //1
static_global(); //2
static_global(); //3

echo '<br>====================类静态变量===================<br>';
class Demo{
	static $DEMO1 = array(2,3,4);
}
Demo::$DEMO1 = 5;
$demoobj1 = new Demo;
var_dump($demoobj1::$DEMO1);
var_dump(Demo::$DEMO1);

$demoobj2 = new Demo;
var_dump($demoobj2::$DEMO1);
var_dump(Demo::$DEMO1);
echo '<br>====================常量===================<br>';

const MYDEMO = 1;
echo MYDEMO;
const mydemo  = 55;
echo mydemo;

echo '<br>====================类常量===================<br>';

class Demo2{
	const DEMO2 = 2;
	public function __construct(){
		var_dump(static::DEMO2);
		var_dump(self::DEMO2);
	}
}
 
echo Demo2::DEMO2;
$obj2 = new Demo2;
echo $obj2::DEMO2;
$obj3 = new Demo2;
$obj4 = new Demo2;


