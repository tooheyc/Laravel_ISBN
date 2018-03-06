<?php

namespace App\Helpers;

class ISBN13 extends ISBN_Base {
    public $modulo = 10;

    public function modifyMultiplier(&$multiplier) {
        // multiplier starts at 1, so it will be 1, 3, 1, 3, ....
        $multiplier = ($multiplier + 2) % 4;
    }
}
