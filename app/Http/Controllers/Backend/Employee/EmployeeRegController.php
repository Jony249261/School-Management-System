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


class EmployeeRegController extends Controller
{
    public function view(){
        
        $class = StudentClass::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $year_id = StudentYear::orderBy('id','DESC')->first()->id;
        $class_id = StudentClass::orderBy('id','ASC')->first()->id;
        $data = User::where('usertype','Employee')->get();
        return view('backend.employee.employee_reg.view-employee', compact('data'));
    }


    public function add(){
        $designation = Designation::all();
        return view('backend.employee.employee_reg.add-employee', compact('designation'));
    }

    public function store(Request $request){
        //dd($request);
        DB::transaction(function() use($request){
            $checkYear = date('Ym',strtotime($request->join_date));
            
            $employee = User::where('usertype', 'Employee')->orderBy('id', 'DESC')->first();
            if($employee == null){
                $firstreg = 0;
                $employeeId = $firstreg+1;
                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
                
            }else{
                $employee = User::where('usertype', 'Employee')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee+1;

                if($employeeId < 10){
                    $id_no = '000'.$employeeId;
                }elseif($employeeId < 100){
                    $id_no = '00'.$employeeId;
                }elseif($employeeId < 1000){
                    $id_no = '0'.$employeeId;
                }
            }

            $final_id_no = $checkYear.$id_no;

            $user = new User();  //User table data insert
            $user->id_no = $final_id_no;
            $user->usertype = 'Employee';
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));
            $code = rand(0000,9999);
            $user->password = bcrypt($code);
            $user->code = $code;
            if($request->file('image')) {
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee_images'), $filename);
            $user['image'] = $filename;
        
        }

            $user->save();

            $employee_salary = new EmployeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_date = date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();
 

        });
        Session::flash('success','Employee Registration Successfully');
        return redirect()->route('employee.registration.view');
    }


    public function edit($id){
        $data = User::find($id);
        $designation = Designation::all();
        return view('backend.employee.employee_reg.edit-employee', compact('data','designation'));
     }


     public function update(Request $request, $id){
         
            
            $user = User::where('id',$id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            if($request->file('image')) {
            @unlink(public_path('upload/employee_images/'.$user->image));
            $file = $request->file('image');
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/employee_images'), $filename);
            $user['image'] = $filename;
        
        }

            $user->save();
  
        Session::flash('success','Employee Registration Updated Successfully');
        return redirect()->route('employee.registration.view');
     }


    
     public function employeetDetails($id){

        $data = User::where('id',$id)->first();
        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details', compact('data'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
     }
}
