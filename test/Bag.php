<?php

namespace test;

/**
* Bag ADT
* Implemented using a linked list
* @author Franco Risso based on Robert Sedgewick book
*/
class Bag
{
    private $first = null;//first node in the list

    /**
	* Adds an item in the top of the list, like a stack
    */
    public function add( $item ){
    	$first = new Node;
    	$first->item = $item;
    	$first->next = $this->first;

    	$this->first = $first;
    }

    public function get_items(){
    	return new ListIterator($this->first);
    }

    public function is_empty(){
        return $this->first==null;
    }
}

class Node {
	public $item = null;
	public $next = null;//Node
};

class ListIterator implements \Iterator{
	/**
	* Methods for iterator interface
    */
    private $current;
    private $first;

    function __construct( $node ){
    	$this->current = $node;
    	$this->first = $node;
    }

    public function rewind()
    {
        $this->current = $this->first;
    }
  
    public function current()
    {
    	if($this->current==null){
    		return null;
    	}

        $current_item = $this->current->item;

        return $current_item;
    }
  
    public function key() 
    {
        return $this->current->item;
    }
  
    public function next() 
    {
        if($this->current==null){
    		return null;
    	}

        $current_item = $this->current->item;
        $this->current = $this->current->next;

        return $current_item;
    }
  
    public function valid()
    {
        return ( $this->current !== null );
    }	
}