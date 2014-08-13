<?php

namespace test;

/**
* Dijkstra Shortest Path algorithm to find the shortest path in a weighted directed graph 
*
* @author Franco Risso based on Robert Sedgewick book
*/
class Dijkstra
{
    private $edge_to = array();//shortest edge from tree vertex
    private $dist_to = array();//dist_to[w] = edge_to[w].weight()
    private $p_queue; //priority queue having minimum edges
    private $graph;

    public function __construct( $graph, $source ){
        $this->graph = $graph;
        for($v=0; $v<$graph->V(); $v++){
            $this->dist_to[$v] = INF;
            $this->marked[$v] = false;
        }
        $this->p_queue = new IndexMinPriorityQueue($graph->V());
        $this->dist_to[$source] = 0;
        $this->p_queue->insert($source, 0);
        
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

    public function to_string(){
        $result = array();
        //because 0 is the initial node, has no edges pointing to it
        for($v=1; $v<$this->graph->V(); $v++){
            $result[] = $this->edge_to[$v]->to_string();
        }
        return implode("\n", $result);
    }

    

}