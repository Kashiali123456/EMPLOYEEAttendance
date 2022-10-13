<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::post('/employees', function () {

//     return Employee::create([
//         'name'=>'Kashif Ali',
//          'contact_no'=>'030634647',
//          'designation'=>'UI/UX',
//          'profile'=> 'abc',
//          'department' => 'Software Developer',
//          'job_type'=>'Full Time or Half Time or Contract or Internship',
//          'email'=> 'techhunt@gmail.info',
//          'joining_date' => '14-09-2022',
//          'status'=>'True'
       

//     ]);

// });

// Route::post('/user/login',[LoginController::class, 'userLogin'])->name('userLogin');
// Route::post('/signin',[LoginController::class, 'signin'])->name('signin');
// Route::get('/employees',[EmployeeController::class,'index']);
// Route::post('/employees',[EmployeeController::class,'store']);
// Route::get('/employees/punch/{id}',[EmployeeController::class,'punch']);
// Route::post('/employees/punchin',[EmployeeController::class, 'punchin']);
// Route::post('/employees/punch-out',[EmployeeController::class, 'punchOut']);

// Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:is_employee'] ],function(){
//    // authenticated staff routes here 
//     Route::get('user/dashboard',[LoginController::class, 'userDashboard']);
    
// });   