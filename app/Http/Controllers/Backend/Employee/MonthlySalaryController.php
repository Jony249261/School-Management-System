<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmployeSalaryLog;
use App\Model\Designation;
use App\Model\EmployeeAttendence;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;


class MonthlySalaryController extends Controller
{
    public function view(){
        return view('backend.employee.monthly_salary.view-salary');
    }

    public function getSalary(Request $request){
        $date = date('Y-m', strtotime($request->date));
        if($date != ''){
            $where[] = ['date','like',$date. '%'];
            
        }

        $data = EmployeeAttendence::select('employee_id')->groupBy('employee_id')->where($where)->get();
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This Month)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach($data as $key => $attend){
            $totalattend = EmployeeAttendence::where($where)->where('employee_id',$attend->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status','absent'));

            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend->employee->name.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend->employee->salary.'</td>';

            $salary = (float)$attend->employee->salary;
            $salaryperday = (float)$salary/30;
            $totalsalaryminus = (float)$absentcount*(float)$salaryperday;
            $totalsalary = (float)$salary-(float)$totalsalaryminus;

            $html[$key]['tdsource'] .= '<td>'.$totalsalary.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("employee.monthly.salary.payslip",$attend->employee_id).'">Payslip</a>';
            $html[$key]['tdsource'] .= '</td>';
            
        }
        return response()->json(@$html);
    }

    public function payslip(Request $request,$employee_id){
        $id = EmployeeAttendence::where('employee_id',$employee_id)->first();
        $date = date('Y-m', strtotime($id->date));
        if($date != ''){
            $where[] = ['date','like',$date. '%'];
            
        }

        $data['totalattendgroupbyib'] = EmployeeAttendence::with('employee')->where($where)->where('employee_id',$id->employee_id)->get();
        
        $pdf = PDF::loadView('backend.employee.monthly_salary.salary_details', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
