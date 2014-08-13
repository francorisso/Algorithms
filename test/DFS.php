<?php

namespace test;

/**
* DFS (Depth First Search) algorithm based on a simple Graph representation
* The algorithm goes down the path of the first adjacent and then moves to the next adjacent, until it doesn't have more
* @author Franco Risso based on Robert Sedgewick book
*/
class DFS
{
    private $Graph;
    private $size;
    private $marked;

    public function __construct( $Graph ){
    	$this->Graph = $Graph;
    	
    	$this->marked_reset();
    }

    /**
	* @return list of vertices connected to the vertex $v
    */
    public function connections( $v ){
    	$this->search($v);

    	$result = array();
    	foreach($this->marked as $v=>$marked){
    		if($marked==true){
    			$result[] = $v;
    		}
    	}
    	return $result;
    }

    public function marked_reset(){
    	$this->marked = array();
    	for($i=0; $i<$this->Graph->V(); $i++){
            $this->marked[] = false;
    	}
    }

    /**
    * Searchs for all the vertices connected to $vertex
    * The algorithm takes the adjacent list of $vertex and for each one:
	* - mark the vertex as visited
	* - visit recursively each of the adjacents to the vertex.
	* when it finished, $this->marked has the list of connected vertices to $vertex
	*/
    public function search( $vertex ){
    	$this->marked[$vertex] = true;
    	$adjacents = $this->Graph->adjacents($vertex);
    	foreach($adjacents as $v){
    		if($this->marked[$v]==false){
    			$this->search($v);
    		}
    	}
    }


}