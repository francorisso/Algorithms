<?php

namespace test\Tests;

use test\RedBlackTree;
use test\Node;

class RedBlackTreeTest extends \PHPUnit_Framework_TestCase
{
    /**
	* @param $input Array of arrays to be intersected
	* @param $expected_output Array result of intersect all the input arrays
	*
	* @dataProvider provider_test_main
	*/
    public function test_main( $input ){
    	$rbTree = new RedBlackTree;
    	foreach($input as $key=>$value){
    		$rbTree->insert($key,$value);
    	}

    	for($i=0; $i<20; $i++){
	    	$start = microtime(true);
	    	echo $rbTree->search(rand(0,1000000)).":".( microtime(true)-$start )."\n";
    	}
    }

    public function provider_test_main(){
    	for($i=0;$i<1000000;$i++){
    		$toSort[$i] = uniqid();
    	}
    	/*$expected = $toSort;
    	sort( $expected );*/

    	return array(
    		//testcase#1
    		array(
	    	    $toSort,
			),
		);
    }

}

