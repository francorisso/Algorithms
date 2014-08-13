<?php

namespace test\Tests;

use test\Digraph;
use test\DirectedDFS;
use test\DirectedBFS;
use test\Queue;

class DirectedGraphTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider provider_test_paths
	*/
    public function test_dfs( $V, $edges ){
    	
    	$graph = new Digraph($V);

    	foreach($edges as $edge){
    		$graph->edge_add($edge[0],$edge[1]);
    	}

    	$source = 2;
    	$dfs = new DirectedDFS($graph, $source);//paths from 2 to the rest
    	for($i=0; $i<$V; $i++){
    		$path = $dfs->path_to($i);
    		echo $source."->". $i . ") " . ( empty($path)? "No path" : implode( " -> ", $path ) ) . "\n";
    	}

    }

    /**
    * @dataProvider provider_test_paths
	*/
    public function test_bfs( $V, $edges ){
    	
    	$graph = new Digraph($V);

    	foreach($edges as $edge){
    		$graph->edge_add($edge[0],$edge[1]);
    	}

    	$source = 2;
    	$dfs = new DirectedBFS($graph, $source);//paths from 2 to the rest
    	for($i=0; $i<$V; $i++){
    		$path = $dfs->path_to($i);
    		echo $source."->". $i . ") " . ( empty($path)? "No path" : implode( " -> ", $path ) ) . "\n";
    	}

    }

    public function provider_test_paths(){
    	return array(
    		//testcase#1
    		array(
    			10,
    			array(
    				array(1,2),
		    	    array(2,3),
		    	 	array(5,7),
		    	    array(1,9),
		    	    array(9,2),
		    	    array(1,8),
		    	    array(2,9),
		    	    array(9,1),
		    	    array(8,5),
		    	    array(7,6),
		    	    array(6,4),
		    	)
			),
		);
    }

}

