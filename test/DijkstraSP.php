<?php

namespace test;

/**
* Dijkstra Shortest Path algorithm to find the shortest path in a weighted directed graph 
*
* @author Franco Risso based on Robert Sedgewick book
*/
class DijkstraSP
{
    private $edge_to = array();//shortest edge from tree vertex
    private $dist_to = array();//dist_to[w] = edge_to[w].weight()
    private $p_queue; //priority queue having minimum edges
    private $graph;
    private $source;

    public function __construct( $graph, $source ){
        $this->graph = $graph;
        for($v=0; $v<$graph->V(); $v++){
            $this->dist_to[$v] = INF;
            $this->edge_to[$v] = null;
            $this->marked[$v] = false;
        }
        $this->p_queue = new IndexMinPriorityQueue($graph->V());
        $this->dist_to[$source] = 0;
        $this->p_queue->insert($source, 0);
		$this->source = $source;

        while(!$this->p_queue->is_empty()){
            $min = $this->p_queue->get_min_index();
            $this->p_queue->delete_min();
            $this->relax( $min );
        }
    }

    public function relax($v){
        $edges = $this->graph->adjacents($v);
        foreach($edges as $e){
            $w = $e->to();
           	if($e->weight()+$this->dist_to[$v] < $this->dist_to[$w]){
                //e is the new best connection to the tree from $w
                $this->dist_to[$w] = $e->weight() + $this->dist_to[$v];
                $this->edge_to[$w] = $e;
                
                if($this->p_queue->contains($w)){
                    $this->p_queue->change($w, $this->dist_to[$w]);
                } else {
                    $this->p_queue->insert($w, $this->dist_to[$w]);   
                }
            }
        }
    }

    /**
	* Distance from source to $v
    */
    public function dist_to($v){
    	return $this->dist_to[$v];
    }

    /**
	* Is there a path from $source to $v?
    */
    public function has_path_to($v){
    	return ( $this->dist_to[$v]<INF );
    }

	/**
	* @return one path from $source to $v
    */
    public function path_to($v){
    	if(!$this->has_path_to($v)){
    		return array();
    	}
    	$path = array();
        for($e=$this->edge_to[$v]; $e!=null; $e = $this->edge_to[$e->from()]){
    		$path[] = $e;
    	}
    	return $path;
    }

    public function path_to_string($path){
        $result = array();
        $cost = 0;
        foreach($path as $edge){
            array_unshift($result,$edge->to());
            $cost += $edge->weight();
        }
        array_unshift($result, $this->source);
        return implode("->",$result)." - cost: ".$cost;
    }

}