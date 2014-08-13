<?php

namespace test\Tests;

use test\IndexMinPriorityQueue;

class MSTTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @dataProvider provider_test_edges
	*/
    public function test_mst( $N, $elements ){
    	$queue = new IndexMinPriorityQueue($N);
    	foreach($elements as $element){
            $queue->insert($element[0],$element[1]);    
        }
        
        while($queue->is_empty()==false){
            $element = $queue->get_min()."@".$queue->get_min_index();
            $queue->delete_min();
            echo $element."\n";
        }
    }

    public function provider_test_edges(){
    	return array(
    		//testcase#1
    		array(
    			10,
    			array(
    				array(1,40),
		    	    array(21,50),
		    	 	array(5,25),
		    	    array(2,60),
		    	    array(9,30),
		    	    array(14,20),
		    	)
			),
		);
    }

}

