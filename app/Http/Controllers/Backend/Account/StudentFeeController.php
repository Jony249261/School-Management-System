<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\StudentYear;
use App\Model\FeeCategoryAmount;
use App\Model\FeeCategory;
use App\Model\ExamType;
use App\Model\AccountStudentFee;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;

class StudentFeeController extends Controller
{
    public function view(){
        $data = AccountStudentFee::all();
        return view('backend.account.student.fee-view',compact('data'));
    }

    public function add(){
        $years = StudentYear::orderBy('id','DESC')->get();
        $classes = StudentClass::all();
        $fee_categories = FeeCategory::all();
        return view('backend.account.student.fee-add',compact('years','classes','fee_categories'));

    }

    public function getStudent(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m',strtotime($request->date));

        $data = AssignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();

        $html['thsource'] = '<th>Id No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach($data as $key => $std){
            $studentfee =  FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('class_id',$std->class_id)->first();
            $accountstudentfees = AccountStudentFee::where('student_id',$std->student_id)->where('year_id',$std->year_id)->where('class_id',$std->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();
            if($accountstudentfees != null){
                $checked = 'checked';
                
            }else{
                $checked ='';
                
            }
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.$std->student->id_no.'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$std->student->name.'<input type="hidden" name="year_id" value="'.$std->year_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$std['student']['fname'].'<input type="hidden" name="class_id" value="'.$std->class_id.'">'.'</td>';
            
            $html[$key]['tdsource'] .= '<td>'.$studentfee->amount.'TK'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$std['discount']['discount'].'%'.'</td>';

            $originalfee = $studentfee->amount;
            $discount = $std->discount->discount;
            $discountablefee = $discount/100*$originalfee;
            $finalfee = (int)$originalfee - $discountablefee;

            $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$finalfee.'" class="form-controll" readonly>'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$std->student_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.'  style="transform:scale(1.5);margin-left:10px">'.'</td>';
        }
        return response()->json(@$html);

    }


    public function store(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m',strtotime($request->date));
        AccountStudentFee::where('year_id',$year_id)->where('class_id',$class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->delete();
        $checkdata = $request->checkmanage;

        if($checkdata != null){
            for($i=0;$i<count($checkdata);$i++){
                $data = new AccountStudentFee();

                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->fee_category_id = $request->fee_category_id;
                $data->date = date('Y-m',strtotime($request->date));
                $data->student_id = $request->student_id[$checkdata[$i]];
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }
        
        if(!empty(@$data) || empty($checkdata)){
            Session::flash('success','Well Done! Successfully Updated');
        return redirect()->route('accounts.fee.view');
        }else{
            Session::flash('error','Sorry! Data Not Saved');
            return redirect()->back();
        }
    }
}
