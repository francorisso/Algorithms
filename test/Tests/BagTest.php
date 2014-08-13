<?php

namespace test\Tests;

use test\Bag;

class BagTest extends \PHPUnit_Framework_TestCase
{
    /**
	* @param $input Array of arrays to be intersected
	* @param $expected_output Array result of intersect all the input arrays
	*
	* @dataProvider provider_test_main
	*/
    public function test_main( $input ){
    	$bag = new Bag;

    	foreach($input as $value){
    		$bag->add($value);
    	}

    	$items = $bag->get_items();
    	foreach($items as $item){
    		echo $item."\n";
    	}

    	echo "Second iteration\n";
		foreach($items as $item){
    		echo $item."\n";
    	}    	
    }

    public function provider_test_main(){
    	for($i=0;$i<10;$i++){
    		$toSort[$i] = $i;
    	}

    	return array(
    		//testcase#1
    		array(
	    	    $toSort,
			),
		);
    }

}

