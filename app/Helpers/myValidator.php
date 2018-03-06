<?php

namespace App\Helpers;

class myValidator extends validatorBase
{

    // The myTypes array maps post keys to myValidator methods.
    // If a mapping is not found, attempt to directly match the method: post key == method name.
    // If the method does not exist, an error will be generated for that key.
    public function __construct($myTypes = [])
    {
        if (count($myTypes) > 0) {
            $this->types = $myTypes;
        }
    }

    // Methods to validate inputs:

    public function date($date)
    {
        $result = ['valid' => true, 'value' => $date, 'err' => ''];
        while(true) {
            // If strtotime can't handle it, it's not a good date.
            if (!strtotime($date)) {
                $result['valid'] = false;
                $result['err'] = 'Invalid date.1';
                break;
            }
            if (strtotime($date) > strtotime(date('m/d/Y'))) {
                $result['valid'] = false;
                $result['err'] = 'Please verify date.';
                break;
            }
            $d = date("m/d/Y", strtotime($date));
            $month1 = explode("/", $d);
            $month2 = explode("/", $date);

            $badDate = false;
            // The strtotime function will convert a date like 2/29/2017 to 3/1/2017 and not return false.
            // Checking for that kind of thing here.
            if(count($month2) == count($month1)) {
                for($i = 0; $i < 3; $i++) {
                    if((int)$month1[$i] != (int)$month2[$i]) {
                        $badDate = true;
                        break;
                    }
                }
            } else $badDate = true;

            // strtotime() will try to "fix" bad dates like 02/30/2015 by
            // adding the extra days into the next month so we test for that here.
            if ($badDate && $result['valid']) {

                $result['valid'] = false;
                // if the month is numeric it's a bad date, but
                // if the two months are different, it's a bad format.
                if (strlen($month2[0]) <= 2) $result['err'] = "Invalid date.";
                elseif ($month1[0] != $month2[0]) $result['err'] = 'Please use format: MM/DD/YYYY';
            }
            break;
        }
        return $result;
    }

    public function isText($text)
    {
        $isText = ['valid' => true, 'value' => $text, 'err' => ''];
        // Requiring text to be at least one non white space character.
        if (trim($text) == "") {
            $isText['valid'] = false;
            $isText['err'] = 'Please enter at least one character.';
        }

        return $isText;
    }

    public function isbn($num)
    {
        // See the ISBN classes for ISBN validation rules.
        $result = ISBN::isValidISBN($num);
        return $result;
    }

}

