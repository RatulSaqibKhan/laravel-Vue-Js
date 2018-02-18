<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function simpleCalculator(){
        return view('simpleCalculator');
    }

    public function examTest(){
        return view('examTest');
    }

    public function examTestDataSave(Request $request){
        $info2 = [];
        foreach ($request->std_name as $key => $value) {
            $info2[$key]['std_name'] = $request->std_name[$key];
            $info2[$key]['std_roll'] = $request->std_roll[$key];
        }
        print_r($info2);

        $info1 = [];
        foreach ($request->std_name as $key => $value) {
            $info1[$key]['std_info'] = [
                'name'=> $request->std_name[$key],
                'roll'=> $request->std_roll[$key]
            ];
        }
        print_r($info1);
        exit;
    }
}
