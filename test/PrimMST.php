<?php

namespace test;

/**
* Prim's algorithm to find the MST (Minimum Spanning Tree) of a Graph
*
* @author Franco Risso based on Robert Sedgewick book
*/
class PrimMST
{
    private $edge_to = array();//shortest edge from tree vertex
    private $dist_to = array();//dist_to[w] = edge_to[w].weight()
    private $marked = array();//marked[v]=true if v in MST 
    private $p_queue; //priority queue having minimum edges
    private $graph;

    public function __construct( $graph ){
        $this->graph = $graph;
        for($v=0; $v<$graph->V(); $v++){
            $this->dist_to[$v] = INF;
            $this->marked[$v] = false;
        }
        $this->p_queue = new IndexMinPriorityQueue($graph->V());
        $this->p_queue->insert(0, 0);
        $this->dist_to[0] = 0;
        
        while(!$this->p_queue->is_empty()){
            $min = $this->p_queue->get_min_index();
            $this->p_queue->delete_min();
            $this->visit( $min );
        }
    }

    /**
    * Visits all the edges connected to $v searching for the best one and add it to the queue 
    */
    public function visit($v){
        $this->marked[$v] = true;
        $edges = $this->graph->adjacents($v);
        foreach($edges as $e){
            $w = $e->other($v);
            if($this->marked[$w]==true){
                continue;//w already in the MST
            }
            
            if($e->weight() < $this->dist_to[$w]){
                //e is the new best connection to the tree from $w
                $this->edge_to[$w] = $e;
                $this->dist_to[$w] = $e->weight();
                if($this->p_queue->contains($w)){
                    $this->p_queue->change($w, $this->dist_to[$w]);
                } else {
                    $this->p_queue->insert($w, $this->dist_to[$w]);   
                }
            }
        }
    }

    public function to_string(){
        $result = array();
        //because 0 is the initial node, has no edges pointing to it
        for($v=1; $v<$this->graph->V(); $v++){
            $result[] = $this->edge_to[$v]->to_string();
        }
        return implode("\n", $result);
    }

    

}