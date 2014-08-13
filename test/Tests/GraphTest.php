<?php

namespace test\Tests;

use test\Graph;

class GraphTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider provider_test_main
	*/
    public function test_main( $V, $edges ){
    	$graph = new Graph($V);

    	foreach($edges as $edge){
    		$graph->edge_add($edge[0],$edge[1]);
    	}

    	for($i=0;$i<$V;$i++){
	    	$vertices = $graph->adjacents($i);
	    	echo $i." -> ";
	    	$adj=array();
	    	foreach($vertices as $vertex){
	    		$adj[] = $vertex;
	    	}
	    	echo implode("-", $adj)."\n";
	    }

    }

    public function provider_test_main(){
    	return array(
    		//testcase#1
    		array(
    			10,
    			array(
    				array(1,2),
		    	    array(2,3),
		    	 	array(5,7),
		    	    array(2,8),
		    	    array(1,9),
		    	    array(9,2),   
		    	)
			),
		);
    }

}

