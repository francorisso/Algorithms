<?php

namespace test;

/**
* Directed Graph ADT 
* Implemented using an array of vertices with a bag associated with each vertex containing all the vertices that go from him to them
* @author Franco Risso based on Robert Sedgewick book
*/
class Digraph
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
        $this->E++;
    }

    /**
	* Get all the vertices pointed by $vertex
	* @return iterable object
    */
    public function adjacents( $vertex ){
    	return ( $this->vertices[$vertex]->is_empty()? array() :  $this->vertices[$vertex]->get_items() ); 
    }

    /**
    * Copy of the digraph with all the edges reversed
    * Useful to clients to get the vertices that point to each vertex
    */
    public function reverse(){
        $reverseGraph = new Digraph;
        for($v=0; $v<$this->V; $v++){
            $adj = $this->adjacents( $v );
            foreach($adj as $w){
                $reverseGraph.edge_add($w,$v);
            }
        }

        return $reverseGraph;
    }

}