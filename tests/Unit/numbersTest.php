<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Helpers;

class numbersTest extends TestCase
{
    /**
     * Test ISBN number validator.
     *
     * @return void
     */
    public function testExample()
    {
        echo " testing numbers ";
        $isbnNumbers = [
            "807229654X", "807229654", "978 032 640 615-1", "978032640615", "0072296542",
            "176041640615766", "0072296552", "007-229-654 2", "2460323406152"
        ];
        $results = [1,0,1,0,1,0,0,1,1];

        $evaluated = [];
        foreach ($isbnNumbers as $isbn) {
            $evaluated[$isbn] = Helpers\ISBN::isValidISBN($isbn);
        }
        $index = 0;
        $true = true;

        foreach($evaluated as $number => $output) {
            $true = $true && ($results[$index] == $output['valid']);
            if(!$true) {
                echo $results[$index]."  true: ".($true? "1 ":"0 ");
                print_r($output);
            }
            $index++;
        }

        $this->assertTrue($true);
    }
}
