<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers;
use Illuminate\Support\Facades\Input;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Example numbers to test validate
        $isbnNumbers = [
            "807229654X", "807229654", "978 032 640 615-1", "978032640615", "0072296542",
            "176041640615766", "0072296552", "007-229-654 2", "2460323406152"
        ];

        $sampleOutput = "";
        // Generate sample output showing potential ISBNs and whether or not they're valid.
        // Iterate over the array, checking each value and inserting results in to $line and appending to the output.
        $evaluated = [];
        foreach ($isbnNumbers as $isbn) {
            $evaluated[$isbn] = Helpers\ISBN::isValidISBN($isbn);
        }

        return view('welcome')->with('evaluated', $evaluated);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $mappings = [
            "isbn" => "isbn",
            "copyright" => "date",
            "bookName" => "isText",
            "bookAuthor" => "isText"
        ];

        // Pass the method mapping to the myValidator object.
        $validator = new Helpers\myValidator($mappings);

        // Validate the number and return the result as a json encoded object.
        $app = app();
        $data = $app->make('stdClass');
        foreach ($mappings as $key => $value) {
            $data->$key = $validator->isValid([$key => $request->get($key)]);
        }

        echo json_encode($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
