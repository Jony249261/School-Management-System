<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountEmployeeSalary;
use App\Model\AccountOtherCost;
use App\Model\AccountStudentFee;
use PDF;

class ProfitController extends Controller
{
    public function view(){
        return view('backend.report.profit-view');
    }

    public function profit(Request $request){

        $start_date = date('Y-m',strtotime($request->start_date));
        $end_date = date('Y-m',strtotime($request->end_date));
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date',[$sdate,$edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');
        $totat_cost = $emp_salary + $other_cost;
        $profit = $student_fee - $totat_cost;

        $html['thsource'] = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';

        $color = 'success';
        $html['tdsource'] = '<td>'.$student_fee.' TK'.'</td>';
        $html['tdsource'] .= '<td>'.$other_cost.' TK'.'</td>';
        $html['tdsource'] .= '<td>'.$emp_salary.' TK'.'</td>';
        $html['tdsource'] .= '<td>'.$totat_cost.' TK'.'</td>';
        $html['tdsource'] .= '<td>'.$profit.' TK'.'</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Pdf View" target="_blank" href="'.route("report.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'"><i class="fa fa-eye"></i></a>';
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);
    }

    public function pdf(Request $request){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $sdate = date('Y-m',strtotime($request->start_date));
        $edate = date('Y-m',strtotime($request->end_date));

        
        $pdf = PDF::loadView('backend.report.profit-pdf', compact('start_date','end_date','sdate','edate'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
