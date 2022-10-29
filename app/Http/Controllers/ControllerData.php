<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\controllerRoutes;

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
        if ($request!="") {
            $name = $request->input('name');
            $lastName = $request->input('lastName');
            $NIF = $request->input('NIF');
            $gender = $request->input('gender');
            $maritalStatus = $request->input('maritalStatus');
        }

        //Check if the values are empty
        if ($name!="" && $lastName!="" && $NIF!="" && $gender!="" && $maritalStatus!="" && $this->validate_nif($NIF)) {
            $this->saveData($name, $lastName, $NIF, $gender, $maritalStatus);
            return "<body style='
                            background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%); 
                            background-image: linear-gradient(to top, #a8edea 0%, #fed6e3 100%); 
                            background-attachment: fixed; 
                            background-repeat: no-repeat; 
                            font-family: 'Vibur', cursive; font-family: 'Abel', sans-serif; 
                            opacity: .95;'>
                        <form method='get' action='form' style='text-align: center;
                                    width: 450px;
                                    min-height: 500px;
                                    height: auto;
                                    border-radius: 5px;
                                    margin: 2% auto;
                                    box-shadow: 0 9px 50px hsla(20, 67%, 75%, 0.31);
                                    padding: 2%;
                                    background-image: 
                                    linear-gradient(-225deg, #E3FDF5 50%, #FFE6FA 50%'>
                            <h2 style='letter-spacing: 0.05em;'>Info guardada amb exit</h2>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <button type='submit' style='display: inline-block;
                                color: #252537;
                            
                                width: 280px;
                                height: 50px;
                            
                                padding: 0 20px;
                                background: #F0F8FF;
                                border-radius: 5px;
                                
                                outline: none;
                                border: none;
                            
                                cursor: pointer;
                                text-align: center;
                                transition: all 0.2s linear;
                                
                                margin: 7% auto;
                                letter-spacing: 0.05em;'>Tornar a l'inici</button>
                        <form>
                    </body>";
            
        } else {

            return view('404');

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
