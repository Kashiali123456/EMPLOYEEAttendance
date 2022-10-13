<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LoginController;


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

/*
* Route for task
*/
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employee', [EmployeeController::class, 'store']);
Route::get('/employee/{id}', [EmployeeController::class, 'getEmployeesById']);
Route::put('/employee/{id}', [EmployeeController::class, 'update']);
Route::post('/employee/punchin',[EmployeeController::class, 'punchIn']);
Route::post('/employee/punch_out',[EmployeeController::class, 'punchOut']);
Route::post('/admin/login',[LoginController::class, 'adminLogin'])->name('adminLogin');
Route::post('/admin/signin',[LoginController::class, 'adminSignin'])->name('adminSignin');
Route::group( ['prefix' => 'admin','middleware' => ['auth:admin-api','scopes:is_admin'] ],function(){
   // authenticated staff routes here 
    Route::get('/admin/dashboard',[LoginController::class, 'adminDashboard']);
});

Route::post('/user/login',[LoginController::class, 'userLogin'])->name('userLogin');
Route::post('/signin',[LoginController::class, 'signin'])->name('signin');
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:is_employee'] ],function(){
    // authenticated staff routes here 
     Route::get('user/dashboard',[LoginController::class, 'userDashboard']);
     
 });   