<?php

namespace test\Tests;

use test\Edge;
use test\EdgeWeightedGraph;

class DirectedGraphTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider provider_test_edges
	*/
    public function test_dfs( $V, $edges ){
    	
    	$graph = new EdgeWeightedGraph($V);
    	foreach($edges as $edge_info){
            $edge = new Edge($edge_info[0],$edge_info[1],$edge_info[2]);
    		$graph->edge_add($edge);
    	}
        echo $graph->edges_to_string();
    }

    public function provider_test_edges(){
    	return array(
    		//testcase#1
    		array(
    			10,
    			array(
    				array(1,2,4),
		    	    array(2,3,5),
		    	 	array(5,7,2),
		    	    array(1,9,6),
		    	    array(9,2,3),
		    	    array(1,8,2),
		    	    array(2,9,9),
		    	    array(9,1,10),
		    	    array(8,5,10),
		    	    array(7,6,14),
		    	    array(6,4,12),
		    	)
			),
		);
    }

}

