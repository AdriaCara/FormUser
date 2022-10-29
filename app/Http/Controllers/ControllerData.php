<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ControllerData extends Controller
{

    public function validateData(Request $request){

        // Set "" all variables
        $name="";
        $lastName="";
        $NIF="";
        $gender="";
        $maritalStatus="";

        //Get the values from the form
        $name = $request->input('name');
        $lastName = $request->input('lastName');
        $NIF = $request->input('NIF');
        $gender = $request->input('gender');
        $maritalStatus = $request->input('maritalStatus');

        //Check if the values are empty
        if ($name!="" && $lastName!="" && $NIF!="" && $gender!="" && $maritalStatus!="" && $this->validate_nif($NIF)) {
            $this->saveData($name, $lastName, $NIF, $gender, $maritalStatus);
            
            return view('form');
            
        } else {

            return view('form');

        }

    }

    function validate_nif($dni){
        $char = substr($dni, -1);
        $numbers = substr($dni, 0, -1);
        $result = false;
        if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $char && strlen($char) == 1 && strlen ($numbers) == 8 ){
          $result = true;
        }

        return $result;
      }

    public function saveData($name, $lastName, $NIF, $gender, $maritalStatus) {

        if (Storage::disk('public')->missing('DataUser.xml')) {

            Storage::disk('public')->put(
                'DataUser.xml', '<?xml version="1.0" encoding="UTF-8"?>');
        }

        Storage::disk('public')->append(
            'DataUser.xml', '<user>
    <name>'.$name.'</name>
    <lastName>'.$lastName.'</lastName>
    <NIF>'.$NIF.'</NIF>
    <gender>'.$gender.'</gender>
    <maritalStatus>'.$maritalStatus.'</maritalStatus>
</user>');

        if (Storage::disk('local')->missing('DataUser.json')) {

            Storage::disk('local')->put(
                'DataUser.json', 
'{
    "name": "'.$name.'",
    "lastName": "'.$lastName.'",
    "NIF": "'.$NIF.'",
    "gender": "'.$gender.'",
    "maritalStatus": "'.$maritalStatus.'"
}');

        } else {

            Storage::append('DataUser.json',
'{  
    "name": "'.$name.'",
    "lastName": "'.$lastName.'",
    "NIF": "'.$NIF.'",
    "gender": "'.$gender.'",
    "maritalStatus": "'.$maritalStatus.'"
}');

        }

    }
}
