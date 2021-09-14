<?php

namespace App\Http\Controllers\Backend\Mark;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\StudentYear;
use App\Model\ExamType;
use App\Model\AssignSubject;
use App\User;
use DB;
use PDF;
use Illuminate\Support\Facades\Session;
use App\Model\StudentMark;

class MarksController extends Controller
{
    public function add(){
        $class = StudentClass::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $exams = ExamType::all();
        $subjects = AssignSubject::all();
        return view('backend.mark.add-mark',compact('class','year','exams','subjects'));
    }

    public function store(Request $request){
        $studentcount = $request->student_id;
        if($studentcount){
            for($i=0; $i <  count($request->student_id); $i++){
                $data = New StudentMark();

                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
        
            }
        }else{
            session::flash('error','Sorry! There are No Student');
        return redirect()->back();
        }
        
        session::flash('success','Student Marks Entry Successfully');
        return redirect()->back();
        
    }

    public function edit(){
        $class = StudentClass::all();
        $year = StudentYear::orderBy('id','DESC')->get();
        $exams = ExamType::all();
        return view('backend.mark.edit-mark',compact('class','year','exams'));
    }

    public function getMarks(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $assign_subject_id = $request->assign_subject_id;

        $getStudent = StudentMark::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_id)->where('assign_subject_id',$assign_subject_id)->get();
        //dd($getStudent);
        return response()->json($getStudent);
    }


    public function update(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_id = $request->exam_id;
        $assign_subject_id = $request->assign_subject_id;
       StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_id)->where('assign_subject_id',$assign_subject_id)->delete(); 
       $studentcount = $request->student_id;
       if($studentcount){
           for($i=0; $i<count($request->student_id); $i++){
                $data = New StudentMark();

                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
           }
       }
       session::flash('success','Student Marks Updated Successfully');
        return redirect()->back();
    }

    
}
