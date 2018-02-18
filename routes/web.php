<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('new-file','TestController@index');
Route::get('user-list','TestController@userList');
Route::get('get-users','TestController@getUsers');
Route::get('get-users-paginate','TestController0@getUsers');
Route::post('add-new-user','TestController@addNewUser');
Route::post('update-user','TestController@updateUser');
Route::post('delete-user','TestController@deleteUser');

Route::get('multiple-row','MultiController@multipleRow');
Route::post('add-multi-row-form-data','MultiController@addMultiRowFormData');

Route::get('multiple-row-calculation','MultiController@multipleRowCalculation');
Route::get('multiple-row-calculation-example','MultiController@multipleRowCalculationExample');

Route::get('simple-calculator','CalculatorController@simpleCalculator');
Route::get('exam-test','CalculatorController@examTest');
Route::post('exam-test-data-save','CalculatorController@examTestDataSave');

Route::get('pagination-test','PaginationController@paginationTest');
Route::get('pagination-test-new','PaginationController@paginationTestNew');

Route::get('search-table-data','PaginationController@searchTableData');
Route::get('search-table-data-new','PaginationController@searchTableDataNew');
