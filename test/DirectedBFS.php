<?php

namespace test;

use test\Queue;

/**
* DFS (Depth First Search) algorithm based on a simple Graph representation. Returns the paths.
* The algorithm goes down the path of the first adjacent and then moves to the next adjacent, until it doesn't have more
*
* Solves the problem: Is there a path from vertex $s to $v? If so, how's the path?
*
* @author Franco Risso based on Robert Sedgewick book
*/
class DirectedBFS
{
    private $Graph;
    private $size;
    private $source;
    private $marked = array();
    private $edgeTo = array();//remembers each vertex path to $source

    /**
	* Creates the list of paths from the vertex $s
    */
    public function __construct( $Graph, $s ){
    	$this->Graph = $Graph;
    	$this->source = $s;
    	$this->marked_reset();

    	$this->search($s);
    }

    public function marked_reset(){
    	$marked = array();
    	for($i=0; $i<$this->Graph->V(); $i++){
    		$marked[$i] = false;
    	}
    	$this->marked = $marked;
    }

    /**
    * Searchs for all the vertices connected to $vertex
    * The algorithm takes the adjacent list of $vertex and for each one:
	* - put the source as first element in the queue
	* - remove the first element from the queue
	* - put all the adjacents in the queue.
	* - continue until the queue is empty
	* when it finished, $this->marked has the list of connected vertices to $vertex
	*/
    public function search( $vertex ){
    	$queue = new Queue;
    	$this->marked[$vertex] = true;
    	$queue->enqueue($vertex);
    	while(!$queue->is_empty()){
    		$v = $queue->dequeue();
    		$adjacents = $this->Graph->adjacents( $v );
    		foreach($adjacents as $w){
    			if($this->marked[$w]==false){
	    			$this->edgeTo[$w] = $v;
	    			$this->marked[$w] = true;
	    			$queue->enqueue($w);
	    		}	
    		}
    	}
    }

    /**
	* Is there a path from $source to $v?
    */
    public function has_path_to($v){
    	return $this->marked[$v];
    }

	/**
	* @return one path from $source to $v
    */
    public function path_to($v){
    	if(!$this->has_path_to($v)){
    		return array();
    	}
    	$path = array();
    	//use $x as moving index to find the path from $v to $source 
    	for( $x=$v; $x!=$this->source; $x=$this->edgeTo[$x] ){
    		array_unshift($path, $x);
    	}
    	array_unshift($path, $this->source);

    	return $path;
    }


}