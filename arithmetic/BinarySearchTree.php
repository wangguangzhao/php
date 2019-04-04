<?php
/**
 * 二叉搜索树
 * 
 * 二叉搜索树或者是一棵空树，或者是具有下列性质的二叉树：
 * 1.每个结点都有一个作为搜索依据的关键码(value)，所有结点的关键码互不相同。
 * 2.左子树（如果非空）上所有结点的关键码都小于根结点的关键码。
 * 3.右子树（如果非空）上所有结点的关键码都大于根结点的关键码。
 * 4.左子树和右子树也是二叉搜索树。
 * 
 * class Node {
 *  public $value;
 *  public $left = null;
 *  public $right = null;
 * }
 */
 
 class BinarySearchTree{
	 
	 //@var $root 根节点
	 public $root = null;
	 
	  
	 
	 /**
	 创建节点
	 @param int $value 节点值
	 @return mixed  node 
	 **/
	 public function createNode($value){
		 if((!$value && $value !== 0) || !is_numeric($value)){
			return null;
		 } 
		 
		 $stdClass = new StdClass;
		 $stdClass->left = null;
		 $stdClass->right = null;
		 $stdClass->value = $value;
		 
		 return $stdClass;
	 }
	 
	 
	  /**
     * 插入节点
     * @param $node  根节点
     * @param $value 关键值
     */
    public function insert(&$node, $value)
    {
		if($node == null){
			$node = $this->createNode($value);
		}else if($node->value < $value){
			$this->insert($node->right,$value);
		}else{
			$this->insert($node->left,$value);
		}
	}
	
	 /**
     * 先序遍历
     * @param $node 根节点
     */
    public function preOrder($node)
    {
		if($node!=null){
			print_r($node->value);
			$this->preOrder($node->left);
			$this->preOrder($node->right);
		}
	}
	  /**
     * 中序遍历
     * @param $node 根节点
     */
    public function middleOrder($node)
    {
		if($node!=null){
			$this->middleOrder($node->left);
			print_r($node->value);
			$this->middleOrder($node->right);
		}
	}
	
	   /**
     * 后序遍历
     * @param $node 根节点
     */
    public function afterOrder($node)
	{
		if($node!=null){
			$this->afterOrder($node->left);
			$this->afterOrder($node->right);
			print_r($node->value);
		}
	}
	
	 /**
     * 获取最大值
     * @param $node 根节点
	   @return mixed null or value
     */
    public function findMax($node) 
    {
		if(!$node) return null;
		while($node){
			$max = $node->value;
			$node = $node->right;			
		}
		return $max;
			
	}
	
	 /**
     * 获取最大值
     * @param $node 根节点
	 @return mixed null or value
     */
    public function findMin($node) 
    {
		if(!$node) return null;
		while($node){
			$min = $node->value;
			$node = $node->left;			
		}
		return $min;
		
		
	}
 }
  
 $obj = new BinarySearchTree;

 $obj->insert($obj->root,5);
 $obj->insert($obj->root,2);
 $obj->insert($obj->root,21);
 $obj->insert($obj->root,98);
 $obj->insert($obj->root,1);
 $obj->insert($obj->root,9);
 
 //print_r($obj->root);
 $obj->preOrder($obj->root);
 echo  "\n";
 $obj->middleOrder($obj->root);
 echo  "\n";
 $obj->afterOrder($obj->root);
 echo  "\n";
 echo $obj->findMax($obj->root);
 echo  "\n";
 echo $obj->findMin($obj->root);
 
 