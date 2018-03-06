<?php

namespace App\Helpers;

class validatorBase
{
    protected $types = ["email" => "email", "date" => "date", "phone" => "phone"];

    // Entry point for validation requests.
    public function isValid($item = ['invalid' => 'Nothing was sent to the validator.'])
    {
        $result = [];

        if (!is_array($item)) {
            $result[] = ['vResponse' => 'Array expected, ' . $item . ' recieved.', 'value'=>$item ];
            return $result;
        }

        // Iterate through posted values calling the appropriate validation method.
        foreach ($item as $key => $value) {
            $methodToCall = array_key_exists($key, $this->types) ? $this->types[$key] : $key;
            $result['value'] = $value;
            $result['vResponse'] = (method_exists(get_class($this), $methodToCall)) ? $this->$methodToCall($value) :
                "There is no a validator available for &ldquo;" . $key . "&rdquo;.";
        }

        return $result;
    }

    public function invalid($x)
    {
        return $x;
    }

}
