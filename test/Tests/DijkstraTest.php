<?php

namespace test\Tests;

use test\Edge;
use test\EdgeWeightedGraph;
use test\PrimMST;

use test\DirectedEdge;
use test\EdgeWeightedDigraph;
use test\DijkstraSP;

class MSTTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider provider_test_edges
    */
    /*	
    public function test_prim( $V, $edges ){
    	
    	$graph = new EdgeWeightedGraph($V);
    	foreach($edges as $edge_info){
            $edge = new Edge($edge_info[0],$edge_info[1],$edge_info[2]);
    		$graph->edge_add($edge);
    	}
        
        $primMST = new PrimMST($graph);
        echo $primMST->to_string();
    }
    */

    /**
    * @dataProvider provider_test_edges
    */
    public function test_dijkstra( $V, $edges ){
        
        $graph = new EdgeWeightedDigraph($V);
        foreach($edges as $edge_info){
            $edge = new DirectedEdge($edge_info[0],$edge_info[1],$edge_info[2]);
            $graph->edge_add($edge);
        }

        $source = 1; $destination = 0;
        
        $dSP = new DijkstraSP($graph,$source);
        $path = $dSP->path_to($destination);
        echo $dSP->path_to_string($path);
    }

    public function provider_test_edges(){
    	return array(
    		//testcase#1
    		array(
    			10,
    			array(
    				array(1,2,7),
                    array(1,3,5),
                    array(1,4,10),
                    array(2,3,4),
                    array(2,6,8),
                    array(2,8,1),
                    array(3,4,2),
                    array(3,6,2),
                    array(3,7,4),
                    array(4,5,7),
                    array(5,7,1),
                    array(5,0,1),
                    array(9,0,8),
                    array(9,1,2),
		    	)
			),
		);
    }

}

