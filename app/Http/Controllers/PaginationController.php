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

class PaginationController extends Controller
{
    public function paginationTest(){
        return view('paginationTest');
    }

    public function paginationTestNew(){
        return view('paginationTestNew');
    }

    public function searchTableData(){
        return view('searchTableData');
    }

    public function searchTableDataNew(){
        return view('searchTableDataNew');
    }
}
