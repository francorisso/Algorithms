<?php

namespace test\Tests;

use test\Algorithms;

class AlgorithmsTest extends \PHPUnit_Framework_TestCase
{
    /**
	* @param $input Array of arrays to be intersected
	* @param $expected_output Array result of intersect all the input arrays
	*
	* @dataProvider provider_test_array_intersect_custom
	*/
    public function test_array_intersect_custom( $input, $expected_output ){
    	
    	$o_algorithms = new Algorithms();
    	
    	$result = $o_algorithms->array_intersect_custom($input);

		$this->assertEquals($result, $expected_output);
    }

    public function provider_test_array_intersect_custom(){
    	return array(
    		//test case 1
    		array(
	    	    array(
	    	    	array(3,4,5),
				    array(1,2,5,7,8,10),
				    array(5,2)
				),
				array(5)
			),
			//test case 2
			array(
	    	    array(
	    	    	array(1, 2, 100, "b"),
				    array(1, 200, "b", 100, 2),
				    array(5, 2, 100, "c")
				),
				array(2,100)
			),
		);
    }


	/**
	* @param $input Array to be sorted
	* @param $expected_output String expected output
	*
	* @dataProvider provider_test_insertionSort
	*/
    public function test_insertionSort( $input, $expected_output ){
    	
    	$o_algorithms = new Algorithms();
    	
    	$result = $o_algorithms->insertionSort($input);

		$this->assertEquals( $expected_output, $result);
    }    

    public function provider_test_insertionSort(){
    	return array(
    		//test case 1
    		array(
	    	    array(2, 4, 6, 8, 3),
				"2 4 6 8 8\n". 
				"2 4 6 6 8\n". 
				"2 4 4 6 8\n". 
				"2 3 4 6 8"
			),
			//test case 2
		);
    }

}

