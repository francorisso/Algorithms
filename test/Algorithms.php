<?php

namespace test;

class Algorithms {

    /**
    * @param $input Array of arrays to be intersected
    */
    public function array_intersect_custom( $input ){
        $result = array();
        for($i=0; $i<count($input); $i++){
            $array = $input[$i];
            if(!is_array($array)){
                throw new InvalidArgumentException("Parameter ".$i." is not an array.");
                return null;
            }
            //first step
            if($i==0){
                $result = $array;
                continue;
            }

            $result_old = $result;
            $result = array();
            foreach($array as $number){
                if(in_array($number, $result_old)){
                    $result[] = $number;
                }    
            }
        }
        return $result;
    }

    /**
    * @param $input Array of numbers to be sorted
    */
    public function insertionSort( $input ){
        $result = null;
        for ( $i=count($input)-1; $i>0; $i--){
            $pivot = $input[$i];
            for( $j=$i; $j>0; $j--){
                //swap input[i] with input[j]
                if($pivot<$input[$j-1]){
                    $input[$j]   = $input[$j-1];
                } else {
                    break;
                }
                $result[] = $this->print_array_nl($input,true);
            }
            if($input[$j]!=$pivot){
                $input[$j]   = $pivot;
                $result[]    = $this->print_array_nl($input,true);
            }
        }
        return implode("\n",$result);
    }


    /**
    * @param $input Array
    */
    public function booking_test( $input ){
        $result = null;
        
        $fn = function($elem){
            
        };

        foreach($input as $elem){
            
        }

        return $result;
    }


    public function print_array_nl($array, $return=false){
        $res = implode(" ", $array);
        if( $return ){
            return $res;
        } else {
            echo $res."\n";
        }
        
    }

}