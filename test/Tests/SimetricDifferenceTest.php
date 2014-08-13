<?php

namespace test\Tests;

use test\SimetricDifference;

class SimetricDifferenceTest extends \PHPUnit_Framework_TestCase
{
    /**
	* @param $array1
	* @param $array2
	* @param $expected_output
	*
	* @dataProvider provider_test_calculate
	*/
    public function test_calculate( $array1, $array2, $expected_output ){
    	
    	$simDiff = new SimetricDifference();
    	
    	$result = $simDiff->calculate( $array1, $array2 );

		$this->assertEquals( $expected_output, $result);
    }    

    public function provider_test_calculate(){
    	return array(
    		//test case 1
    		array(
	    	    array(2, 4, 6, 8, 3),
	    	    array(2, 4, 1, 8, 3),
	    	    array(6, 1),
			),

			//test case 2
			array(
	    	    array(1, 7, 8, 2, 4, 5),
	    	    array(3, 5, 1, 7, 6, 9),
	    	    array(8, 2, 4, 3, 6, 9),
			),
		);
    }

}

