<?php

class Test {

    public function array_intersect_custom(){
        $arguments_num = func_num_args();
        $arguments = func_get_args();
        $result = array();
        for($i=0; $i<count($arguments); $i++){
            $array = $arguments[$i];
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

}



$result = array_intersect_custom(
    array(3,4,5),
    array(1,2,5,7,8,10),
    array(5,2)
);
print_r($result);