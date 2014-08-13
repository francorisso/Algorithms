<?php

namespace test;

/**
* Node representation for Trees
* Has a link to the left and right subtrees.
* Has a Key to identificate the node, and a Value associated with it.
* Optional, has a color for red-black trees, that is the color of the link to the parent. 
*/
class Node {
	public $left;
	public $right;
	public $color;
	public $size;
	public $key;
	public $value;
}