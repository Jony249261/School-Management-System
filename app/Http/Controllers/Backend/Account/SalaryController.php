<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\EmployeeAttendence;
use App\Model\AccountEmployeeSalary;
use App\User;
use Illuminate\Support\Facades\Session;

class SalaryController extends Controller
{
    public function view(){
        $data = AccountEmployeeSalary::all();
        return view('backend.account.employee.salary-view',compact('data'));
    }

    public function add(){
        return view('backend.account.employee.salary-add');
    }

    public function getemployee(Request $request){
    $date = date('Y-m', strtotime($request->date));
    if($date != ''){
        $where[] = ['date','like',$date. '%'];
        
    }

    $data = EmployeeAttendence::select('employee_id')->groupBy('employee_id')->where($where)->get();
    $html['thsource'] = '<th>SL</th>';
    $html['thsource'] .= '<th>Employee Id</th>';
    $html['thsource'] .= '<th>Employee Name</th>';
    $html['thsource'] .= '<th>Basic Salary</th>';
    $html['thsource'] .= '<th>Salary (This Month)</th>';
    $html['thsource'] .= '<th>Select</th>';

    foreach($data as $key => $attend){
        $account_salary = AccountEmployeeSalary::where('employee_id',$attend->employee_id)->where('date',$date)->first();
        if($account_salary !=null){
            $checked = 'checked';
        }else{
            $checked = '';
        }
        $totalattend = EmployeeAttendence::with(['employee'])->where($where)->where('employee_id',$attend->employee_id)->get();
        $absentcount = count($totalattend->where('attend_status','absent'));

        $color = 'success';
        $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
        $html[$key]['tdsource'] .= '<td>'.$attend->employee->id_no.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$attend->employee->name.'</td>';
        $html[$key]['tdsource'] .= '<td>'.$attend->employee->salary.'</td>';

        $salary = (float)$attend->employee->salary;
        $salaryperday = (float)$salary/30;
        $totalsalaryminus = (float)$absentcount*(float)$salaryperday;
        $totalsalary = (float)$salary-(float)$totalsalaryminus;

        $html[$key]['tdsource'] .= '<td>'.$totalsalary.'<input type="hidden" name="amount[]" value="'.$totalsalary.'">'.'</td>';
        $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.'  style="transform:scale(1.5);margin-left:10px">'.'</td>';
        
    }
        return response()->json(@$html);
    }

    public function store(Request $request){
        
        $date = date('Y-m',strtotime($request->date));
        AccountEmployeeSalary::where('date',$date)->delete();
        $checkdata = $request->checkmanage;

        if($checkdata != null){
            for($i=0;$i<count($checkdata);$i++){
                $data = new AccountEmployeeSalary();
                $data->date = date('Y-m',strtotime($request->date));
                $data->employee_id = $request->employee_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }
        
        if(!empty(@$data) || !empty($checkdata)){
            Session::flash('success','Well Done! Successfully Updated');
        return redirect()->route('accounts.salary.view');
        }else{
            Session::flash('error','Sorry! Data Not Saved');
            return redirect()->back();
        }
    }

}
