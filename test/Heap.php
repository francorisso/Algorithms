<?php

namespace test;

/**
* Heap data structure.
*/
class PriorityQueue {

    /**
    * @return sorted $array
    */
    public function insert( $array ){
        if(!is_array($array)){
            throw new InvalidArgumentException("One parameter is not an array.");
            return null;
        }
        $this->array = $array;

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

        //half of the array
        $mid = $lo + floor( ( $hi - $lo ) / 2 );

        $this->helper_sort( $lo, $mid );
        $this->helper_sort( $mid+1, $hi );

        //after I sort each part of the array, I merge them in one sorted array
        $this->merge( $lo, $mid, $hi );
    }

    /**
    * It merges the two parts of $this->array, inside the same array, 
    * sorting the items by comparing array($lo,$mid) vs array($mid+1,$hi)
    * 
    */
    private function merge($lo, $mid, $hi){
        //copy the chunk of the array
        $aux = array();
        for($k = $lo; $k<=$hi; $k++){
            $aux[$k] = $this->array[$k];
        }

        $i = $lo; $j=$mid+1;//low and high indexes
        for($k = $lo; $k<=$hi; $k++){
            //The first two compares check for indexes inside range, the other two are comparing the items and placing the smallest element first.
            if( $i>$mid ){
                $this->array[$k] = $aux[$j++];
            } elseif( $j>$hi ){
                $this->array[$k] = $aux[$i++];
            } elseif( $this->compare( $aux[$i], $aux[$j]) ){
                $this->array[$k] = $aux[$i++];
            } else {
                $this->array[$k] = $aux[$j++];
            }
        }
    }

    /**
    * compares $elem1 and $elem2.
    * $method="asc": $elem1<$elem2 = true
    * $method="desc": $elem2>$elem1 = true
    */
    private function compare($elem1, $elem2){
        switch($this->method){
            case "asc":
                return $elem1<$elem2;
                break;
            case "desc":
                return $elem2<$elem1;
                break;
        }
    }

}