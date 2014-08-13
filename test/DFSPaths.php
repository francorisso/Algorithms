<?php

namespace test;

/**
* DFS (Depth First Search) algorithm based on a simple Graph representation. Returns the paths.
* The algorithm goes down the path of the first adjacent and then moves to the next adjacent, until it doesn't have more
*
* Solves the problem: Is there a path from vertex $s to $v? If so, how's the path?
*
* @author Franco Risso based on Robert Sedgewick book
*/
class DFSPaths
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
	* - mark the vertex as visited
	* - visit recursively each of the adjacents to the vertex.
	* when it finished, $this->marked has the list of connected vertices to $vertex
	*/
    public function search( $vertex ){
    	$this->marked[$vertex] = true;
    	$adjacents = $this->Graph->adjacents($vertex);
    	foreach($adjacents as $v){
    		if($this->marked[$v]==false){
    			$this->edgeTo[$v] = $vertex;
    			$this->search($v);
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
    		$path[] = $x;
    	}
    	$path[] = $this->source;

    	return $path;
    }


}