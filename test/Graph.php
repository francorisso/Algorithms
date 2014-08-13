<?php

namespace test;

/**
* Graph ADT, no directed (v1->v2 => v2->v1)
* Implemented using an array of vertices with a bag associated with each vertex containing all his adjacent vertices.
* @author Franco Risso based on Robert Sedgewick book
*/
class Graph
{
    private $V = 0;//number of vertices
    private $E = 0;//number of edges
    private $vertices;

    public function __construct($V){
    	$this->V = $V;
    	$this->vertices = array();
    	for( $i=0; $i<$V; $i++){
    		$this->vertices[$i] = new Bag;
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
    public function edge_add( $vertex1, $vertex2 ){
    	$this->vertices[$vertex1]->add( $vertex2 );
    	$this->vertices[$vertex2]->add( $vertex1 );	
        $this->E++;
    }

    /**
	* Get all the adjacents to $vertex
	* @return iterable object
    */
    public function adjacents( $vertex ){
    	return ( $this->vertices[$vertex]->is_empty()? array() :  $this->vertices[$vertex]->get_items() ); 
    }

}