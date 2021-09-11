<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmployeSalaryLog;
use App\Model\EmployeeAttendence;
use App\Model\Designation;
use App\Model\EmployeeLeave;
use App\Model\LeavePurpose;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;

class EmployeeAttendenceController extends Controller
{
    public function view(){
        
        $data = EmployeeAttendence::select('date')->groupBy('date')->orderBy('id','DESC')->get();
        return view('backend.employee.employee_attendence.view-attendence', compact('data'));
    }


    public function add(){
        $employees = User::where('usertype','Employee')->get();
        return view('backend.employee.employee_attendence.add-attendence', compact('employees'));
    }

    public function store(Request $request){
        
        $date = date('Y-m-d',strtotime($request->date));
        $employee = EmployeeAttendence::where('date',$date)->delete();
        $employee = EmployeeAttendence::where('date',$date)->first();
       

        if($employee){
            Session::flash('error','Today Employee Attendence Already Taken');
        return redirect()->route('employee.attendence.view');
        }
        
        $countemployee = count($request->employee_id);
        for($i=0; $i<$countemployee;$i++){
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendence();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        Session::flash('success','Employee Attendence added Successfully');
        return redirect()->route('employee.attendence.view');
    }


    public function edit($date){
        $leaves = LeavePurpose::all();
        $employees = User::where('usertype','Employee')->get();
        $data = EmployeeAttendence::where('date',$date)->get();
        return view('backend.employee.employee_attendence.edit-attendence', compact('data','leaves','employees'));
     }
   
     public function Details($date){
         $dates = date('Y-m-d',strtotime($date));
        $data = EmployeeAttendence::where('date',$date)->get();
        //dd($data);
         return view('backend.employee.employee_attendence.details-attendence', compact('data'));

        
     }
}
