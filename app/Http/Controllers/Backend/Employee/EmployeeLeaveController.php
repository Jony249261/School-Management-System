<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmployeSalaryLog;
use App\Model\Designation;
use App\Model\EmployeeLeave;
use App\Model\LeavePurpose;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;

class EmployeeLeaveController extends Controller
{
    public function view(){
        
        $data = EmployeeLeave::orderBy('id','DESC')->get();
        return view('backend.employee.employee_leave.view-leave', compact('data'));
    }


    public function add(){
        $leaves = LeavePurpose::all();
        $employees = User::where('usertype','Employee')->get();
        return view('backend.employee.employee_leave.add-leave', compact('leaves','employees'));
    }

    public function store(Request $request){
        
        if($request->leave_purpose_id == "0"){
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));

        $data->save();

        Session::flash('success','Employee Leave added Successfully');
        return redirect()->route('employee.leave.view');
    }


    public function edit($id){
        $leaves = LeavePurpose::all();
        $employees = User::where('usertype','Employee')->get();
        $data = EmployeeLeave::find($id);
        return view('backend.employee.employee_leave.edit-leave', compact('data','leaves','employees'));
     }


     public function update(Request $request, $id){
         
            if($request->leave_purpose_id == "0"){
                $leavepurpose = new LeavePurpose();
                $leavepurpose->name = $request->name;
                $leavepurpose->save();
                $leave_purpose_id = $leavepurpose->id;
            }else{
                $leave_purpose_id = $request->leave_purpose_id;
            }
        $data = EmployeeLeave::find($id);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));

        $data->save();
  
        Session::flash('success','Employee Leave Updated Successfully');
        return redirect()->route('employee.leave.view');
     }


    
     public function employeetDetails($id){

        $data = User::where('id',$id)->first();
        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details', compact('data'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
     }
}
