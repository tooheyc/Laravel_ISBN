<?php

namespace App\Helpers;

abstract class ISBN_Base {

    abstract public function modifyMultiplier(&$x);

    public function isValidISBN($num) {
        $len = strlen($num);
        $multiply = 1;
        $val = 0;

        // Sum the digits * the multiplier value.
        for($n = 0; $n < $len; $n++) {
            $val += strtoupper(substr($num,$n,1)) == "X" ? 10 * $multiply : (int)substr($num,$n,1) * $multiply;
            // The multiplier varies depending on the position in the number and the number of digits.
            $this->modifyMultiplier($multiply);
        }

        // Modulo varies by the number of digits.
        return ($val % $this->modulo) == 0;
    }

}

