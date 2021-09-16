<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountEmployeeSalary;
use App\Model\AccountOtherCost;
use App\Model\AccountStudentFee;
use PDF;
use App\User;
use App\Model\AssignStudent;
use App\Model\StudentYear;
use App\Model\StudentClass;
use App\Model\ExamType;
use App\Model\StudentMark;
use App\Model\MarkGrade;
use App\Model\EmployeeAttendence;
use Illuminate\Support\Facades\Session;


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

    public function marksheetView(){
        $years = StudentYear::orderBy('id','DESC')->get();
        $classes = StudentClass::all();
        $exams = ExamType::all();
        return view('backend.report.markshhet-view',compact('years','classes','exams'));

    }

    public function marksheetGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $id_no = $request->id_no;

        $count_fail = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_id)->where('id_no',$id_no)->where('marks','<','33')->get()->count();
        
        $singleStudent = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_id)->where('id_no',$id_no)->first();
        if($singleStudent == true){
            $allMarks = StudentMark::with(['assign_subject','year'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_id)->where('id_no',$id_no)->get();
            $allGrade = MarkGrade::all();
            return view('backend.report.pdf.marksheet-print',compact('count_fail','allMarks','allGrade','singleStudent'));
        }else{
            Session::flash('error','Sorry this Criteria Does not Match');
        return redirect()->back();
        }

    }

    public function marksheetPdf($id){
        $data = StudentMark::findOrFail($id);
        //dd($data);
        $year_id = $data->year_id;
        $class_id = $data->class_id;
        $exam_type_id = $data->exam_type_id;
        $id_no = $data->id_no;

        $count_fail = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','<','33')->get()->count();
        //dd($count_fail)->toArray();
        
        $singleStudent = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->first();
        if($singleStudent == true){
            
            $allMarks = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
            //dd($allMarks)->toArray();
            $allGrade = MarkGrade::all();
            
            $pdf = PDF::loadView('backend.report.pdf.mark-sheet-pdf', compact('allMarks','allGrade','count_fail'));
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }else{
            Session::flash('error','Sorry this Criteria Does not Match');
        return redirect()->back();
        }

    }

    public function idCardView(){
        $years = StudentYear::orderBy('id','DESC')->get();
        $classes = StudentClass::all();
        return view('backend.report.id-card-view',compact('years','classes'));

    }

    public function idCardGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $check_data = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->first();
        if($check_data == true){
            $data = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
            //dd($data)->toArray();
            $pdf = PDF::loadView('backend.report.pdf.id-card-pdf', compact('data'));
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }else{
            Session::flash('error','Sorry this Criteria Does not Match');
        return redirect()->back();
        }

    }


    public function resultView(){
        $years = StudentYear::orderBy('id','DESC')->get();
        $classes = StudentClass::all();
        $exams = ExamType::all();
        return view('backend.report.result-view',compact('years','classes','exams'));

    }

        public function resultGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $singleStudent = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_id)->first();
        if($singleStudent == true){

            $data = StudentMark::select('class_id','year_id','exam_type_id','student_id')->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_id)->groupBy('year_id')->groupBy('class_id')->groupBy('student_id')->groupBy('exam_type_id')->get();
            $pdf = PDF::loadView('backend.report.pdf.result-pdf', compact('data'));
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }else{
            Session::flash('error','Sorry this Criteria Does not Match');
        return redirect()->back();
        }

    }


    public function attendenceView(){
        $employees = User::where('usertype','employee')->get();
        return view('backend.report.attendence-view',compact('employees'));

    }

    public function attendenceGet(Request $request){
        $employee_id = $request->employee_id;

        if($employee_id !=''){
            $where[] = ['employee_id',$employee_id];
            
        }
        $date = date('Y-m',strtotime($request->date));
        if($date !=''){
            $where[] = ['date','like',$date.'%']; 
        }

        $singleAttendence = EmployeeAttendence::with(['employee'])->where($where)->first();

        if($singleAttendence == true){
            $allData = EmployeeAttendence::with(['employee'])->where($where)->get();
            $absent = EmployeeAttendence::with(['employee'])->where($where)->where('attend_status','absent')->get()->count();
            $leave = EmployeeAttendence::with(['employee'])->where($where)->where('attend_status','leave')->get()->count();
            $month = date('M Y',strtotime($request->date));
            $pdf = PDF::loadView('backend.report.pdf.attendence-pdf', compact('allData','absent','leave','month'));
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }
        
        

    }


}
