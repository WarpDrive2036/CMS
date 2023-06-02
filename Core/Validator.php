<?php

namespace Core;

class Validator {

    // Like Java when a method is static it can be directly called without instantiating it
    public static function string($value,$min = 1,$max = INF){

        //Trim Excludes any entered empty spaces!
         $value = trim($value);

         // Check if the value is within range
         return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value){

        //Basically THE "filter_var" function basically scans a value & tries to see if it
        // matches a certain known category
        return filter_var($value,FILTER_VALIDATE_EMAIL);
    }
}