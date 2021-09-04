<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\StudentYear;
use App\Model\FeeCategoryAmount;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;

class RegistrationfeeController extends Controller
{
    public function view(){
        
        $class = StudentClass::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        return view('backend.student.registratrion_fee.view-registration-fee', compact('year','class'));
    }

    public function getStudent(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if($year_id !=''){
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if($class_id !=''){
            $where[] = ['class_id','like',$class_id.'%'];
        }

        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        //dd($allStudent);

        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Registration Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach($allStudent as $key => $v){
            
            $registrationfee =FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->student->id_no.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%'.'</td>';

            $originalfee = $registrationfee->amount;
            $discount = $v['discount']['discount'];
            $discountablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee - (float)$discountablefee;


            $html[$key]['tdsource'] .= '<td>'.$finalfee.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Payslip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);

    }

    public function paySlip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $data = AssignStudent::where('student_id',$student_id)->where('class_id',$class_id)->first();
        $pdf = PDF::loadView('backend.student.registratrion_fee.registration-fee-slip', compact('data'));
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
