<?php

namespace test;

/**
* Edge weighted digraph ADT 
* Implemented using an array of edges with a bag associated with each vertex containing all the edges that is part.
* @author Franco Risso based on Robert Sedgewick book
*/
class EdgeWeightedDigraph
{
    private $V = 0;//number of vertices
    private $E = 0;//number of edges
    private $edges;

    public function __construct($V){
    	$this->V = $V;
    	$this->edges = array();
    	for( $i=0; $i<$V; $i++){
    		$this->edges[$i] = new Bag;
    	}
    }

    public function E(){
    	return $this->E;
    }

    public function V(){
    	return $this->V;
    }

    /**
	* Adds an edge for the vertices $vertex1<->$vertex2
    */
    public function edge_add( $edge ){
        $this->edges[$edge->from()]->add( $edge );

        $this->E++;
    }

    /**
	* Get all the edges with $vertex in it
	* @return iterable object
    */
    public function adjacents( $vertex ){
    	return ( $this->edges[$vertex]->is_empty()? array() :  $this->edges[$vertex]->get_items() ); 
    }

    /**
    * Get all the edges
    * @return iterable object
    */
    public function edges(){
        $bag = new Bag;
        for($v=0; $v<$this->V; $v++){
            $edges = $this->edges[$v]->get_items();
            foreach($edges as $edge){
                $bag->add($edge);
            }
        }
        return $bag;
    }

    /**
    * Get all the edges in string representation
    * @return string
    */
    public function to_string(){
        $edges_str = array();
        for($v=0; $v<$this->V; $v++){
            $edges = $this->edges[$v]->get_items();
            foreach($edges as $edge){
                $edges_str[] = $edge->to_string();
            }
        }
        return implode(", ", $edges_str);
    }

    

}