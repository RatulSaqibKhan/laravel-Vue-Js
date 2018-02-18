<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use App\TestUserModel;
use App\FileUploadModel;
use App\MultipleRowTableModel;

class MultiController extends Controller
{
    public function multipleRow(){
        return view('multipleRow');
    }

    public function addMultiRowFormData(Request $request)
    {
        // print_r($_POST);exit;
        $response = [
            'status'=>'',
            'message'=>'',
        ];

        try{

            DB::beginTransaction();
            foreach ($request->std_name as  $key => $value) {
                $multi_data = new MultipleRowTableModel();
                $multi_data->std_name = $request->std_name[$key];
                $multi_data->std_roll = $request->std_roll[$key];
                $isInsert = $multi_data->save();
            }
            DB::commit();
            if (!$isInsert) {
                $response['status'] = 0;
                $response['message'] = 'Data Add Failed!';
            } else{
                $response['status'] = 1;
                $response['message'] = 'Data Added Successfully!';
            }
        }catch(Exception $e){
            DB::rollback();
            $response['status'] = 'Failed';
            $response['message'] = 'Data Insert Failed. Error Code: 101';
        }

        return response()->json($response);
    }

    public function multipleRowCalculation(){
        return view('multipleRowCalculation');
    }

    public function multipleRowCalculationExample(){
        return view('multipleRowCalculationExample');
    }
}
