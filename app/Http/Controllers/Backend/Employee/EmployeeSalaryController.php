<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\StudentYear;
use App\Model\EmployeSalaryLog;
use App\Model\Designation;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;


class EmployeeSalaryController extends Controller
{
    public function view(){
        
        $data = User::where('usertype','Employee')->get();
        return view('backend.employee.employee_salary.view-employee-salary', compact('data'));
    }



    public function increment($id){
        $data = User::find($id);
        return view('backend.employee.employee_salary.add-employee-salary', compact('data'));
     }


     public function store(Request $request, $id){
            
            $user = User::where('id',$id)->first();
            $previous_salary = $user->salary;
            $present_salary = (float)$previous_salary + (float)$request->increment_salary;
            $user->salary = $present_salary;
            $user->save();


            $salaryData = new EmployeSalaryLog();
            $salaryData->employee_id = $id;
            $salaryData->previous_salary = $previous_salary;
            $salaryData->increment_salary = $request->increment_salary;
            $salaryData->present_salary = $present_salary;
            $salaryData->effected_date = date('Y-m-d',strtotime($request->effected_date));;

            $salaryData->save();
  
        Session::flash('success','Employee Salary Increment Successfully');
        return redirect()->route('employee.salary.view');
     }


    
     public function employeetDetails($id){

        $data = User::where('id',$id)->first();
        $salary_log = EmployeSalaryLog::where('employee_id',$id)->get();
        
         return view('backend.employee.employee_salary.employee-salary-details', compact('data','salary_log'));
     }
}
