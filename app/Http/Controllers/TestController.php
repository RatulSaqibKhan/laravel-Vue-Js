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

class TestController extends BaseController
{
    public function index()
    {
        return view('newFile');
    }

    public function userList()
    {
        return view('userList');
    }

    public function getUsers()
    {
        $data = DB::table('users')
        ->join('file_upload', 'users.id', '=', 'file_upload.user_id')
        ->select('users.*', 'file_upload.*')
        ->get();
        return response()->json($data);
    }


    public function addNewUser(Request $request)
    {

        $response = [
            'status'=>'',
            'message'=>'',
        ];

        try{

            DB::beginTransaction();
            $user = new TestUserModel();
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $isInsert = $user->save();
            $insertedId = $user->id;

            if($request->hasFile('image'))
            {
                $file_upload = new FileUploadModel();
                $destinationPath =public_path('image/');
                $file = $request->file('image');
                $file->move($destinationPath,time().$file->getClientOriginalName());
                $file_upload->file_name = time().$file->getClientOriginalName();
                $file_upload->file_path = $destinationPath;
                $file_upload->user_id = $insertedId;
                $fileInsert = $file_upload->save();
                if (!$fileInsert) {
                    $response['status'] = 0;
                    $response['message'] = 'File Upload Failed';
                } else{
                    $response['status'] = 1;
                    $response['message'] = 'File Upload Success';
                }
            }

            DB::commit();

        }catch(Exception $e){
            DB::rollback();
            $response['status'] = 'Failed';
            $response['message'] = 'Data Insert Failed. Error Code: 101';
        }

        return response()->json($response);

    }

    public function updateUser(Request $request){

        $response = [
            'status'=>'',
            'message'=>'',
        ];

        try{
            DB::beginTransaction();
            $user = TestUserModel::findOrNew($request->id);
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $isUpdate = $user->save();
            $insertedId = $request->id;

            if($request->hasFile('image'))
            {
                $file_name_to_delete = DB::table('file_upload')->where('user_id', $insertedId)->value('file_name');
                unlink('image/'.$file_name_to_delete);
                $file_upload = FileUploadModel::firstOrNew(['user_id' => $insertedId]);
                $destinationPath =public_path('image/');
                $file = $request->file('image');
                $file->move($destinationPath,time().$file->getClientOriginalName());
                $file_upload->file_name = time().$file->getClientOriginalName();
                $file_upload->file_path = $destinationPath;

                $fileInsert = $file_upload->save();

                if (!$fileInsert) {
                    $response['status'] = 0;
                    $response['message'] = 'Data Update Failed';
                } else{
                    $response['status'] = 1;
                    $response['message'] = 'Data Update Success';
                }
            }

            DB::commit();

        }catch(Exception $e){
            DB::rollback();
            $response['status'] = 'Failed';
            $response['message'] = 'Data Insert Failed. Error Code: 101';
        }

        return response()->json($response);
    }

    public function deleteUser(Request $request){

        $response = [
            'status'=>'',
            'message'=>'',
        ];

        try{

            $user = TestUserModel::find($request->id);
            $userDeleate = $user->delete();

            $insertedId = $request->id;

            $file_name_to_delete = DB::table('file_upload')->where('user_id', $insertedId)->value('file_name');

            if(isset($file_name_to_delete))
            {
                $file_row_to_delete = DB::table('file_upload')->where('user_id', $insertedId)->first();
                unlink('image/'.$file_name_to_delete);

                $file_upload = FileUploadModel::firstOrNew(['user_id' => $insertedId]);
                $fileRowDeleate = $file_upload->delete();

                if (!$fileRowDeleate) {
                    $response['status'] = 0;
                    $response['message'] = 'Data Delete Failed';
                } else{
                    $response['status'] = 1;
                    $response['message'] = 'Data Delete Success';
                }
            }

            DB::commit();

        }catch(Exception $e){
            DB::rollback();
            $response['status'] = 'Failed';
            $response['message'] = 'Data Insert Failed. Error Code: 101';
        }

        return response()->json($response);
    }

    public function submit(Request $request){

        // $destinationPath =public_path('image/');
        // foreach ($request->file('image') as $image) {
        //     $imageName = time().getClientOriginalName();
        //     $uploadFile = $image->move($destinationPath,$imageName);
        //     if()
        // }

        if($request->hasFile('image'))
        {
            $destinationPath =public_path('image/');
            $file = $request->file('image');
            $file->move($destinationPath,$file->getClientOriginalName());
        }
    }

}
