<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use App\Repository\EmployeesRepository;
use App\Utils\Response;

class LoginController extends Controller
{

    use Response;
    protected EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository) {
        $this->employeesRepository = $employeesRepository;
    }
    public function userDashboard()
    {
        return $this->employeesRepository->userDashboard();
    }
    public function adminDashboard()
    {
        return $this->employeesRepository->adminDashboard();
    }
    public function userLogin(Request $request)
    {
        return $this->employeesRepository->userLogin($request);
}
public function signin(Request $request){
    return $this->employeesRepository->signin($request);
}
public function adminLogin(Request $request)
{
    return $this->employeesRepository->adminLogin($request);
}
public function adminsignin (Request $request){
    return $this->employeesRepository->adminsignin($request);
}
}
