<?php

namespace App\Repository;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Hash;
use Validator;
use Auth;
use App\Http\Requests\EmployeeStoreRequest;

class EmployeesRepository
{

    public function getAllEmployees()
    {
        $user = Auth::user();
        dd($user);
        return $user['attendance'];
        return Employee::select('id','name','contact_no', 'designation', 'profile', 'department','job_type','email','password','joining_date','status')->get();
    }

    public function getEmployeesById($id)
    {
       return Employee::select('id','name','contact_no', 'designation', 'profile', 'department','job_type','email','password','joining_date','status')->whereId($id)->first();
    }

    public function createEmployee(Request $request)
    {
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->contact_no = $request->contact_no;
        $employee->designation = $request->designation;
        $employee->profile = $request->profile;
        $employee->department = $request->department;
        $employee->job_type = $request->job_type;
        $employee->email = $request->email;
        $employee->password = $request->password;
        $employee->joining_date = $request->joining_date;
        $employee->status = $request->status;
        $employee->save();
        // return $employee;

        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'scopes' => 'is_employee',
        ]);
        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password),true)) {
            return $user;
        }   
    }

    public function updateEmployee(Request $request, $id)
    {
        $employee = Employee::whereId($id)->first();
        if ($employee != null) {
            $employee->update([
                'name' => $request->name,
                'contact_no' => $request->conatct_no,
                'designation' => $request->designation,
                'profile' => $request->profile,
                'department' => $request->department,
                'job_type' => $request->job_type,
                'email' => $request->email,
                'password' => $request->password,
                'joining_date' => $request->joining_date,
                'status' => $request->status,
            ]);
            return $employee;
        }
        return null;
    }

    public function punchin(Request $request)
    {
        $id= $request->id;
        $attendances = array();
        $attendanceObj = array(
            'id'=> 1,
            'day'=> $request->day,
            'punch_time'=> $request->punch_time,
            'punch_out'=> "",
            'break_time'=> "",
            'full_day' => "",
            'over_time'=> "",
            'total_production_time' => "",
            "updated_at" => "",
        );
        $employeeAttendance = Employee::select('id', 'attendance')->where('id', $id)->get();
        if($employeeAttendance[0]->attendance == null){
            $date = "22-1-22";
            $updatedAttendanceObj[$date] = $attendanceObj;
            // dd($updatedAttendanceObj);
            array_push($attendances, $updatedAttendanceObj);
        } else {
            $empAttendanceArr = $employeeAttendance[0]->attendance;
            // dd(gettype($employeeAttendance[0]->attendance));
            $attendanceId = sizeof($empAttendanceArr)+1;
            // dd( $attendanceId );
            $attendanceObj['id'] = '';
            $attendanceObj['day'] = $request->day;
            $attendances = $employeeAttendance[0]->attendance;
            $date = "23-1-22";
            $updatedAttendanceObj[$date] = $attendanceObj;
            array_push($attendances, $updatedAttendanceObj);
            // dd($attendances);
        }
        // dd($attendanceObj, $id, );
        Employee::where('id', $id)->update(['attendance' => $attendances]);
        return response()->json([
            'employees' => $attendances
        ]);             
    }

    public function punchOut(Request $request)
    {
        $id= $request->id;
        $punchOut = $request->punchOut;
        $punchOutTime =  $request->punch_out;
        $attendances = array();
        // dd($attendances);
        $employeeAttendance = Employee::select('id', 'attendance')->where('id', $id)->get();
        $attendances = $employeeAttendance[0]->attendance;
        // dd( $employeeAttendance);
        for($i = 0; $i < sizeof($attendances); $i++){
            // dd($attendances[$i][$punchOut]);
            if(isset($attendances[$i][$punchOut])){
                $attendances[$i][$punchOut]["punch_out"]  = $punchOutTime;
            }
        }
        Employee::where('id', $id)->update(['attendance' => $attendances]);
        return response()->json([
            'employees' => $attendances
        ]);             
    }

    public function userDashboard()
    {
        $users = User::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function adminDashboard()
    {
        $users = Admin::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

       else{ 
            $user = array(
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
               
            );
            return User::create($user);
        }
        }
        public function signin(Request $request){
            $fields = $request->validate([

                'email'=>'required|string|email',
                'password'=>'required|string'   
               ]);
       
               //Check email
       
               $user= User::where('email', $fields['email'])->first();
       
               //Check Password
               if(!$user || !Hash::check($fields['password'], $user->password) ){
                   return response([
                       'message'=>'Invalid Credentials'
                   ], 401);
               }
       
               $token = $user->createToken('Employee' , ['is_employee'])->accessToken;
       
               $response= [
                   'user' => $user,
                   'token'=> $token,
                   'messgae' => "Login success"
               ];
       
               return response($response, 201);
           }
       
        
    
    

    public function adminLogin(Request $request)
    {
      
            $admin = array(
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
               
            );
            return Admin::create($admin);
        
    }


    public function adminsignin (Request $request){

        $fields = $request->validate([

            'email'=>'required|string|email',
            'password'=>'required|string'   
           ]);
   
           //Check email
   
           $user= Admin::where('email', $fields['email'])->first();
   
           //Check Password
           if(!$user || !Hash::check($fields['password'], $user->password) ){
               return response([
                   'message'=>'Invalid Credentials'
               ], 401);
           }
   
           $token = $user->createToken('Admin' , ['is_admin'])->accessToken;
   
           $response= [
               'admin' => $user,
               'token'=> $token,
               'messgae' => "Login success"
           ];
   
           return response($response, 201);
       }
   
 

    // public function getEmployeeWithComments($id){
    //     return Employee::select('id','name','description','status')
    //         ->whereId($id)
    //         ->with('comments')->first();
    // }
}
