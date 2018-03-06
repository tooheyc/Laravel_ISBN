<?php

namespace App\Helpers;

class ISBN10 extends ISBN_Base {
    public $modulo = 11;

    public function modifyMultiplier(&$multiplier) {
        $multiplier++;
    }
}
