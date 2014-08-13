<?php

namespace test;

/**
* Quicksort uses divide and conquer.
* This implementation uses Dijkstra 3-way partitioning to be linear when having to sort tons of repeated elements
*/
class QuickSort {

    public $method = "asc";//asc=>min to max, desc=>max to min
    public $array = null;//array to be sorted

    /**
    * @return sorted $array
    */
    public function sort( $array ){
        if(!is_array($array)){
            throw new InvalidArgumentException("One parameter is not an array.");
            return null;
        }
        $this->array = $array;
        shuffle($this->array);

        $this->helper_sort( 0, count($this->array)-1 );

        return $this->array;
    }

    /**
    * Sorts the array($lo, $hi)
    *
    */
    private function helper_sort( $lo, $hi ){
        //we don't need to sort this :)
        if($hi<=$lo){
            return;
        }

        $lt = $lo; //index: lower than pivot
        $gt = $hi; //index: greater than pivot
        $i = $lo+1;//index: window to measure equal elements. goes one more than $lt.
        
        //value of reference: is the first element (I can choose whatever element really)
        //all the items to the left are smaller, all the items to the right are bigger
        $pivot = $this->array[$lo];
        
        while($i<=$gt){
            if( $this->array[$i]<$pivot ){ //smaller, I move the $i and $lt in one position
                $this->swap($lt++,$i++);
            } elseif( $this->array[$i] > $pivot ){
                //bigger, $i remains in position, but the content of a[$i] swap with the bigger element, and the big index goes down, because all the values after this are bigger than the pivot
                $this->swap($i, $gt--);
            } else {
                $i++;//equal, I expand the window ($lt,$i)
            }
        }
        //recursive over the items smaller and bigger than the pivot
        $this->helper_sort($lo, $lt-1);
        $this->helper_sort($gt+1, $hi);
    }

    private function swap($index1, $index2){
        $aux = $this->array[$index1];
        $this->array[$index1] = $this->array[$index2];
        $this->array[$index2] = $aux;
    }

}