<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // if(request()->isMethod('employees')) {
            
        //     return [
        //         'name'=>'Kashif Ali',
        //         'contact_no'=>'030634647',
        //         'designation'=>'UI/UX',
        //         'profile'=> 'abc',
        //         'department' => 'Software Developer',
        //         'job_type'=>'Full Time or Half Time or Contract or Internship',
        //         'email'=> 'techhunt@gmail.info',
        //         'joining_date' => '14-09-2022',
        //         'status'=>'True'

        //     ];
        // } else {
        //     return [
        //         'name'=>'Kashif Ali',
        //         'contact_no'=>'030634647',
        //         'designation'=>'UI/UX',
        //         'profile'=> 'abc',
        //         'department' => 'Software Developer',
        //         'job_type'=>'Full Time or Half Time or Contract or Internship',
        //         'email'=> 'techhunt@gmail.info',
        //         'joining_date' => '14-09-2022',
        //         'status'=>'True'
        //     ];
        
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
   
}
