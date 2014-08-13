<?php

namespace test;

class UnionFind {

    private $a_items = array();
    private $a_sizes = array();//size[i] = size of the tree i

    public function __construct(){
    }

    public function init( $array_size ){
        for( $i=0; $i<$array_size; $i++){
            $this->a_items[$i] = $i;
            $this->a_sizes[$i] = 1;
        } 
    }

    /**
    * 
    */
    public function union( $index1, $index2 ){
        $root1 = $this->root($index1);
        $root2 = $this->root($index2);
        
        //same component
        if($root1==$root2){
            return;
        }

        //otherwise, put the smaller tree as child of the biggest tree
        if( $this->size($root1) < $this->size($root2) ){
            $this->set_root($root1, $root2);
        } else {
            $this->set_root($root2, $root1);
        }
    }

    private function set_root($index, $root){
        $this->a_items[ $index ] = $this->root($root);
        $this->a_sizes[ $root ] += $this->a_sizes[ $index ];
    }

    public function connected($index1, $index2){
        return ( $this->root($index1)==$this->root($index2) );
    }

    public function root( $position ){
        while( $position != $this->a_items[ $position ] ){
            $position = $this->a_items[ $position ];
        }
        return $position;
    }

    private function size($position){
        return $this->a_sizes[ $this->root($position) ];
    }

    public function to_string(){
        return implode(" ",$this->a_items);
    }
}


$unionObj = new UnionFind();
$unionObj->init(10);

$unionObj->union(1,2);
$unionObj->union(5,1);
$unionObj->union(2,6);
$unionObj->union(4,9);
$unionObj->union(6,0);
$unionObj->union(7,8);
$unionObj->union(4,7);
$unionObj->union(6,7);
$unionObj->union(5,3);

echo $unionObj->to_string();