<?php

namespace test\Tests;

use test\MergeSort;

class MergeSortTest extends \PHPUnit_Framework_TestCase
{
    /**
	* @param $input Array of arrays to be intersected
	* @param $expected_output Array result of intersect all the input arrays
	*
	* @dataProvider provider_test_main
	*/
    public function test_main( $input, $expected_output ){
    	
    	$mergeSort = new MergeSort();
    	
    	$start = microtime(true);
    	$result = $mergeSort->sort($input);
    	echo count($input)." items: ".( microtime(true)-$start )."sec\n";

		$this->assertEquals($expected_output, $result);
    }

    public function provider_test_main(){
    	for($i=0;$i<1000000;$i++){
    		$toSort[$i] = rand(0,50);
    	}
    	$expected = $toSort;
    	sort( $expected );

    	return array(
    		//testcase#1
    		array(
	    	    array(1, 2, 3, 4, 5, 6),
				array(1, 2, 3, 4, 5, 6)
			),
			//testcase#2
			array(
	    		array(6, 5, 4, 3, 2, 1),
				array(1, 2, 3, 4, 5, 6)
			),
			//testcase#3
			array(
	    		array(6, 10, 4, 12, 21, 9),
				array(4, 6, 9, 10, 12, 21)
			),
			array(
				$toSort,
				$expected
			)
		);
    }

}

