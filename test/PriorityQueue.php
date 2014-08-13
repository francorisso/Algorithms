<?php

namespace test;

/**
* Priority queue based on a heap ADT (complete balanced binary tree)
* Implementation based on array where parent(i) = i/2
* @note To make things easier, the index 0 is not used.
*/
class PriorityQueue {

    protected $queue = array(0);
    protected $size = 0;

    function __construct( $queue=array(0) ){
        $this->queue = $queue;
        $this->size = count($queue)-1;
    }

    /**
    * Get the maximum of the queue and removes it from the queue.
    * @return $value of the element in the top position
    */
    public function get_max(){
        $max = $this->get_value(1);//remember, position 0 is null
        $this->swap(1, $this->get_size());
        $this->queue[ $this->get_size() ] = null;
        $this->size--;
        $this->sink(1);

        return $max;
    }

    /**
    * Insert an element in the priority queue
    */
    public function insert( $value ){
        $this->size++;
        $this->queue[ $this->size ] = $value;
        $this->swim( $this->size );
    }

    /**
    * takes $element and bring it down the tree until get a position where the parent node is bigger and children nodes are smaller
    *
    */
    public function sink( $element ){
        $parent = $element;
        while( 2*$parent <= $this->get_size() ){
            //choose bigger child
            if( $this->less($parent*2, $parent*2+1) ){
                $big_child = $parent*2+1;
            } else {
                $big_child = $parent*2;
            }
            //if is bigger than the child, not need to sink anymore
            if( $this->less( $big_child, $parent ) ){
                break;
            }

            $this->swap($parent, $big_child);
            $parent = $big_child;
        }
    }

    /**
    * takes $element and bring it up the tree until get a position where the two nodes are smaller and the parent is bigger
    *
    */
    public function swim( $element ){
        while($element>1){
            $parent = floor($element/2);
            if( $this->get_value($parent)===null){
                break;
            }

            //if the parent is already bigger, then is ok
            if( $this->less( $element, $parent) ){
                break;
            }
            $this->swap( $element, $parent );
            $element = $parent;
        }
    }

    public function swap( $element1, $element2 ){
        $aux = $this->queue[$element1];
        $this->queue[$element1] = $this->queue[$element2];
        $this->queue[$element2] = $aux;       
    }

    /**
    * Returns the value of the element in the position $position from the three, if it doesn't exists returns -1 as value
    */
    public function get_value( $position ){
        return ( $position>0 && $position<=$this->get_size()? intval($this->queue[$position]) : null );
    }

    public function get_size(){
        return $this->size;
    }

    public function is_empty(){
        return ( $this->get_size()==0 );
    }

    /**
    * @return true if $elem1 is less important than $elem2, false otherwise.
    */
    private function less($elem1, $elem2){
        if( $this->get_value($elem2)===null){
            return false;//elem1 is more important because elem2 doesn't exists
        }
        if( $this->get_value($elem1)===null){
            return true;
        }
        //I can change here the definition of important, in this case is more important if the value is less
        return ( $this->get_value($elem1) > $this->get_value($elem2) );
    }

    public function to_string(){
        return implode(" ",$this->queue);
    }

}