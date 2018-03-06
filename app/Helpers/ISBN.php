<?php

namespace App\Helpers;

class ISBN { // Factory

    static public function isValidISBN($num) {
        // Some numbers may have dashes and/or spaces, so we'll remove them for testing.
        $len = ISBN::initialize($num);
        $result = ['valid'=>false, 'value'=>$num, 'err'=>'The number must have 10 or 13 digits.'];

        // We use different classes to handle different numbers of digits in a book number:
        // ISBN10 for 10 digits and ISBN13 for 13.
        $class = __NAMESPACE__ . '\\' ."ISBN".$len;
        if(class_exists($class)) {
            $obj = new $class();
            $result['valid'] = $obj->isValidISBN($num);
            $result['err'] = $result['valid'] ? 'Submission successful.' : 'Verify number.';
        } elseif(class_exists(__NAMESPACE__ . '\\' ."ISBN".($len+1))) {
            // If it's one digit short, see if we can find a digit that when added will make it valid.
            $result = ISBN::checkAddedDigit($num);
        }

        return $result;
    }

    // In cases where the number is a digit short we'll attempt to find a valid version by adding a digit.
    static public function checkAddedDigit($num) {

        //Check adding digits 0 - 9
        for($i = 0; $i < 10; $i++) {
            $result = ISBN::isValidISBN($num.$i);
            if($result['valid']) break;
        }

        // If still not valid, check adding digit X
        if(!$result['valid']) {
            $result = ISBN::isValidISBN($num."X");
        }

        // If it now shows valid, show how we made if valid
        if($result['valid']) {
            $result['err'] = 'Verify number. Did you mean: '.$result['value'] ."?";
            // Since we need to add a digit to make it valid, it's not really valid:
            $result['valid'] = false;
        }
        // Return the value we're checking, not what we've just tested.
        $result['value'] = $num;

        return $result;
    }

    static public function initialize(&$number) {
        // Remove white space.
        $number = str_replace(["-", " "], "", $number);
        return strlen($number);
    }

}
