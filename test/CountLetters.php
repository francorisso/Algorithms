<?php

namespace test;

class CountLetters {

    /**
    * @param $array1
    * @param $array2
    * @return one array of items which occur in only one (not both) arrays
    */
    public function calculate( $array1, $array2 ){
        if(!is_array($array1) || !is_array($array2)){
            throw new InvalidArgumentException("One parameter is not an array.");
            return null;
        }

        $result_status = array();
        foreach($array1 as $number){
            $result_status[$number] = self::$ITEM_LONELY;
        }
        foreach($array2 as $number){
            $result_status[$number] = ( empty( $result_status[$number] )? self::$ITEM_LONELY : self::$ITEM_REPEATED );        
        }

        $result = array();
        foreach($result_status as $number=>$type){
            if($type==self::$ITEM_REPEATED){
                continue;
            }

            $result[] = $number;
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