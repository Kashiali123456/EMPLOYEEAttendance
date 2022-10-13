<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repository\EmployeesRepository;
use App\Utils\Response;

class EmployeeController extends Controller
{
    use Response;
    protected EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository) {
        $this->employeesRepository = $employeesRepository;
    }

    public function index(){
        return $this->employeesRepository->getAllEmployees();
        // return $this->responseDataCount($tasks);
    }

    public function getEmployeesById($id){
        $task = $this->employeesRepository->getEmployeesById($id);
        if (!empty($task)){
            return $this->responseData($task);
        }
        return $this->responseDataNotFound(' Employee data not found');
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'contact_no' => 'required',
            'designation' => 'required',
            'profile' => 'required',
            'department' => 'required',
            'job_type' => 'required',
            'email' => 'required',
            'password' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseValidation($validator->errors());
        }

        $task = $this->employeesRepository->updateTask($request, $id);

        if ($task != null){
            return $this->responseData($task, "Employees Data is Update");
        }

        return $this->responseError('Employees Not Found', 404);

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'contact_no' => 'required',
            'designation' => 'required',
            'profile' => 'required',
            'department' => 'required',
            'job_type' => 'required',
            'email' => 'required',
            'password' => 'required',
            'joining_date' => 'required',
            'status' => 'required',
            'attendance' => '',
        ]);

        if ($validator->fails()) {
           return $this->responseValidation($validator->errors());
        }
        $task = $this->employeesRepository->createEmployee($request);
        if (!empty($task)){
           return $this->responseData($task, "Employees Created Successfully");
        }
        return $this->responseError();
    }


    public function punchIn(Request $request)
    {
        return $this->employeesRepository->punchin($request);
    }
    public function punchOut(Request $request)
    {
        return $this->employeesRepository->punchOut($request);
    }

    

    // public function getTaskWithComments($task_id){
    //    $task = $this->employeeRepository->getTaskWithComments($task_id);
    //    if ($task != null){
    //        return $this->responseData($task);
    //    }
    //    return $this->responseError('task tidak ditemukan', 404);
    // }

}
