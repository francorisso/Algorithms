<?php

namespace test;

/**
* Priority queue based on a heap ADT (complete balanced binary tree)
* This priority queue has keys associated for each index, sorted by the index in ascendent way.
* @note To make things easier, the index 0 is not used.
*/
class IndexMinPriorityQueue {

    protected $queue = array(0);//binary heap starting in 1
    protected $queue_inv = array(0);//inverse (holding indexes) i = queue[ queue_rev[i] ] = queue_rev[ queue[i] ]
    protected $size = 0;
    protected $max_size = 0;
    protected $keys = array(0); //items with priorities

    function __construct( $max_size ){
        for($i=0; $i<=$max_size; $i++){
            $this->queue_inv[$i] = -1;//queue_inv[i]=-1 => i is not in the queue 
        }

        $this->max_size = $max_size;
    }

    /**
    * @return true if index has a key associated with it.
    */
    public function contains($index){
        return ( $this->queue_inv[$index] != -1 );
    }

    /**
    * Get the minimum of the queue
    * @return $value of the element in the top position
    */
    public function get_min(){
        return $this->keys[ $this->get_value(1) ];
    }

    /**
    * Get the minimum index in the queue
    */
    public function get_min_index(){
        return $this->get_value(1);
    }

    /**
    * Deletes the minimum element from the queue
    */
    public function delete_min(){
        $min_index = $this->get_value(1);//remember, position 0 is null
        $this->swap(1, $this->get_size());

        //the last no longer exists
        $this->keys[$this->get_value( $this->get_size() )] = null;
        $this->queue_inv[$this->get_size()] = -1;

        $this->size--;
        
        $this->sink(1);
    }

    /**
    * deletes the element with index $index.
    */
    public function delete($index){
        $this->swap($index, $this->size);
        $this->size--;
        
        //First I try to swim it up the tree
        //then I try to sink it 
        $this->swim( $this->queue_inv[ $index ] );
        $this->sink( $this->queue_inv[ $index ] );

        $this->keys[ $this->queue[$this->size+1] ] = null;
        $this->queue_inv[ $this->queue[$this->size+1] ] = -1;
    }

    /**
    * Insert an element in the priority queue, associating to the index $index
    */
    public function insert( $index, $key ){
        $this->size++;
        $this->queue[ $this->size ] = $index;
        $this->queue_inv[ $index ] = $this->size;
        $this->keys[ $index ] = $key;
        $this->swim( $this->size );
    }

    /**
    * Changes the value associated to $index
    */
    public function change($index, $key){
        $this->keys[$index] = $key;
        $this->swim($this->queue_inv[$index]);
        $this->sink($this->queue_inv[$index]);
    }

    public function get_size(){
        return $this->size;
    }

    public function is_empty(){
        return ( $this->get_size()==0 );
    }

    public function to_string(){
        return implode(" ",$this->queue);
    }

    /**
    * takes $element and bring it down the tree until get a position where the parent node is bigger and children nodes are smaller
    *
    */
    private function sink( $element ){
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
    private function swim( $element ){
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

    /**
    * swap the two elements
    */
    private function swap( $element1, $element2 ){
        $aux = $this->queue[$element1];
        $this->queue[$element1] = $this->queue[$element2];
        $this->queue[$element2] = $aux;       

        //now the indexes are different (because queue has changed positions)
        $this->queue_inv[$this->queue[$element1]] = $element1; 
        $this->queue_inv[$this->queue[$element2]] = $element2;
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
        return ( $this->keys[$this->get_value($elem1)] > $this->keys[$this->get_value($elem2)] );
    }

    /**
    * Returns the value of the element in the position $position from the three, if it doesn't exists returns -1 as value
    */
    private function get_value( $position ){
        return ( $position>0 && $position<=$this->get_size()? intval($this->queue[$position]) : null );
    }

    

}