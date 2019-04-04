<?php
/**
 * KitchenQueue
 * -------------------------------------------------------------
 * [游戏说明]
 * 假设你要为饭店创建一个接受顾客点菜单点应用程序，这个应用程序存储一系列点菜服务，服务员添加菜单，
 * 而厨师取出菜单并制作菜肴
 * -------------------------------------------------------------
 *
 * @author    Pu ShaoWei <pushaowei@360.cn>
 * @date      2017/12/3
 * @version   1.0
 * @license   MIT
 */
class KitchenQueue
{
    /**
     * @var \stdClass $cooking
     */
    protected $cooking;
    /**
     * 服务员
     *
     * @param $dishes
     */
    public function waiter($dishes)
    {
       $node = new stdClass;
	   $node->value = $dishes;
	   $node->next = null;
	   $lastnode = $this->cooking;
	   while($lastnode && $lastnode->next){
		   $lastnode = $lastnode->next;
	   }
	   if(!$this->cooking){
		   $this->cooking = $node;
	   }else{   
		   $lastnode->next = $node;
	   }
	}
	
	public function waiterTwo($dishes)
    {
       $node = new stdClass;
	   $node->value = $dishes;
	   $node->next = $this->cooking;
	   $this->cooking = $node;
	  }
    /**
     * 厨师
     *
     * @return \stdClass
     */
    public function kitchen()
    {
        return $this->cooking;
    }
}

$obj = new KitchenQueue;
// $obj->waiter("shou zhua yang rou ");
// $obj->waiter("fu qi fei pian ");
// $obj->waiter("jing jiang rou si ");
// $obj->waiter("ma po dou fu ");

$obj->waiterTwo("shou zhua yang rou ");
$obj->waiterTwo("fu qi fei pian ");
$obj->waiterTwo("jing jiang rou si ");
$obj->waiterTwo("ma po dou fu ");

var_dump($obj->kitchen());