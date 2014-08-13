<?php

namespace test;

/**
* Edge ADT to represent edges on weighted graphs
*
* @author Franco Risso based on Robert Sedgewick book
*/
class Edge
{
    //the edge will be $v->$w, where $v,$w are vertices
    private $v;
    private $w;
    private $weight;

    public function __construct( $v, $w, $weight ){
        $this->v = $v;
        $this->w = $w;
        $this->weight = $weight;
    }

    /**
    * @return the weight
    */
    public function weight(){
        return $this->weight;
    }

    /**
    * @return the first vertex of the edge
    */
    public function either(){
        return $this->v;
    }

    /**
    * @return the other vertex in the edge
    */
    public function other($vertex){
        if($vertex==$this->v){
            return $this->w;
        } else {
            return $this->v;
        }
    }

    /**
    * Compares weights with the other edge
    * @return  less than $other_edge: -1, more than: 1, equal: 0
    */
    public function compare_to($other_edge){
        if( $this->weight() < $other_edge->weight() ){
            return -1;
        } elseif( $this->weight() > $other_edge->weight() ) {
            return 1;
        } else {
            return 0;
        }
    }

    /** 
    * @return string representation of the edge
    */
    public function to_string(){
        return $this->v."->".$this->w." ( ".$this->weight()." )";
    }

}